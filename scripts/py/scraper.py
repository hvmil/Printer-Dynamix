from bs4 import BeautifulSoup
import requests
from pd_mysql_connector import *
from urllib3.exceptions import InsecureRequestWarning
from datetime import date, datetime

def getData(page, isBw, ipAddress):

# Input:  Printer webpage object
# Output: Key/Value pair K=printer name, data = string list 
#
# Returns False if data cannot be found
#
#
# [status, pages remaining, pages printed with toner cartrige, date of toner cartrige install, cart serial num] 
	

	# Parse page

	#print("1")
	try:
		html = page.text
	except Exception as e:
		log("ERROR 100: Unable to read webpage", (getName(ipAddress),ipAddress), e)
	soup = BeautifulSoup(html, "lxml")



	# Get name
	#print("2")

	name = getName(ipAddress)
	try:
		webName = soup.find(id='HomeDeviceName').text
	except:
		try:
			webName = (soup.find(class_='networkInfo').text).split('/')[0].strip()
		except:
			log("ERROR 101: Unable to find device name for printer in webpage", (name, ipAddress))

	#print("3")
	try:
		if(webName.upper() != name.upper()): 
			log("WARNING: The printer at ip address "+ipAddress+
				"\nhas a different name on the webpage ("+name+") than it does in the database ("+getName(ipAddress)+")"
				"\nThis may cause errors!"+
				"\nPlease delete the printer with the wrong name and create another with the correct name")
	except:
		pass

	#print("4")

	if(isBw):

		# Retreive BW printer data

		try:
			#print("5.1")
			status = soup.find(id='BlackCartridge1-SupplyState').text
			pagesRem = soup.find(id='BlackCartridge1-EstimatedPagesRemaining').text
			pagesPrinted = soup.find(id='BlackCartridge1-PagesPrintedWithSupply').text
			firstInstDate = soup.find(id='BlackCartridge1-FirstInstallDate').text
			serialNumber = soup.find(id='BlackCartridge1-SerialNumber').text

			data = {"Black" : [status, pagesRem, pagesPrinted, firstInstDate, serialNumber]}
		except:
			#print("Unable to read cartridge for printer", name, "with new html")
			try:
				#print("5.2")
				statusLowRow = soup.find(class_="hpDataItem", id="itm-9679")
				statusLow = statusLowRow.find(class_="hpDataItemValue").text
				statusOutRow = soup.find(class_="hpDataItem", id="itm-9679")
				statusOut = statusOutRow.find(class_="hpDataItemValue").text

				if((statusLow == "NO") and (statusOut == "NO")):
					status = "OK"
				else:
					status = "Low or Out"

				pagesRemRow = soup.find(class_="hpDataItem", id="itm-9429")
				pagesRem = pagesRemRow.find(class_="hpDataItemValue").text

				pagesPrintedRow = soup.find(class_="hpDataItem", id="itm-9079")
				pagesPrinted = pagesPrintedRow.find(class_="hpDataItemValue").text

				firstInstDateRow = soup.find(class_="hpDataItem", id="itm-9695")
				firstInstDate = firstInstDateRow.find(class_="hpDataItemValue").text

				serialNumberRow = soup.find(class_="hpDataItem", id="itm-9681")
				serialNumber = serialNumberRow.find(class_="hpDataItemValue").text

				data = {"Black" : [status, pagesRem, pagesPrinted, firstInstDate, serialNumber]}
			except:
				#print("5.3")
				data = {"Black" : [status, None, None, None, serialNumber]}
				log("ERROR 102: Unable to read toner cartridge! There may be a jam.", (name, ipAddress))
				#print("Or old html")
				#updateTonerStatus(ipAddress, "Toner cartridge cannot be read")

		#data = {"Black" : [status, pagesRem, pagesPrinted, firstInstDate, serialNumber]}
	else:
		colorErrorList = ""
		try:
			bStatus = soup.find(id='BlackCartridge1-SupplyState').text
			bPagesRem = soup.find(id='BlackCartridge1-EstimatedPagesRemaining').text
			bPagesPrinted = soup.find(id='BlackCartridge1-PagesPrintedWithSupply').text
			bFirstInstDate = soup.find(id='BlackCartridge1-FirstInstallDate').text
			bSerialNumber = soup.find(id='BlackCartridge1-SerialNumber').text
		except:
			#print("Error: Unable to read black cartridge for printer", name)
			colorErrorList = "Black"

		try:
			cStatus = soup.find(id='CyanCartridge1-SupplyState').text
			cPagesRem = soup.find(id='CyanCartridge1-EstimatedPagesRemaining').text
			cPagesPrinted = soup.find(id='CyanCartridge1-PagesPrintedWithSupply').text
			cFirstInstDate = soup.find(id='CyanCartridge1-FirstInstallDate').text
			cSerialNumber = soup.find(id='CyanCartridge1-SerialNumber').text
		except:
			#print("Error: Unable to read cyan cartridge for printer", name)
			if(len(colorErrorList) > 0):
				colorErrorList = colorErrorList + ", Cyan"
			else:
				colorErrorList = "Cyan"

		try:
			mStatus = soup.find(id='MagentaCartridge1-SupplyState').text
			mPagesRem = soup.find(id='MagentaCartridge1-EstimatedPagesRemaining').text
			mPagesPrinted = soup.find(id='MagentaCartridge1-PagesPrintedWithSupply').text
			mFirstInstDate = soup.find(id='MagentaCartridge1-FirstInstallDate').text
			mSerialNumber = soup.find(id='MagentaCartridge1-SerialNumber').text
		except:
			#print("Error: Unable to read magenta cartridge for printer", name)
			if(len(colorErrorList) > 0):
				colorErrorList = colorErrorList + ", Magenta"
			else:
				colorErrorList = "Magenta"

		try:
			yStatus = soup.find(id='YellowCartridge1-SupplyState').text
			yPagesRem = soup.find(id='YellowCartridge1-EstimatedPagesRemaining').text
			yPagesPrinted = soup.find(id='YellowCartridge1-PagesPrintedWithSupply').text
			yFirstInstDate = soup.find(id='YellowCartridge1-FirstInstallDate').text
			ySerialNumber = soup.find(id='YellowCartridge1-SerialNumber').text
		except:
			#print("Error: Unable to read yellow cartridge for printer", name)
			if(len(colorErrorList) > 0):
				colorErrorList = colorErrorList + ", Yellow"
			else:
				colorErrorList = "Yellow"

		if(len(colorErrorList) > 0):
			raise Exception("ERROR 103: "+colorErrorList + " toner cartridge(s) cannot be read.", (name, ipAddress))
			#updateTonerStatus(ipAddress, colorErrorList + "toner cartridge(s) cannot be read")

		data = {'Black' : [bStatus, bPagesRem, bPagesPrinted, bFirstInstDate, bSerialNumber], 
		"Cyan" : [cStatus, cPagesRem, cPagesPrinted, cFirstInstDate, cSerialNumber], 
		"Magenta" : [mStatus, mPagesRem, mPagesPrinted, mFirstInstDate, mSerialNumber], 
		"Yellow" : [yStatus, yPagesRem, yPagesPrinted, yFirstInstDate, ySerialNumber]}

	#print("7")

	page.close()

	return [name, data]



