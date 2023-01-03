@echo off
TITLE PrinterDynamix Windows Setup

ECHO This script simply puts everything into your xampp directory.
ECHO If you cloned directly to that directory, you can cancel this script.
ECHO.
set /p cont="Continue? [n]"
if not "%cont%"=="y" (
	echo.
	echo Aborting.
	goto end
)
if not exist "C:\Xampp" (
	echo Xampp not installed into c:\xampp
	echo Please set that up first.
	goto end
)

if not exist "C:\xampp\htdocs\PrinterDynamix" (
	mkdir "C:\xampp\htdocs\PrinterDynamix"
)


xcopy "%~dp0\..\..\..\PrinterDynamix" "c:\xampp\htdocs\PrinterDynamix" /E /H /Y

:end
ECHO.
pause



