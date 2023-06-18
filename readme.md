[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JuliaLind/mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/JuliaLind/mvc/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/JuliaLind/mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/JuliaLind/mvc/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/JuliaLind/mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/JuliaLind/mvc/build-status/main)



Skriv följande i terminalen för att klona repot:

git clone https://github.com/JuliaLind/mvc  
cd mvc  
composer install  
npm install  


För att starta upp webbplatsen lokalt behöver du använda en lokal server (localhost), förslagsvis apache. I public/.htaccess på rad 20 kan du eventuellt behöva justera sökvägen beroende på vilken server du använder.

Du kommer igång med apache genom att skriva följande i terminalen:
sudo apt update
sudo apt upgrade -y
sudo apt install apache2 libapache2-mod-php

och därefter kan du använda följande kommandon från mvc mappen:

sudo service apache2 start
sudo service apache2 stop
sudo service apache2 status
sudo service apache2 restart
sudo service apache2 reload

Skriv 'sudo service apache2 start' stående i mvc katalogen för att starta igång den lokala servern och därefter går du in på motsvarande sökväg via browser. 

