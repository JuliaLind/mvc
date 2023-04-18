## kmom03

Det jag tyckte var svårast med kursmomentet (förutom att försöka lösa en redirect mellan två POST routes, vilket jag inte lyckades med) var fördelning av kod mellan klasser. Det finns så många sätt att göra det på och det är svårt att veta innan jag behöver återanvända klasserna/bygga ut spelet vilka delar respektive klass ska ansvara för. Ett exempel på det är när kort delas ut från däcket, jag har skrivit koden så att hela däcket skickas in till handen och inuti handen plockas sedan kort ut från däcket. Men det kanske skulle vara bättre att göra så att korten plockas ut från däcket utanför och att det är kortobjekt som skickas in i handen, och inte hela däcket? Jag misstänker att jag kommer att behöva skriva om en del av koden i kommande kursmoment, precis som jag behövde justera koden en del från förra kursmomentet. 

Jag har valt att strukturera koden med både inheritance och genom att använda traits för att undvika att skriva samma kodstycken flera gånger. Jag har också skapat ett interface - det hade egentligen inte behövts såsom koden är strukturerad nu men jag ville prova på för att säkerställa att jag förstått hur man använder det. Och det skadar inte heller att det ser snyggare ut i routen att skriva 'Game21Interface' istället för att speca 'Game21Easy|Game21Med|Game21Hard' :) Det som hade kunnat förbättras är att plocka ut ytterligare delar från klass till traits, och eventuellt till egna klasser. Men det får jag se över om det finns behov för i kommande kursmoment . 

En annan sak som jag tyckte var svår var att linterna tvingade en att speca typer på de olika parametrarna och attributen samt returvärden, det krånglade till koden en hel del eftersom inparametrar på ett ställe var tvungna att matcha returvärden på ett annat, det krånglade till det något med att använda arv såsom jag tänkt i början (jag hade tänkt att ha en singleplayer game som skulle ärva från Game och som Game21 klassen skulle ärva från. Då hade det varit relativt enkelt att ändra Game21 till en multiplayer-spel längre fram genom att ändra till extends MultiPlayerGame istället). 

Att ersätta klasser med interface löste inte just det problemet eftersom klasserna jag ville använda hade några publika properties och det gick inte att definiera properties i interfacet, så att då sade linten ifrån att man försökte komma åt en odefinierad property. Det kändes onödigt att skapa getter metod för en property som likväl kan göras publik och hämtas rakt av, så den bästa lösningen blev att minska antalet arvssteg. Om jag behöver återanvända kod någon annanstans så kommer jag att plocka ut de delarna till traits, det är enkelt att göra det utan att påverka gränssnittet mot användaren. Såhär i efterhand så kan man faktiskt göra motsvarande lösning med traits, att man skapar en för singleplayer och en för multiplayer och kan då enkelt ändra ett spel från ensam spelare till fler spelare om man vill fortsätta utveckla på det.  

Just när det kommer till att göra properties publika eller inte så var jag också lite fundersam när det kom till attributet $money hos Player klassen. Jag vill ju att man ska kunna komma åt att se värdet i attributen direkt så att det är publikt på det sättet. Men jag vill samtidigt att man behöver använda metoder för att ändra på det värdet (incrMoney och decrMoney). Det hade varit bra om det hade gått att definiera på något sätt att propertyn är publik för att läsa av den men inte för att ändra på den, men misstänker att det inte går att göra så.

Hittills tycker jag nog att klasser i PHP är rätt svåra att arbeta med pga detta med typerna, mycket svårare än i OOPython-kursen.  Det kan iofs ha att göra med att jag satt nivån på PHPStan till 9, men jag vill inte sätta den till lägre för det är lika bra att vänja sig att skriva koden "på rätt sätt" redan från början eftersom det annars kan bli svårt för mig att vänja om senare.  Dessa nackdelar vägs dock upp när man behöver jobba mot session av att instanser av PHP klasser går att spara i sessionen och återskapa från sessionen direkt utan att själv behöva ta ut datan från objektet till arrayer och sedan återskapa objekten som "nya" och läsa in datan från sessionen manuellt, som ju är fallet i Python.

Förutom specandet av typerna så var det en annan sak som jag tyckte att lintern är orimligt strikt kring (men som jag ändå motvilligt skrev om för att passera testerna) och det var detta med att man inte ska använda "else". I de flesta fall kunde jag endast skriva "bort" else genom att definiera else villkoret som default först, dvs  



```
a = 5;
if (b = 7) {
    a = 8;
}
```



istället för:  


