

Projekt-databasen innehåller följande tabeller:

## User

Innehåller alla registrerade användare. Innehåller epostaddress (används vid inloggning), acronym (spelarens namn som syns på Leaderboard) och lösenordshash.

## Score

Varje gång en användare vinner över huset registreras dennes id, datum och poäng i denna tabell.

## Transaction

Varje gång en användare köper/vinner/satsar/spenderar coins registreras transaktionen i denna tabell med användarens id, datum, kort beskrivning och belopp.  


I databasen är Score och Transaction tabellerna kopplade till User tabellen med hjälp av user_id som foreign key. I applikationen är hela User-objektet ett attribut i varje transaktion/score-objekt. Ursprungligen fanns det även en koppling åt andra hållet, med sk Collection (jag skapade alla relationer med hjälp av Symfony och fick collection-upplägget på köpet), men jag kommenterade bort det i ett senare skede eftersom det gav felmeddelanden om cirkulära referenser i Json controller routsen och det fanns inte några direkta fördelar mot att hämta ut samma information från Transaction/Score Repository med sökning på User.  

Processen med att skapa tabeller med relationer till varandra gick oväntat smidigt, även om jag missförstod och trodde att jag skulle skriva userid i referensen till user tabellen från de övriga tabellerna och tydligen skulle man bara skriva User. Så kolumnen i databastabellen blev döpt till userid_id, men som tur var gick det att justera det manuellt i efterhand i databasen repsektive Score/Transaction klasserna utan att förstöra någon annan kod.

För testning har jag använt mig av separat testdatabas och Fixtures (som är fejk-data/objekt). Jag har 100%ig kodtäckning av databasklasserna (både de från projektet och biblioteksuppgiften tidigare i kursen) och överlag gick testningen ok även om det var trögt att komma igång och en del som krånglade.  

En av sakerna som krånglade var att jag i projektet först gjorde Datafixtures för user tabellen med samma uppgifter som i den riktiga databasen. Men trots att jag använde egen databas för testning (var\data_test.db) så verkade Symfony blanda ihop de i vissa lägen när värdet som jag sökte på (epostaddress) fanns i både testdatabasen och i den riktiga och hämtade ut data från den riktiga databasen istället. Detta skedde framförallt vid testning av controllers relaterade till databasen och beteende upphörde när jag skapade om Fixtures med tydligt annorlunda uppgifter mot de i riktiga databasen, vilket var väldigt märkligt och jag önskar att Symfony i dokumentationen kunde förvarna om denna typ av problem så att man kan sätta upp testdabasen ”rätt” från början. Därutöver står det på Symfonys webbplats att när man laddar om Fixtures så purgeas hela databasen om man inte använder append, men det framgår inte så tydligt att själva tabellerna inte görs om från scratch - så när man laddar om Fixtures på detta sätt får dessa helt nya idn vilket leder till att alla tidigare tester som gör asserts mot id fallerar. Det tog en del sökning innan jag lyckades hitta hur man kan droppar och göra om hela testdatabasen för att de uppdaterade Fixtures ska få samma idn som tidigare.  

En annan sak som krånglade vid arbetet mot databasen var följande:  

För att kunna registrera en transaktion (eller en score) så behöver man i settern setUser() skicka in hela User objektet. Min första tanke var att jag skulle spara hela user objektet i sessionen, efter inloggning, och plocka ut från sessionen varje gång som en transaktion eller score behöver registreras, eftersom det kändes som smidigare att plocka ut data från session än från databas. Men när jag gjorde på detta sätt uppfattade EntityManager user-objektet som en ny entitet och försökte att registrera igen, vilket såklart ledde till UniqueConstraintViolationException i och med att jag satt så att såväl email som acronym måste vara unika för varje spelare.  

Jag kunde inte hitta något kring vad detta kunde bero på eller hur det kan lösas bland Symfonys dokumentation, men efter en del googlande hittade jag svar i ett chattforum där lösningen som föreslogs var att spara enbart id och hämta ut användaren från databasen, men EntityManager, i samband med att transaktion/score registreras. Det var det enda sättet som EntityManager kunda ha koll på att Usern redan är registrerad sedan tidigare. Vilket är väldigt konstigt tycker jag iochmed att det hade räckt med att kontrollera att objektets id-attribut inte är null för att veta att det redan har blivit registrerat tidigare - så hade iallafall jag skrivit koden om jag hade fått göra det själv.  

