@echo off
echo Starting Kirosame Platform Server...
echo Open your browser to http://localhost:8000
echo.

WHERE php >nul 2>nul
IF %ERRORLEVEL% NEQ 0 (
    echo [ERROR] PHP is not found in your system PATH.
    echo.
    echo Please install XAMPP or PHP for Windows.
    echo If you have XAMPP installed, you may need to add C:\xampp\php to your Environment Variables.
    echo.
    pause
    exit /b
)

php -S localhost:8000
pause
