## kmom01


Vi har jobbar mycket med objektorientering i OOPython kursen. Vi har också berört ämnet lätt i JavaScript-kursen och i Databas. Objektorientering är ett sätt att skriva kod på som kapslar in implementation och skapar ett gränssnitt (API) ut mot användaren. På så sätt kan vi senare göra justeringar i koden och ändå hålla den bakåtkompatibel, dvs att klienten inte behöver skriva om sin kod till följd av våra ändringar.

I PHP kan man skapa egna klasser och sedan objekt utifrån dessa. Man kan också skapa objekt utifrån en fördefinierad klass stdClass, som är muteable, vilket gör att vi i efterhand kan lägga till attributer och metoder. Det går även att skapa objekt direkt, utan klass, men då är det främst för att användas som lagringsstruktur, som tex array.  

Det som man behöver särskilt tänka på när man skapar objekt i PHP är syntaxen - för att nå objektets properties används piloperator -> , motsvarigheten i Python är en vanlig punkt. Medan när man assignar ett värde till en attribut (dvs värde till nyckel i ett nyckel-värde par) så använder man den andra "dubbla" piloperatorn =>  så det gäller att inte blanda ihop dessa. I Python motsvarar => ett kolon :. En annan sak som inte är nödvändig att veta för att komma igång med att skapa klasser men som ändå är en bra riktlinje är att man bör håll klasserna små - en klass bör ansvar för en sak. FÖRKLARA HÄR VARFÖR

Strukturen som används var lite svår att förstå - jag lyckades t ex inte hämta från bildmappen till css fil (bakgrund till header) utan fick behålla den stylingen inline direkt i twig som vi gjort i övningen. Jag hade också lite svårt att få till parsning av markdown direkt i twig (som jag kommer använda för redovisningstexterna) så jag fick parsa md-filerna i report-routen istället och därefter skicka de till templaten med 'data' - fungerar men kanske inte så snyggt. Själva upplägget med routes har vi jobbat med i både Python och Databas så den biten var väldigt lik som vi jobbat tidigare.

Det var flera delar i phptherightway som jag tyckte var intressanta. Jag tyckte att det var väldigt intressant att läsa om de olika principerna i S.O.L.I.D under avsnittet om Dependecy Injection. Avsnitten om templates och databaser var också särskilt av intresse eftersom det är relaterat till det vi jobbar med just nu samt eftersom jag just undrade vad fördelarna är med att använda exempelvis twig istället för rena php filer. 

TIL från detta kursmoment är hur man skapar klasser och objekt i PHP.
