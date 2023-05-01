## kmom04

#### Berätta hur du upplevde att skriva kod som testar annan kod med PHPUnit och hur du upplever phpunit rent allmänt.

Jag har lite erfarenhet av att skriva egna testklasser från OOpython kursen, och tycker att enhetstestning är ett fantastiskt verktyg, framförallt om man skriver testerna först. Det blir så mycket enklare att veta när man är klar och vara trygg i att allt fungerar som det ska. 

Manuella tester blir otroligt tråkiga efter ett par omgångar, tar väldigt mycket tid och kräver ens närvaro vilket begränsar hur ofta de utförs och det finns risk för att man missar att testa någon del (antingen av misstag eller med flit pga lathet/tisbrist för att man tänker att den delen inte bör ha påverkats av senaste ändringen). Risken att missa något finns såklart även i autmatiska tester men är avsevärt lägre eftersom man kör samtliga tester varje gång och det är enklare att säkerställa att alla fallen faktiskt täcks in, framförallt när man använder mock objekt och kan "fejka" alla möjliga returvärden. Det blir därför också mer motiverande att fortsätta förbättra befintlig kod (refactoring) eftersom det är möjligt att testa ofta och på så sätt tidigt fånga upp om man råkar skapa en bugg någonstans.

Fördelen med testverktyget i PHP jämfört mot den vi använde i Python är att vi också får en visuell representation av vilka delar av kod som täckts in och med hur många/vilka metoder. Detta är en bra extracheck så att man åtminstone täckt raderna en gång och med den metoden som är avsedd för ändamålet (dvs inte oavsiktligt via test av annan metod).  

Jag tyckte nog att det var roligare att skriva tester än att skriva själva koden som testas :)


#### Hur väl lyckades du med kodtäckningen av din kod, lyckades du nå mer än 90% kodtäckning?

Jag har 100% kodtäckning i klasserna relaterade till 21 spelet (Cards namespace och Game namespace). 

Jag har inte skrivit några tester för spelets controller för att jag inte förstår hur jag ska kunna mocka session/returvärden från session och även fånga upp att redirect är rätt. Men jag har ytterst lite logik i game21 routen - jag har en switch case som bestämmer om det är en Game21Easy eller Game21Hard instans som skapas i init routen, samt en if i main-routen som kollar om det finns en 'game'-nyckel i sessionen eller inte. I de övriga routerna så anropas helt enkelt ett antal metoder i instansen av spelklassen rakt av och sedan antingen redirectar routen till en annan route eller renderar en template som den skickar in data i. Om jag kan mocka sessionen som skickas in i routen så kan jag göra en mock av spelklassen och då helt enkelt kontrollera med expects om metoderna anropas som de ska. Att metoderna i sig gör det de ska behöver vi ju inte kontrollera i testerna för routern för det har jag ju redan kontrollerat i testerna för spelklassen.

100% täckning behöver dock inte betyda att min kod är helt säkrad. Jag har bara "nått" den ljusgröna färgen, dvs att testerna täcks av stora tester. Jag har inte klurat ut än hur jag ska gå tillväga för att skapa sådana mindre tester som behövs få att nå den "mörkgröna" färgen. Jag tycker ändå att jag har begränsat mina tester så mycket det går - jag har små metoder och testar varje för sig genom att sätta objekten manuellt i olika states och jag mockar beroenden/klasser i majoriteten av testerna. Främsta anledningen till att jag ville mocka beroenden så mycket det går, även när jag inte var ute efter specifika returvärden är för att jag inte vill "oavsiktligt täcka" delar av kod som jag egentligen inte testar bara för att de raderna anropas och till följd av det göra code-coverage filerna missvisande. Den andra anledningen är att om någon av testerna fejlar så blir det enklare för mig att se exakt vilken klass och metod felet ligger i, dvs att om det finns en bugg i en klass så kan testerna ändå visa att den andra klassen som använder klassen med buggen i fungerar som den ska. 

