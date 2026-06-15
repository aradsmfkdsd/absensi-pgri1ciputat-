@echo off
:: Tunggu 10 detik agar server Laragon/Apache/MySQL siap dijalankan terlebih dahulu
timeout /t 10

:: Buka browser Microsoft Edge dalam mode Kiosk Fullscreen
start msedge --kiosk http://localhost:8080/scanner --edge-kiosk-type=fullscreen
