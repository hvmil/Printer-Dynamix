@echo off

tasklist | findstr /i mysqld.exe > nul
	
if %errorlevel%==1 (
	echo MySQL not currently running. Please start it and try again.
	exit
)

echo This will overwrite whatever is in your database currently.
echo Would you like to backup your current database? (y/n)
set /p cont=">>"
if "%cont%" == "y" goto backup
if "%cont%" == "Y" goto backup
if "%cont%" == "n" goto import
if "%cont%" == "N" goto import

echo Answer unclear. Aborting.
goto end


:backup
start /wait %cd%\Backup-SQL.cmd
if %errorlevel%==0 (
	echo Successfully backed up.
	goto import
)
echo.
echo Something went wrong with the backup.
echo Aborting import.
goto end

:import

ECHO.
ECHO Importing now.
ECHO.

C:\xampp\mysql\bin\mysql -u root < "%~dp0\..\..\sql\pd.sql"
c:\xampp\mysql\bin\mysql -u root < "%~dp0\..\..\sql\historyTables.sql"

c:\xampp\mysql\bin\mysql -u root --execute="CREATE USER IF NOT EXISTS 'pd_user'@'localhost' IDENTIFIED BY 'pr1nt3rDyn@1c$';
c:\xampp\mysql\bin\mysql -u root --execute="GRANT ALL PRIVILEGES ON `pd`.* TO 'pd_user'@'localhost' IDENTIFIED BY 'pr1nt3rDyn@1c$';

if %errorlevel%==0 (
	echo Successfully created pd_user
)





:end
pause