Jag har inte heller skrivit tester för om man anropar metoder med "dåliga" argument, även om jag är medveten om att man bör göra det för att säkerställa att koden då inte genomförs. Anledningen till att jag inte gjort det är att jag inte har skapat ngn särskild hantering för de fallen och när ja började skriva tester för dåliga argument så insåg jag att flera av metoderna inte kommer att "säga ifrån" fel argument, trots att jag i enlighet med linterns "instruktioner" specat av vilken typ inparametrarna måste vara. Om vi tar konstruktorn för Player klassen som exempel:

```
/**
 * Constructor
 * @param string $name - Name of the player
 */
public function __construct(string $name)
{
    $this->name = $name;
    $this->hand = new CardHand();
}
```

Om någon skulle få för sig att skicka in en integer istället för sträng, så kommer det gå igenom även om det är fel, och sedan kommer felet upptäckas i någon annan metod där namn ska läggas ihop med annan sträng och systemet kommer säga ifrån att integer inte kan läggas ihop med string. Alternativen hade varit att alltid omvandla den inkommande parametern till sträng eller lägga till en if som lyfter exception om parametern är av annan typ en sträng. Men båda är ju extra kod och som jag förstår det ska vi utgå ifrån att användaren vet av vilken typ som argumenten behöver vara?  

Jag blev ändå något förvånad över att testet passerade i detta fall eftersom jag fram tills nu trott att anledningen till att lintern tvingar en att speca typer på in-, ut-parametrar och på attribut i klasser är att det sedan endast ska gå att använda den typen som har specats och inget annat, men det verkar ju inte göra någon skillnad eftersom jag kunde skicka in en integer i denna metod istället för sträng och phpunit testet passerade utan problem - är den enda vitsen med att skriva ut typerna att det ska bli rätt i dokumentationen?

#### Upplever du din egen kod som “testbar kod” eller finns det delar i koden som är mer eller mindre testbar och finns det saker som kan göras för att förbättra kodens testbarhet?

Jag tycker att modellklasserna har varit enkla att testa. Jag gjorde dock vad jag misstänker är en "fuling" och skapade en trait med getter och setter metoder som jag använder i spel-klassen för att manuellt kunna sätta spelobjektet som jag testar i olika states och även mocka klasser som vissa attribut utgör (istället för att lägga till de som optionella värden i konstruktorn) och på så sätt kunna testa olika metoder oberoende av varandra och även i hög grad oberoende av andra klasser. 

Det som har kunnat skrivas om i koden ytterligare för att underlätta testning är att CardHand klassens draw metod skulle ta emot ett kort och inte hela kortleken. Dvs att kortleken delar ut ett kort utanför hand-klassen och handen plockar sedan det kortet. Just nu ser min kod ut så att hela kortleken skickas in till kortklassen tillsammans med en siffra som anger antal kort som ska plockas och därefter plockas det antalet kort från kortleken inuti kort-klassen. Alternativet med att skicka in kort istället för kortlek skulle dock innebära att loopet för flera kort hamnar utanför handen och därmed skulle NoCardsLeftException som kastas när korten är slut i kortleken då skulle behövt fångas på flera ställen istället för en, vilket iofs inte nödvändigtvis behöver vara en nackdel. Om vi ska fortsätta att utveckla på samma kod i fler kursmoment så kommer jag se över om jag ska göra denna ändring och vad det i så fall kommer att innebära för resten av koden.


#### Valde du att skriva om delar av din kod för att förbättra den eller göra den mer testbar, om så berätta lite hur du tänkte.

För att underlätta testning flyttade jag på funktionalitet mellan klasser - när en metod använder returvärden från en annan metod så kan man mocka returvärdena om metoden som anropas ifrån den andra ligger i annan klass men inte om de ligger i samma klass, i det senare fallet måste man manuellt "framkalla" det returvärde som man vill ha från den anropade metoden. Därför blev testningen avsevärt lättare om jag flyttade risk-beräkningsmetoden från spel-klassen till spelare-klassen och därmed kunde mocka den beräknade risken för att banken blir tjock, när jag skulle testa dealBank metoden i spel-klassen, istället för att manuellt framkalla rätt risk, genom att mocka returvärden från hand och kortlek.  

