@echo off

echo Please run this as administrator for proper functionality.
pause
pip3 install lxml mysql.connector bs4 requests

if %errorlevel%==0 (goto end)
echo.
echo Python modules not installed.
echo Make sure that python3 is installed and pip3 is in your PATH variable.
echo.
pause
exit



:end
echo.
echo Python Modules installed successfully.
echo.
pause