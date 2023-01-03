import mysql.connector
import re
from datetime import date
from scraper import log





def updatePrinter(ip, name, status, location, make, model, bw):
    #
    # update info in db for given printer
    # This function is only used for bootstrapping the project via the printerIPs.txt file
    # Once project is set up, this function is not used anymore
    #
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()

    # might want to add some logic to validate the parameters

    sql = '''UPDATE printer SET name=%s, status=%s, location=%s, make=%s, model=%s, bw=%s
            WHERE ip=%s'''
    
    vals = (name, status, location, make, model, bw, ip)
    
    cursor.execute(sql, vals)

    db.commit()
   


def queryDb():

# Used in scraper to get all ip addresses
# Returns a list of (ip, name, isBw) tuples

    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()

    cursor.execute("SELECT ip,name,bw FROM printer")
    dataset = cursor.fetchall() # This returns the data in the form of tuples.

    #for i in range(len(dataset)): # This transforms the dataset into a standard 2d array
    #    print(str(dataset[i][0]) + ' ' + dataset[i][1])

    return dataset



def updateToner(ip, color, status, pagesRem, pagesPrinted, firstInstDate, serialNum):

# Used by scraper to input toner data
#
# Also cleanses data and maintains toner_map table automatically

    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()
    #
    # First get printer name, mostly for debug/log purposes
    #
    printerName = getName(ip)
    #
    # Cleanse date field from "date not available" among other possible things
    # Also clean pages remaining for non-integers
    #
    pagesRem = re.sub("\D*", "", pagesRem)
    if(not(firstInstDate.isdigit())):  
        firstInstDate = None
    #
    # Check if toner exists in map table
    #
    cursor.execute('''SELECT * FROM toner_map 
        WHERE (toner_serial_number, currently_in_use)=(%s, 1)''', [serialNum])
    if(len(cursor.fetchall()) == 0): 
        # 
        # If the toner cartridge serial number isn't in toner_map
        #
        # Before inserting into toner_map we have to add it to toner_cartridge
        #
        cursor.execute('''INSERT INTO toner_cartridge 
            (color, toner_status, pages_remaining, pages_printed, first_inst_date, serial_number)
            VALUES (%s, %s, %s, %s, %s, %s)''', [color, status, pagesRem, pagesPrinted, firstInstDate, serialNum])
        #
        # If printer has previous cartridge associated with it, make it historical
        #
        cursor.execute('''UPDATE toner_map 
            JOIN toner_cartridge ON toner_map.toner_serial_number = toner_cartridge.serial_number
            SET currently_in_use=0 WHERE (toner_map.printer_ip, toner_cartridge.color)=(%s, %s)''', [ip, color])
        # And reset history consumption for proper daily consumption calculation
        updateHistory(ip, pagesPrinted, serialNum, color, True)

        #
        # Then add mapping from printer to this cartridge
        #
        cursor.execute('''INSERT INTO toner_map (printer_name, printer_ip, toner_serial_number)
            VALUES (%s, %s, %s)''', [printerName, ip, serialNum])
        log(color+" cartridge data and mapping inserted", (printerName, ip))

    else:
        #
        # If the toner cartridge is already mapped
        #
        # Basic insert values
        #
        cursor.execute('''UPDATE toner_cartridge SET 
            color=%s, toner_status=%s, pages_remaining=%s, pages_printed=%s, first_inst_date=%s
            WHERE serial_number=%s''', 
            [color, status, pagesRem, pagesPrinted, firstInstDate, serialNum])
        log(color+" cartridge data updated", (printerName, ip))

    db.commit()


def updatePrinterStatus(ip, status):
#   
#   Updates status for given printer ip
#
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()

    cursor.execute("UPDATE printer SET status=%s WHERE ip=%s", [status, ip])

    db.commit()


def updateTonerStatus(serialNum, status):
#
#   Updates status for given toner serial num
#
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()

    cursor.execute("UPDATE toner_cartridge SET toner_status=%s WHERE serial_number=%s", [status, serialNum])

    db.commit()


