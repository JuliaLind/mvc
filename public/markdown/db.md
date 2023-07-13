

Projekt-databasen innehåller följande tabeller:

## User

Innehåller alla registrerade användare. Innehåller epostaddress (används vid inloggning), acronym (spelarens namn som syns på Leaderboard) och lösenordshash.

## Score

Varje gång en användare vinner över huset registreras dennes id, datum och poäng i denna tabell.

## Transaction

Varje gång en användare köper/vinner/satsar/spenderar coins registreras transaktionen i denna tabell med användarens id, datum, kort beskrivning och belopp.  


I databasen är Score och Transaction tabellerna kopplade till User tabellen med hjälp av user_id som foreign key. I applikationen är hela User-objektet ett attribut i varje transaktion/score-objekt. Ursprungligen fanns det även en koppling åt andra hållet, med sk Collection (jag skapade alla relationer med hjälp av Symfony och fick collection-upplägget på köpet), men jag kommenterade bort det i ett senare skede eftersom det gav felmeddelanden om cirkulära referenser i Json controller routsen och det fanns inte några direkta fördelar mot att hämta ut samma information från Transaction/Score Repository med sökning på User.  

Processen med att skapa tabeller med relationer till varandra gick oväntat smidigt, även om jag missförstod och trodde att jag skulle skriva userid i referensen till user tabellen från de övriga tabellerna och tydligen skulle man bara skriva User. Så kolumnen i databastabellen blev döpt till userid_id, men som tur var gick det arr justera det manuellt i efterhand i databasen repsektive Score/Transaction klasserna utan att förstöra någon annan kod.

För testning har jag använt mig av separat testdatabas och Fixtures (som är fejk-data/objekt). Jag har 100%ig kodtäckning av databasklasserna (både de från projektet och biblioteksuppgiften tidigare i kursen) och överlag gick testningen ok även om det var trögt att komma igång och en del som krånglade.  

En av sakerna som krånglade var att jag i projektet först gjorde Datafixtures för user tabellen med samma uppgifter som i den riktiga databasen. Men trots att jag använde egen databas för testning (var\data_test.db) så verkade Symfony blanda ihop de i vissa lägen när värdet som jag sökte på (epostaddress) fanns i både testdatabasen och i den riktiga och hämtade ut data från den riktiga databasen istället. Detta skedde framförallt vid testning av controllers relaterade till databasen och beteende upphörde när jag skapade om Fixtures med tydligt annorlunda uppgifter mot de i riktiga databasen, vilket var väldigt märkligt och jag önskar att Symfony i dokumentationen kunde förvarna om denna typ av problem så att man kan sätta upp testdabasen ”rätt” från början. Därutöver står det på Symfonys webbplats att när man laddar om Fixtures så purgeas hela databasen om man inte använder append, men det framgår inte så tydligt att själva tabellerna inte görs om från scratch - så när man laddar om Fixtures på detta sätt får dessa helt nya idn vilket leder till att alla tidigare tester som gör asserts mot id fallerar. Det tog en del sökning innan jag lyckades hitta hur man kan droppar och göra om hela testdatabasen för att de uppdaterade Fixtures ska få samma idn som tidigare.  

En annan sak som krånglade vid arbetet mot databasen var följande:  

För att kunna registrera en transaktion (eller en score) så behöver man i settern setUser() skicka in hela User objektet. Min första tanke var att jag skulle spara hela user objektet i sessionen, efter inloggning, och plocka ut från sessionen varje gång som en transaktion eller score behöver registreras, eftersom det kändes som smidigare att plocka ut data från session än från databas. Men när jag gjorde på detta sätt uppfattade EntityManager user-objektet som en ny entitet och försökte att registrera igen, vilket såklart ledde till UniqueConstraintViolationException i och med att jag satt så att såväl email som acronym måste vara unika för varje spelare.  

Jag kunde inte hitta något kring vad detta kunde bero på eller hur det kan lösas bland Symfonys dokumentation, men efter en del googlande hittade jag svar i ett chattforum där lösningen som föreslogs var att spara enbart id och hämta ut användaren från databasen, men EntityManager, i samband med att transaktion/score registreras. Det var det enda sättet som EntityManager kunda ha koll på att Usern redan är registrerad sedan tidigare. Vilket är väldigt konstigt tycker jag iochmed att det hade räckt med att kontrollera att objektets id-attribut inte är null för att veta att det redan har blivit registrerat tidigare - så hade iallafall jag skrivit koden om jag hade fått göra det själv.  

För att sammanfatta erfarenheten med ORM så skulle jag säga att det är raka motsatsen mot att arbeta direkt mot/i databasen. Att skriva koden i/mot databas själv i Databaskursen var lätt och intuitivt. MariaDBs dokumentation är samlad, välorganiserad och lättläst med tydliga exmepel och om man råkade göra något fel så var det enkelt att göra om. Jag har upplevt ORM som väldigt abstrakt, krångligt och svårt att greppa och arbeta i - den officiella informationen är begränsad och utspridd. Var man inte försiktig när man gick in och "pillade på" saker (jag försökte att separera på klasserna under Entity och klasserna under Repository till andra namespaces) så kunde hela sidan krascha och därefter gick det inte att "backa tillbaka" överhuvudtaget. Som tur var så laddade jag upp repot till GitHub ofta så det gick att hämta ner sista fungerade versionen därifrån utan att förlora alltför mycket arbete.  

Överlag känns Symfony som att den underlättar arbetet när man behöver enklare funktionalitet och gör allt rätt från början, men så snart man behöver göra något mer avancerat eller behöver ångra/göra om något steg blir det väldigt bökigt och tidskrävande. Många gånger kände jag att på den tiden som jag lade på att söka efter lösningar hade jag likväl kunnat skriva kodbasen själv istället och då haft mycket mer kontroll över vad som sker "bakom kulisserna".

Dock tyckte jag om det objektorienterade sättet att arbeta på med databasklasserna, så nästa gång jag behöver jobba mot databas kommer jag nog försöka mig på liknande kod själv. Jag tror faktiskt att detta sätt hade fungerat riktigt bra i Webshop-sammanhanget också i databaskursen.