```
if (b = 7) {
    a = 8;
} else {
    a = 5;
}
```

  
och personligen tycker jag att det senare alternativet är mer lättläst för det står precis i den ordning som man tänker. Det känns konstigt att definiera ett värde först, och sedan definiera om det efter test för villkor. Och varför finns ens alternativet else om det inte är bra att använda det?

I nuläget är jag nöjd med koden som den är. Jag har varit sparsam med logik i routerna och det mesta av logiken ligger i klasserna och sedan har jag några få if satser i template som avgör vilka knappar som ska synas för användaren (dvs vilken knappvy som ska inkluderas i templaten). Alternativet har varit att ha flera templates och att lägga den logiken i routen istället.  Game21Easy-klassen kanske blev lite väl lång och jag kan som sagt se några delar som eventuellt skulle kunna lyftas ut till egen klass/klasser.

Jag har gjort en del manuella tester för att kontrollera funktionaliteten men ser fram emot nästa vecka när vi får lära oss hur man kan automatisera testningen. Det omständligaste att testa manuellt var att banken verkligen baserar sina drag på statistiken samt att statistiken beräknas rätt - jag körde ett par rundor där jag parallellt antecknade i excelark vilka kort som var borta ur spelet och gjorde manuell beräkning av statistiken, men det blir svårt att fånga upp specifika fall när korten slumpas fram så det skulle underlätta om jag kunnat mocka returvärden från vissa av metoderna. 

När det kommer till funktionalitet så finns det utrymme för att utveckla spelet. Exempelvis skulle man kunan ge användaren möjlighet att i början på spelet välja om statistiken för att bli tjock med nästa kortdrag ska visas per default eller inte. I det senare fallet skulle man då istället kunna visa en knapp som användaren kan klicka på om denne vill visa statistiken (knappen skulle då har lite javascript kod kopplad till sig som ändrar display-värde (none/block) på html elementet som innehåller statistiken). Man skulle även kunna göra det mer intressant genom att begränsa antal gånger som användaren får använda knappen.  


Pseudokod är ett bra sätt att skissa på ett problem och på sätt och vis har jag använt mig av det tidigare, men inte på ett strukturerat sätt som i detta kursmoment utan in form av kortare minnesanteckningar i telefonen. Flödesdiagram hade jag kunnat klara mig utan i planeringsstadiet - det var inget stort program och att skriva ner något som jag redan hade färdigt i huvudet tog bara av tiden i onödan eftersom det tar sin tid att placera ut element så att diagrammet blir översiktligt, men skapar man ett sådant diagram i efterhand så antar jag att det blir till hjälp för den som läser koden sen.  Jobbar man i grupp så underlättar nog ett sådant diagram att dela upp helheten i mindre delar på ett vettigt sätt.

Fördelen som jag sett hittills med att använda Symfony och twig istället för att själv blanda html och php är möjligheten till att ha routes i egen/egna filer och att de filerna då blir som en slags brygga mellan klasserna och templaterna. Det är ett bra sätt att få in mycket logik men ändå hålla de logiska och "icke-logiska" delarna separata. Jag gillar också att det går att dela upp/gruppera kod på ett bra sätt med hjälp av namespace och därmed även återanvända klassnamn.  

En nackdel är att det är ovant och svårare att navigera eftersom jag inte riktigt känner att jag har full koll på vad som händer "bakom kulisserna" - tex som redirect till en POST-route. Till följd av detta kan man i "mitt" spel "fuska till sig" omgångar utan bettning genom att gå ur spelet i vyn där man väljer belopp att betta (exempelvis genom att klicka på någon av länkarna i navbaren) och sedan klicka på knappen för återupptagande av spelet. Här hade jag velat lägga in en redirect om det är spelarens tur om det inte ligger några pengar i potten men routen som spelaren väljer belopp är en POST route så det gick inte.  

Det är också svårt att förstå hur man går tillväga för att få till relativ sökväg till bilder och jag har inte lyckats klura ut än hur man kan nå en bild från CSS stylesheet för att kunna använda som bakgrundsbild.  

En annan sak som jag tänkt på är att jämfört mot när vi använde Jinja templates i OOPython saknade jag möjlighet att kunna skicka in hela objektet till templaten för att kunna använda dess metoder inne i templaten - det kan dock vara så att jag bara inte lyckats klura ut hur man gör. Jag fick iallafall lyfta ut data från objekten till arrayer/strängar/siffror i routsen och därefter skicka in i templaten - vilket blir motsatsen till det som vi lärde oss var "rätt" sätt att skriva kod på i OOPython kursen.  


TIL från detta kursmoment är hur man skapar och använder traits samt interface.
