import mysql.connector
import re

def addIP(ipAddress, printerName, printerLocation):

	db = mysql.connector.connect(
		host='localhost',
		user='root',
		password='',
		database='pd')

	cursor = db.cursor()

	sql = "INSERT INTO printer (ip, name, location, make, model, bw) VALUES (%s, %s, %s, %s, %s, %s);"

	#Printer name is formatted location-isColor-printerModel
	#Here I assign printerMake, and isColor assuming the above format
	#And also cleaning any capitalization inconsistencies
	#Also note that I am assuming that all printers in the list are HP printers

	printerMake = "HP"
	printerModel = (printerName.split("-", 2)[2]).upper()
	isBw = not(re.search("C", (printerName.split("-", 2)[1]).upper()))


	vals = [ipAddress, printerName, printerLocation, printerMake, printerModel, isBw]

	cursor.execute(sql, vals)

	db.commit()

	print(cursor.rowcount, "record inserted")

def addFromFile(file):
	#file must be text with tab-delimited format [printer name, printer location, ip address]
	f = open(file, 'r')
	count = 0
	for x in f:
		s = x.split("	")
		if(re.search("[0-9]{3}\.[0-9]{3}\.[0-9]{2,3}\.[0-9]{3}", s[2])):
			addIP((s[2])[:-1] , s[0], s[1]) #The weird string thing on s[2] is cleaning the newline off the
		else:								#IP address, which would otherwise have it
			print("This entry has an invalid IP address :( ",(s[2])[:-1], s[0], s[1])
		print(count, "total entries")
		count = count + 1

	f.close()

def killPrinterTable():
	db = mysql.connector.connect(
		host='localhost',
		user='root',
		password='',
		database='pd')

	cursor = db.cursor()

	sqlMurder = "TRUNCATE printer;"
	cursor.execute(sqlMurder)
	print("Your printer table has been murdered >:)\n")


	db.commit()

print("Warning: This will truncate ALL entries from table printer")
print("and replace them with entries in the PrinterIPs.txt file")
print("")
print("This also assumes your db is up to date as of 10/31/22")
if(input("Would you like to proceed? y/n\n") == "y"):
	#killPrinterTable()
	addFromFile('../PrinterIPs.txt')
	print("\n\n-----------------------------")
	print("Congragulations! You should have seen a bunch of inserted entries")
	print("Goodbye!")
else:
	print("\nOk :,( \ngoodbye...")