Jag lade även till en trait med setter/getter metod som jag use i spel-klassen för att underlätta att göra testningen av varje del så oberoende som möjligt av andra metoder i klassen samt andra klasser. Jag tänker att den ju är enkel att kommentera bort när man är färdig med testningen om man inte vill att dessa getters/setters ska vara tillgängliga publikt egentligen.

Och jag har även lagt till optionella parametrar i konstruktor och/eller setter metoder i några av de andra klasserna för att vid testning kunna mocka de klasser som utgör attribut i dessa klasser. 

Jag gjorde också om några av de privata metoderna till publika - exempelvis hade jag tidigare en publik metod som bestod av tre privata och för att underlätta testning av varje metod enskilt så tog jag bort den publika metoden och gjorde istället de privata till publika. Jag tycker dock egentligen inte att detta var ett bra lösning, eftersom att tidigare så hade jag mer flexibilitet kring hur koden inuti den "sammansatta" publika metoden kunde se ut. Men nu måste det förbli tre metoder utåt sett och skulle jag längre fram vilja slå ihop två av de eller vilja att den ena returnerar ett värde som den andra ska ta emot som inparameter så kommer koden att behöva anpassas även av användaren utanför klassen.

En sak som jag upptäckte var att traits var mycket enklare att testa än klasser, iochmed att jag kunde testa en trait genom att 'use' den i testklassen och på så sätt kunna komma åt att ändra/testa även privata attribut. Såhär i efterhand funderar jag därför på om jag istället för att göra om de privata metoderna till publika, borde ha plockat ut de till egen trait och på så sätt kunna testat individuellt genom att testa traiten. 

#### Fundera över om du anser att testbar kod är något som kan identifiera “snygg och ren kod”.

Att alla delar av koden går att testa tycker jag är en förutsättning för ren kod. Om någon del inte går att testa på ett automatiserat sätt så kan vi ju inte vara helt säkra på att den fungerar som den ska. Allt som behöver testas manuellt av en fysisk person innebär risk för att den mänskliga faktorn spelar in och man missar eller med flit hoppar över någon del i testet som man tror sig vara säker på kommer fungera. 

Däremot vet jag inte om jag tycker att testbar kod också är snygg, för min del kändes det som att jag behövde "fula till" koden en del för att göra den testbar. Tillexempelså tycker jag att snygg kod bör bestå av få publika metoder som i sin tur består av flertal mindre privata metoder. Det ger flexibilitet att senare kunna slå ihop de privata metoderna till färre eller tvärtom dela upp i flera, byta ordning osv utan att det påverkar det publika gränssnittet. Att inte kunna testa de privata metoderna separat utan att göra de publika tycker därför är ett hinder för att hålla antalet publika metoder få och att dölja delar av implementationen som inte är av vikt för användaren utanför klassen. Det känns konstigt att användaren ska behöva anropa tre metoder istället för en - onödigt krångligt.

Alternativet är att behålla de privata metoderna privata och testa de via den publika, men jag tycker inte att detta är ett bra alternativ heller. Jag tycker att varje enskild metod bör ha minst ett enskilt test och på så sätt kan testerna enklare vägleda oss om felet ligger i metoden som anropar eller metoden som anropas. Ju mindre delar som går att testa separat desto enklare blir det att hitta var felen i koden ligger.


#### Vilken är din TIL för detta kmom?

- Hur man använder php unit för att testa sin kod och kontrollera vilka delar testerna täcker. Att mocka instanser av andra klasser och mocka returvärden från dessa både om värdet ska vara samma vid flera anrop eller skilja sig mellan anropen. Samt även med hjälp av expects kontrollera om en metod har anropats på en mock exakt så många gånger som förväntats och med exakt de argument som förväntats.  

- Hur man kan autogenerera snygg och lättläslig dokumentation med hjälp av phpdoc. Vi har använt ett annat verktyg för autogenerering av dokumentation i JavaScript kursen och jag måste säga att PHP varianten är mycket bättre och modernare. Det är framförallt lättare att förstå hur man dokumenterar på rätt sätt. Men även den färdiga dokumentationen är mycket mer användarvänlig att navigera i. När dokumentationen ser ut på det sättet blir man såklart mycket mer motiverad till att använda sig av verktyget.