När det kommer till likheter mellan sättet vi arbetade på med databas i denna kurs och hur vi arbetade i Databaskursen så var nog den enda gemensamma faktorn  - strukturen på tabellerna. Att user är en tabell, transaction är en och score är en och att man sedan använder user_id som främmande nyckel för att koppla tabellerna i en till många relation. Det kan tex jämföras med att customer är en tabell och order är en annan och order har främmande nyckel customer_id för att koppla order till kund i en en-till-många relation. I mitt projekt hade jag inga många till många relationer som behövde egen tabell för att representera själva relationen men jag misstänker att Symfony skulle ha löst det på motsvarande sätt, med en separat tabell som sammankopplar datan i tabelllerna i en en-till-en relation.  

Skillnaderna mellan sätten att arbeta på var:  

1. När jag hämtade ut datat från databasen i Databaskursen så gjordes inte raderna om till objekt utan all data hanterades som array. Att göra om datan till objekt gör koden renare, och än mer fördelar kan man få ut om man lägger till metoder som kan "göra saker" i objektet utöver getters och setters. Jag lade dock inte till några egna metoder i entitets-klasserna i detta projektet, men kan absolut se hur detta hade kunnat implementeras i Webshopen i Databaskursen.
2. I databaskursen lade vi all logik som hade med databasen att göra i databasen, medan Symfony har inte lagt till någon logik där (jag dumpade databasen till SQL fil och undersökte vad som låg där, och det fanns inga lagrade procedurer eller så sparade) vilket innebär att alla select-satser osv hanteras ute i applikationen. I detta avseende tycker jag mer om hur vi jobbade i Databaskursen där den enda SQL koden som hanterades ut i applikationen var CALL till olika stored procedures. 

Om jag skulle jobba med databas igen där jag går bygga all kod själv, som i databaskursen så tror jag att jag skulle använda mig av en kombination av båda sätten. Jag skulle lägga så mycket som möjligt av logiken som hör till databasen i databasen, men sedan skapa Entity-klasser som representerar tabellerna/tabellraderna och "baka in" de lagrade procedurer som hör till respektive tabell in i respektive entitets-klass. Det tror jag skulle kunna bli en riktigt snygg lösning.

För att sammanfatta erfarenheten med ORM så skulle jag säga att det är raka motsatsen mot att arbeta direkt mot/i databasen. Att skriva koden i och mot databas själv i Databaskursen var lätt och intuitivt. MariaDBs dokumentation är samlad, välorganiserad och lättläst med tydliga exmepel och om man råkade göra något fel så var det enkelt att göra om. Jag har upplevt ORM som väldigt abstrakt, krångligt och svårt att greppa och arbeta i - den officiella informationen är begränsad och utspridd. Var man inte försiktig när man gick in och "pillade på" saker (jag försökte t ex att separera på klasserna under Entity och klasserna under Repository till andra namespaces) så kunde hela sidan krascha och därefter gick det inte att "backa tillbaka" överhuvudtaget. Som tur var så laddade jag upp repot till GitHub ofta så det gick att hämta ner sista fungerade versionen därifrån utan att förlora alltför mycket arbete. T ex kunde jag inte hitta någon som helst information i Symfonys dokumentation kring hur man återställer databasen - så för att klara uppgiften upplevde jag att man behövde ha bakgrundskunskaper i databas... och om man har kunskaper i databas så kan jag inte riktigt se fördelarna med att jobba i Doctrine mot att skapa all kod själv som vi djorde i Databaskursen, bara nackdelar i form av att det varit mer tidskrävande och därmed även känts begränsande i och med att jag inte vågat göra något mer avancerad med tanke på att även de enklare sakerna som hade gått snabbt att lösa på egen hand tog lång tid att lösa i Symfony.



