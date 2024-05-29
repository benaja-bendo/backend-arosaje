@echo off
set TIMESTAMP=%DATE:~10,4%%DATE:~4,2%%DATE:~7,2%_%TIME:~0,2%%TIME:~3,2%%TIME:~6,2%
set TIMESTAMP=%TIMESTAMP: =0%
set BACKUP_DIR=le\repertoire\ou\sera\stocker\le\dump
set MYSQLDUMP_PATH=C:\Program Files\MySQL\MySQL Server 8.0\bin\mysqldump.exe
set DATABASE_NAME=backend-arosaje
set USERNAME=root
set PASSWORD=root

%MYSQLDUMP_PATH% -u %USERNAME% -p%PASSWORD% %DATABASE_NAME% > %BACKUP_DIR%\%DATABASE_NAME%_%TIMESTAMP%.sql

echo Backup completed at %TIMESTAMP%