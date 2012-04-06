@echo off
cls
set pass=
echo WEB MANAGE
echo Manageur de machines windows
pause
echo Creation du certificat SSL
%cd%\certgenerator\bin\openssl genrsa -rand .rnd -out %cd%\key.pem 1024 
%cd%\certgenerator\bin\openssl req -new -key .\key.pem -out %cd%\cert.pem -x509 -config %cd%\certgenerator\bin\openssl.cfg
echo Certificat Généré
pause
set /p pass=Entrer le mot de passe pour admin:
%cd%\certgenerator\bin\openssl.exe passwd -1 "%pass%" >> realms.cfg
