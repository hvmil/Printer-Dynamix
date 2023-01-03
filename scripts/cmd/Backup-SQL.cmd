@echo off
TITLE SQL Backup

tasklist | findstr /i mysqld.exe > nul
	
if %errorlevel%==1 (
	echo MySQL not currently running. Please start it and try running this again.
	exit
)

if not exist "C:\xampp\db_backup" (
	mkdir c:\xampp\db_backup
)
set backupFilename=%DATE:~10,4%%DATE:~4,2%%DATE:~7,2%backup.sql

c:\xampp\mysql\bin\mysqldump -u root pd > "c:\xampp\db_backup\%backupFilename%"

if %errorlevel%==0 (
	echo Backup file %backupFilename% created in c:\xampp\db_backup.
) else (
	echo Something went wrong!
)



exit