def getSuppliesPage(ipAddress):

# Input: Printer IP address
# Output: (Printer webpage object, isOldHTML)

	#print("Connecting to IP address", ipAddress)
	requests.packages.urllib3.disable_warnings(category=InsecureRequestWarning)
	try:

		# New printers
		#print("first try")
		page = requests.get("https://"+ipAddress.strip()+"/hp/device/InternalPages/Index?id=SuppliesStatus", verify=False, timeout=10)
		page.raise_for_status()
		return page
	except requests.exceptions.RequestException as e:
		exc = e
		printerName = getName(ipAddress)
		log("ERROR 200: Recent page address failed", (printerName, ipAddress), e)
	try:

		# Some old printers
		# May also return a connection for new printers if they timed out above which can be a problem
		page = requests.get("https://"+ipAddress.strip()+"/hp/device/this.LCDispatcher?nav=hp.Supplies", verify=False, timeout=20)
		page.raise_for_status()
		return page
	except requests.exceptions.RequestException as e:
		exc = e
		log("ERROR 201: Old page address failed", (printerName, ipAddress), e)

	return False

	# Unsupported models: CLJ-5550, LJ-9050
	# REH 210 is different brand?



def getPrinterStatus(ipAddress):

# Same as getSuppliesPage above but goes to the printer's homepage and returns the status
# Since getting the one value is easier than the toner values I'm combining the request and
# getData parts into one function

	requests.packages.urllib3.disable_warnings(category=InsecureRequestWarning)
	try:

		page = requests.get("http://"+ipAddress.strip(), verify=False, timeout=20)
		page.raise_for_status()
		
		html = page.text
		soup = BeautifulSoup(html, 'lxml')

		try:
			status = soup.find(id="MachineStatus").text	
			if(not(status is None)): return status.strip()

		except:
			try:
				status = soup.find(id="Text1").text
				if(not(status is None)): return status.strip()
			except:
				updatePrinterStatus(ipAddress, "Cannot find status")

	except requests.exceptions.RequestException as e:
		printerName = getName(ipAddress)
		log("ERROR 300: Unable to connect! "+
			"This printer may be jammed, turned off, or not supported.", (printerName, ipAddress), e)
		updatePrinterStatus(ipAddress, "Unable to Connect")
		return False

	return "Status Not Found"



