@echo off
REM Jalankan artisan pakai PHP Laragon (tanpa perlu php di PATH).
REM Contoh: laragon-artisan.cmd migrate --force
REM         laragon-artisan.cmd storage:link

cd /d "%~dp0"

set "PHP_EXE="
if exist "C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.exe" (
  set "PHP_EXE=C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.exe"
)
if "%PHP_EXE%"=="" (
  for /d %%D in ("C:\laragon\bin\php\php-*") do (
    if exist "%%D\php.exe" set "PHP_EXE=%%D\php.exe"
  )
)

if not exist "%PHP_EXE%" (
  echo [ERROR] php.exe tidak ditemukan.
  echo Pastikan Laragon terpasang di C:\laragon atau edit path di file ini.
  echo Alternatif: Laragon Menu -^> Tools -^> Path -^> Add Laragon to PATH, lalu buka terminal baru.
  exit /b 1
)

"%PHP_EXE%" artisan %*
