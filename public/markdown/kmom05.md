## kmom05

#### Gick det bra att jobba igenom övningen med Symfony och Doctrine. Något särskilt du tänkte/reagerade på under övningen?

Övningen gick smidigt och bra. Jag förväntade mig att ha problem med behörigheter för Sqlite, som jag haft i Webtec-kursen, men blev positivt överraskad över att det inte verkade vara några problem med det denna gång. Eftersom uppgiften inte heller krävde någon mer avancerad programmering i databas på egen hand (där det hade varit till fördel att välja MariaDB som vi jobbat med lite mer) valde jag att fortsätta med Sqlite även i uppgiften. 

Grundkraven i uppgiften var också enkla att lösa. Vi hade ju redan mallar för samtliga routes ifrån övningen och det enda som saknas var en route för reset samt att göra om några av routsen så att de hade stöd för POST, och såklart all html/css som hör till.  

Några av POST routsen löste jag på ett lite annat sätt än vad vi gjort tidigare i kursen. Tidigare har vi ju enbart skickat POST parametrarna via url-sträng vilket jag reagerat lite på redan då eftersom jag tyckte att det var lite konstigt då en av fördelarna med POST just är att man inte behöva visa informationen som skickas, men utgick ifrån att jag troligtvis missat när vi fick förklaring till varför vi skulle göra på detta sätt. Den enda fördelen som jag själv kan komma på är om vill hårdkoda parametrarna och inte har några valbara, så kan man slippa några "dolda inputfält" och bara ha en submitknapp - så i routen för att ta bort en bok använder jag mig exmepelvis av detta sätt. I annat fall, om parametrarna inte är hårdkodade, måste man ju lägga upp javascript för uppdatering av action-länken vilket känns konstigt att göra på en webbplats som ändå är tänkt att ladda om sidan och man därför kan använda formuläret på "ordinarie" sätt.  Dessutom så har ju urlen begränsat antal med tecken - visserligen är gränsen hög, men med tillräckligt många och tillräcklig långa fält så finns ändå risken där. Av dessa anledningar valde jag att i de flesta post-routsen skicka in hela request objektet och inte enskilda parametrar via urlen, men ni får gärna kommentera om det inte är ok att göra på detta sätt.  

Extra-kravet för veckans kmom var något krångligare att lösa, återkommer till det under avsnittet för arbeta med CRUD och ORM men summerat så tyckte jag att Symfony hade "kapslat in" sin connection till databasen så väl att det var riktigt svårt att hitta en väg in för att göra mer än att bara radera från/lägga till objekt-data. 

#### Berätta om din applikation och hur du tänkte när du byggde upp den. Tänkte du något speciellt på användargränssnittet?

I mina tidigare projekt har jag haft knappar/länkar på flera sidor som länkar till samma sida/funktion för att jag tänkt att det är mer användarvänligt att användaren alltid är ett klick bort från funktionaliteten denne vill åt.  Senast i databas-kursen gjorde jag så att man exempelvis kunde slutföra beställning från två olika vyer, man kunde skapa ny order från fler vyer, osv. Detta ökar risken för fel och att fler "scenarion" behöver kontrolleras efter varje ändring för att säkerställa att alla länkar/knappar går dit de ska, rätt metod är angiven i formulär och att inga parametrar eller liknande saknas. Därför har jag gjort det enkelt för mig denna gång - förhoppningsvis kanske även förenkla för användaren att orientiera sig med färre knappar, men det beror på vad som är mest användarvänligt egentligen - färre klick eller färre val/knappar.

1. När man klickar på 'Library' i menyn kommer man till landningssidan.
Här finns det två knappar att välja på - ena för att se alla böcker, andra knappen för att registrera en ny bok.

