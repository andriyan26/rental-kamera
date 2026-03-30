@echo off
REM Satu klik: migrate + storage:link memakai PHP Laragon
cd /d "%~dp0"
call "%~dp0laragon-artisan.cmd" migrate --force
if errorlevel 1 exit /b 1
call "%~dp0laragon-artisan.cmd" storage:link
if errorlevel 1 exit /b 1
echo.
echo Selesai.
exit /b 0
