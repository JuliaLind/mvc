[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JuliaLind/mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/JuliaLind/mvc/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/JuliaLind/mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/JuliaLind/mvc/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/JuliaLind/mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/JuliaLind/mvc/build-status/main)

Innan du klonar report behöver du installera Composer och NPM.
Instruktioner för installation av Composer finns här: https://dbwebb.se/kurser/mvc-v2/labbmiljo/php-composer
(om du inte har PHP installerat så hittar du instruktioner för det här: https://dbwebb.se/kurser/mvc-v2/labbmiljo/php) 
Instruktioner för installation av NPM finns här: https://dbwebb.se/kunskap/installera-node-och-npm .  

Skriv följande i terminalen för att klona repot:

git clone https://github.com/JuliaLind/mvc  
cd mvc  
composer install  
npm install  


För att starta upp webbplatsen lokalt behöver du använda en lokal server (localhost), förslagsvis apache2. PHPs inbyggda server är inte att rekommendera då webbplatsen har en tendens att hänga sig när phpserver används. I public/.htaccess på rad 20 kan du eventuellt behöva justera sökvägen beroende på vilken server du använder.

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

Den nuvarande .htaccess filen är inställd så att du når applikationen via http://localhost/dbwebb/mvc-proj/public/ och projektet via http://localhost/dbwebb/mvc-proj/public/proj

I filerna composer.json respektive package.json hittar du tillgängliga "kortkommandon". Du kör scripterna från roten av report, för composer scripten skriver du "composer" och kortkommando - t ex "composer phpunit" för att köra testerna. Scripterna i packade.json kör du genom att skriva "npm run" och kortkommando, exempelvis npm run watch om du vill göra ändringar i css stylesheet och vill att dessa uppdateras "automatiskt".