2. Landningssidan är den enda vyn från vilken man kan skapa en ny bok. Samtliga fyra parametrar för att registrera ny bok är obligatoriska och länken till bild-urlen måste vara uppbyggd som en riktig länk, dvs börja med (http:// eller https://) tex 'https://linktoimg.com', i annat fall ska (bör) inte formuläret gå att klicka igenom . Länken behöver såklart inte fungera, men om den fungerar så har jag kopplat lite javascript med change eventlyssnare som uppdaterar bilden på sidan till den nya direkt. Om den inte fungerar däremot så har jag även en annan eventlyssnare som lyssnar för error och i så fall direkt talar om för användaren att länken inte går till någon bild. I denna vy finns det en knapp för att spara den nya boken och ett kryss högst upp till höger för att backa tillbaka till landningssidan. 

3. Klickar man in sig på översikten över samtliga böcker så finns högst upp en knapp för att återställa biblioteket (när man klickar på den så laddas egentligen in en sql fil till databasen som droppar boktabellen, återskapar den och insertar all ursprunglig bok-information igen).
Högst upp till höger på översikts-sidan finns en länk för att gå tillbaka till landningssidan. Under varje bok finns en knapp för att gå till den bokens enskilda sida. Här funderade jag över om jag skulle ha knappar eller låta hela diven var en länk och visa att objektet är klickbart med animation, men valde knapparna. Kanske inte så snyggt och modernt, men däremot svårare att missa att det är ett interaktivt element.

4. Klickar användaren in sig på en boks enskilda sida så finns det ett kryss till höger om man vill återgå till översikts-sidan, en knapp för att redigera bokens information och en knapp för att radera. Obs! Det kommer ingen extra varning eller fråga när man klickar på radera (i tidigare kurser har jag haft det ibland och ibland inte - fördelen med att ha en extra check är att användaren inte råkar ta bort något av misstag. Nackdelen är att det blir dubbelt så många klick vilket kan bli onödigt tidskrävande för användaren om denne behöver radera många böcker. Ett alternativ skulle kunna vara att användaren själv får bocka i någon form av inställning - om man vill ha den extra kontrollen eller inte).  Vill man backa tillbaka härifrån till översikts-vyn så kan man klicka på krysset uppe till höger.

5. I redigeringsvyn för den enskilda boken går det att ändra all data: titel, isbn, författare och url länk till bild. Isbn nummer är ok att redigera eftersom själva uppdateringen kommer att ske mot bok-objektets id (som är ett dolt fält i detta formulär), men isbn numret måste ändå vara unikt så fyller man i samma som någon annan bok har så blir man omdirigerad tillbaka med flashmeddelande om att det redan finns en annan bok registrerad med samma isbn nummer. Jag har lagt till constraint för det i databasen för att sökningen på isbn nummer ska ge enskilda resultat och samtidigt slippa en if check vid registrering/uppdatering av isbn - och istället fånga upp UniqueConstraintViolationException i routen, men av någon aledningen lyckades jag inte fånga den trots att jag gjort på samma sätt som när jag fångad exception i spel-klassen så det fick bli if-kontroll i dessa routs ändå. Men åtminsone har vi säkerställt att de inte blir dubletter om man läser in data till SQL direkt från fil. Vill man backa tillbaka så klickar man på krysset uppe till höger.  



#### Gick det bra att jobba med ORM i CRUD eller vad anser du om det, jämför gärna med andra sätt att jobba med databaser?  Vad är din uppfattning om ORM så här långt och relatera gärna till andra sätt att jobba med applikationskod mot databaser?  


Själva konceptet med ORM tyckte jag om väldigt mycket, det känns som att det minskade kodmängden rejält att ha metoder för hantering av en tabell inkapslade i en klass, och att varje rad i tabellen är en instans av klassen. Överlag tycker jag alltmer om att jobba objektorienterat jämfört med fristående funktioner, särskilt i PHP som är så pass flexibelt och man kan såväl dela Traits mellan klasser som låta objekt använda/ta emot olika typer av klasser sålänge som de har samma interface. Jag önskar att jag hade kommit på att jobba lite mer på detta objektorienterade sätt i webshopen i Databaskursen, jag tror att min kod hade blivit både renare och lättare att sätta sig in i för en utomstående.  

Symfony gjorde det också enkelt att jobba mot databasen på en "enklare" nivå genom att göra grundjobbet åt en. Det var bra att det fanns möjlighet till att skapa egna select-satser, även om jag inte tyckte att det var enklare på något sätt än att skriva dessa i ren SQL. Såhär långt har vi arbetat med enskilda objekt/tabeller i ORM och jag är lite nyfiken på om det hade känts lika smidigt om vi hade haft flera tabeller/klasser som är relaterade till varandra, framförallt många till många relationer. 

Nackdelen med att jobba via Symfony gav sig som sagt till känna när jag skulle implementera möjlighet till återställning av databas via webbplatsen. Att spara backup av och återställa en hel databas har vi ju lärt oss tidigare - i sqlite finns det dessutom tre sätt att göra det på: 

1. dumpa innehållet till sql fil och läsa in från den  

2.  kopiera databasen till annan db fil och restora data från den.  

3. Skriva ner all SQL som behövs för att återskapa databasen och läsa in den  


Det tredje alternativet motsvarar nr 1 men lite dubbeljobb i detta fall att behöva skriva SQL kommandona efter att databasen redan är skapad. Min tanke var att använda 1 eller 2 först och det fungerade bra att göra på detta sätt via terminalen. Att däremot få till funktionalitet för återställning av databas via knapp på webbplatsen visade sig bli mycket svårare då det inte var så jättetydligt hur man skulle gå tillväga för att skicka in "egen" SQL kod till databasen via Synfony-applikationen. Det var många filer som låg i vendor/doctrine-mappen, mycket som jag tyckte var svårt att förstå eller följa alla relationer mellan klasser.  Jag kunde inte heller hitta svar på min fråga via den länkade dokumentationssidan.  

Till slut så hittade jag (eller rättare sagt googlade mig till) hur man kan hämta en connection via getConnection() från manager. Jag skapade en egen klass som läser in data från SQL fil och sedan skickar in den till databas via connection som skickas in som en parameter i konstruktor till objektet. Här kom nästa problem - det gick inge vidare att använda "dot-commandon" och det verkade som att man inte ens fick använda dot-commandon inne i SQL filen för att läsa in csv-filer med tabell-datan (sql filen fungerade när jag läste in den via terminalen, men när jag skulle gör motsvarande från Symfony sade Symfony ifrån).  

Jag är inte helt säker på varför dessa kommandon inte fungerade men misstänker att detta har att göra med "connection" som jag använt mig av eftersom lintern klagade över det också, men det var det enda sättet som jag kunde hitta och det var som sagt otroligt svårt att försöka förstå sig på den omfattande underliggande koden för att på egen hand hitta vad jag behöver göra annorlunda.

Hur som helst så fick jag motvilligt använda mig utav det tredje alternativet och dessutom hårdkoda in datan som skulle in i tabellerna istället för att läsa in från csv. Iochmed att jag ändå kunde bestämma vilka delar som skulle vara i SQL filen (istället för om jag skulle återställt hela databasen från backup fil) så har jag valt att filen enbart innehåller det som behövs för att reseta book-tabellen, inga andra tabeller som finns i databasen (i nuläget "product-tabellen" från övningen) kommer att påverkas - vilket iofs kan vara en fördel.

En annan svårighet som jag upplevde var att jag i samband med framförallt den autogenererade koden, men även koden som kom från instruktionerna, fick en massa fel i linterna. Dessa fel tyckte jag var mycket svårare att förstå och jag hade inte heller tiden att sätta mig in i så jag har valt att kommentera bort stora delar av felaktigheterna i phpstan och i phpmd, men det tog emot att göra så eftersom det känns lite som att fuska - jag vill ju egentligen att min kod ska vara "ren" på riktigt, inte bara dölja delar som inte är ok.  Med det sagt så tycker inte jag att lintern alltid har rätt kring vad som är snygg kod - detta med korta variabelnamn är exemeplvis ett konstigt påpekande iochmed att även korta namn såsom "id" kan vara beskrivande och att det känns vettigt att döpa variabeln/attributet "id" och inte "bookId" om det är ett attribut i Book-klassen eftersom det är underförstått att id:t syftar till bokens id och inte något annat.


#### Vilken är din TIL för detta kmom?

Veckans TIL är:

1.  Hur man arbetar med Object Relational Mapping och hur man automatiserar själva mappningen/skapandet av klasserna/upprättandet av databas via Symfony  

2. Att man kan göra om objekt till Array och skicka in den arrayen i twig template - det ger tydligen möjlighet att läsa av värden även på privata attribut utan getters. Varför har jag inte känt till detta i tidigare kursmoment? Skulle sparat både kodrader och tid :) 

