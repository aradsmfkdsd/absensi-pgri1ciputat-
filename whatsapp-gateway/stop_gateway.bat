@echo off
echo Menghentikan WhatsApp Gateway di port 3000...
for /f "tokens=5" %%a in ('netstat -aon ^| findstr :3000 ^| findstr LISTENING') do (
    taskkill /f /pid %%a
    echo WhatsApp Gateway berhasil dihentikan.
    goto end
)
echo WhatsApp Gateway tidak terdeteksi berjalan pada port 3000.
:end
pause