def updatePrinter(ipAddress, name, isBw):

# Input: printer IP address and name
# Output: boolean representing whether the db update was a success

#DB connector syntax: updateToner(ip, color, status, pagesRem, pagesPrinted, firstInstDate)

	page = getSuppliesPage(ipAddress)
	if(page):
		try:	#Handles exception if printer connection times out
			data = getData(page, isBw, ipAddress)
		except Exception as e:
			log("ERROR 400: Unspecified error retreiving data", (name, ipAddress), e)
			#updatePrinterStatus(ipAddress, "Unable to Connect")
			return False

		if(data is None): return False	#Handles exception if toner data is unavailable

		name = data[0]
		tonerData = data[1]

		#print(tonerData)	#Debugging
		for color in tonerData:

			#print(color)	#Debugging

			updateToner(ipAddress, color, tonerData[color][0], tonerData[color][1], 
				tonerData[color][2], tonerData[color][3], tonerData[color][4])
			#(ip, color, status, pagesRem, pagesPrinted, firstInstDate, serialNum)
			updateHistory(ipAddress, tonerData[color][2], tonerData[color][4], color)

		return True
	else:
		log("ERROR 401: Unable to connect!\n"+
			"This printer may be jammed, turned off, or not supported", (name, ipAddress))
		updatePrinterStatus(ipAddress, "Unable to Connect")
	return False


def log(message, printer = None, error = None):
	#
	# Input: message to write to log txt file, tuple to identify with particular printer, error
	# 
	try:
		log = open("../../logs/scraper_log.txt", "r")
	except:
		log = open("../../logs/scraper_log.txt", "x")
	if((log.readline().find(datetime.now().strftime("%x")) == -1)): 
		# If the log has yesterday's data, overwrite the file so it doesn't get too big
		log.close()
		log = open("../../logs/scraper_log.txt", "w")
		log.write(datetime.now().strftime("%x") + "\n")
		log.write("\n")

	else:
		# If log data is from today, append whats already there
		log.close()
		log = open("../../logs/scraper_log.txt", "a")

	# Log date and time
	log.write(datetime.now().strftime("%c") + "\n")

	# Log any available printer id info
	printerName = printer[0]
	printerIp = printer[1]
	if(printerName is not None): log.write("Printer: "+printerName+"\n")
	if(printerIp is not None): log.write("IP: "+printerIp + "\n")

	# Log message
	log.write(message + "\n")

	# Log "official" error msg if available
	if(error is not None): 
		log.write("Error message:" + "\n")
		log.write(str(error) + "\n")
	log.write("\n")

	log.close()
	return




def main():

# Runs through all ips in printer table and updates toner data for them in the DB

# data format : [status, pagesRem, pagesPrinted, firstInstDate, serialNumber]

	printers = queryDb()
	for p in printers:
		status = getPrinterStatus(p[0])
		if(status):		#Ensures no wasted time trying to connect repeatedly
			updatePrinterStatus(p[0], status)
			updatePrinter(p[0], p[1], p[2])


def tests():
	#print((requests.get("https://137.140.24.159/hp/device/this.LCDispatcher?nav=hp.Supplies", verify=False,timeout=20)).text)
	#print(getSuppliesPage("137.140.24.159"))
	print(getData(requests.get("https://137.140.24.159/hp/device/this.LCDispatcher?nav=hp.Supplies", verify=False,timeout=20), True, "137.140.24.159"))
	print(getData(getSuppliesPage("137.140.24.159"), True, "137.140.24.159"))
	print(getPrinterStatus("137.140.24.159"))


if __name__ == '__main__':
	main()