def getName(ipAddress):
#
# Gets name of printer currently associated with given ip address
#
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()

    cursor.execute('''SELECT printer_name FROM toner_map 
        WHERE (printer_ip=%s AND currently_in_use=1)''', [ipAddress])
    result = cursor.fetchall()
    try:
        return result[0][0]
    except:
        cursor.execute('''SELECT name FROM printer WHERE ip=%s''', [ipAddress])
        return cursor.fetchall()[0][0]



def getTonerCounts():
#
# Returns a list of all printers with their active toner carts
# Specifically: (name, ip, toner_color, toner_status, toner_pagesRem)
#
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()

    cursor.execute('''SELECT printer.name, printer.ip, printer.status,
        toner_cartridge.color, toner_cartridge.toner_status, toner_cartridge.pages_remaining
        FROM printer LEFT JOIN toner_map ON 
        printer.ip = toner_map.printer_ip
        LEFT JOIN toner_cartridge ON
        toner_map.toner_serial_number = toner_cartridge.serial_number
        WHERE toner_map.currently_in_use = 1
        ORDER BY printer.name, toner_cartridge.color''')
    return cursor.fetchall()



def numToners(ipAddress):
#
# Returns the number of entries the ip address has on the toner_map table
#
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()

    cursor.execute("SELECT * FROM toner_map WHERE (printer_ip=%s AND currently_in_use=1)", [ipAddress])
    return cursor.rowcount



def getHistory(ipAddress, rows, tonerColor = "Black"):
    #
    # Returns most recent (rows) rows from history table corresponding to the ip and toner color
    #
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()
    name = getName(ipAddress)

    # sql for non-mapped hist table
    sql = '''SELECT day_measured, consumption, toner_pages_printed
        FROM printer_history WHERE (printer_ip, printer_name, toner_color) = (%s, %s, %s)
        ORDER BY day_measured DESC
        LIMIT %s'''

    # sql for mapped hist table
    #sql = '''SELECT mapped_history.day_measured, mapped_history.consumption, mapped_history.toner_pages_printed
    #    FROM mapped_history 
    #    LEFT JOIN history_map ON mapped_history.id = history_map.hist_id
    #    LEFT JOIN printer ON printer.ip = history_map.printer_ip
    #    WHERE (printer.ip, mapped_history.toner_color) = (%s, %s)
    #    ORDER BY mapped_history.day_measured DESC LIMIT %s;'''

    cursor.execute(sql, [ipAddress, name, tonerColor, rows])

    return cursor.fetchall()


def updateHistory(ipAddress, tonerPagesPrinted, serialNum, tonerColor = "Black", resetPastConsumption = False):
    # 
    # Calculates consumption based on the toner's pages printed to date field as well
    # as the past consumtion data
    #
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="pd"
    )
    cursor = db.cursor()
    name = getName(ipAddress)

    today = date.today()
    try:
        hist = getHistory(ipAddress, 1, tonerColor)
        if(hist[0][0] == today): return
    except:
        hist = [(date(2002, 4, 20), 0, 0)]

    #print(hist[0][0], today, hist[0][0] == today)
    
    if(resetPastConsumption):
        consumptionToDate = 0
        consumption = consumptionToDate

    else:
        consumptionToDate = hist[0][2] + hist[0][1] #2+ days ago consumption + yesterday's cons.
        consumption = int(tonerPagesPrinted) - int(consumptionToDate)



    sql = '''INSERT INTO printer_history 
    (printer_ip, printer_name, day_measured, toner_color, consumption, toner_pages_printed)
    VALUES (%s, %s, %s, %s, %s, %s)'''
    cursor.execute(sql, [ipAddress, name, today, tonerColor, consumption, consumptionToDate])

    db.commit()



def main():
    for cart in getTonerCounts():
        print(cart)



if __name__ == '__main__':
    pass