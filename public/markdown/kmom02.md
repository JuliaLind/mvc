## kmom02

Arv används när vi behöver utöka eller specialisera en basklass. Basklass kallas också för superklass. I PHP kan kan man ifrån subklasssen (så kallas en klass som ärver från basklassen) komma åt de attribut i superklassen som är protected men inte de som är private. Utanför basklass/subklass kan man bara komma åt public så utanför är det ingen skillnad på privat och protected. När vi överlagrar en metod eller attribut i subklassen kan vi gör den mer öppen, tex kan vi göra en protected metod till publik, men vi kan inte göra åt andra hållet - göra en protected metod till privat. Tanken är att en subklass ska på alla ställen kunna ersätta basklassen.

I PHP kan en klass inte ärva från flera klasser och det är här Trait kommer in i bilden. En trait består av metoder och attribut som kan användas för att utöka funktionaliteten hos en klass - när en klass använder (use) en trait så får klassen en kopia/uppsättning av alla metoder och medlemsvariabler i traiten. En klass kan använda sig av flera Traits. Och flera olika klasser kan använda en och samma trait. På detta sätt kan vi återanvända återkommande kod på ett effektivt sätt.

Komposition är en relation mellan två klasser där en klass skapas och existerar inuti en annan och kan inte existera på egen hand utanför den. Om en instans av den ägande klassen tas bort så försvinner även de "tillhörande" instanserna av den "ägda" klassen. Ett exempel på det skulle kunna vara en klass som representerar ett hus och en subklass som representerar ett rum. Ett rum kan inte finnas utanför ett hus så om huset "rivs" så försvinner även rummet. 

Ett interface kan ses som ett kontrakt där en klass som använder (use) interfacet förbinder sig att implementera en viss uppsättning metoder som interfacet kräver. Interfacet sätter inga krav på hur dessa metoder ska implementeras utan endast på att de behöver finnas. På så sätt behöver vi inte i en annan klass speca exakt vilken klass som den kan ta emot som inparameter i en funktion utan vi kan speca att alla klasser går bra så länge som de har implementerat ett visst interface eftersom vi då vet att metoderna som behövs erbjuds av instansen av den klassen. 

Jag har valt att använda arv på två ställen - CardGraphic ärver från Card och DeckOfCardsExt (med jokrar) ärver från DeckOfCards (utan jokrar). Jag har dock valt att använda DeckOfCards utan jokrarna i själva spelet eftersom layouten i vyn där korten skulle sorteras efter färg såg bättre ut utan jokrarna.

Kravet kring komposition var något svårare, ju mer jag funderade över det desto mer osäker blev jag kring om jag verkligen förstår definitionen av kompositionsrelation. Så länge som en card ligger i en DeckOfCards så är relationen mellan Card och DeckOfCards är en komposition - korten skapas och "ligger" inuti instansen av DeckOfCards och om vi tar bort DeckOfCards så kommer även tillhörande instanser av Card försvinna. När vi plockar ut kortet från DeckOfCard med draw metoden så kan kortet fortsätta att existera även om DeckOfCards skulle raderas, och då blev jag osäker på vilken relation som gäller - komposition eller dependency (eftersom DeckOfCards instantiates och använder CardGraphic). Kan man säga att relationen ändras?

Relationen mellan Card och CardHand var också lite svår att avgöra om den skulle definieras som aggregation eller komposition. DeckOfCards skickas in som ett av argumenten till CardHand's konstruktor-funktion. Inuti konstruktorn plockas ett antal instanser av CardGraphic ut från DeckOfCards och läggs till i CardHands attribut hand. På så sätt skapas inte korten innuti CardHand, utan de är redan skapade inuti DeckOfCards och kan därför existera utanför CardHand. Så jag skulle vilja säga att relationen blir aggregation och inte komposition. Men å andra sidan så kan en Card inte existera på egen hand, utanför både Deck Of Cards eller CardHand - de finns alltid inuti någon av dessa klasser - så att då kanske CardHand och Card relationen också är en komposition eftersom att när kortet väl är inne i CardHand så är det inte längre kvar i en DeckOfCards så om CardHand skulle försvinna så skulle även korten som ligger inuti den försvinna.

Relationen mellan DeckOfCards och CardHand är ett beroende. CardHand kommer inte att försvinna om vi tar bort DeckOfCards och vise versa, men däremot behöver vi skicka med en DeckOfCards i konstruktorn till CardHand så utan DeckOfCards kan vi inte skapa en CardHand. 

Det gick bra att lösa veckans uppgift(er). Jag började med Json API kravet eftersom det blir lättare att kontrollera så att den logiska delen av koden i klasserna fungerar som det ska när inte andra faktorer som twig/css är inblandade. När strukturen väl var på plats så kunde jag återanvända mycket av logiken från JsonController till CardController. 

Såhär långt skulle jag säga att jag är nöjd med kodstrukturen. Jag misstänker att det kommer att behöva göras ändringar under kommande kursmoment allteftersom det tillkommer fler krav kring korten/kortleken. En sak som jag redan nu kan se troligtvis kommer att behöva uppdateras längre fram är att "översättningstabellen" från rank till siffervärde ligger i kort-klassen, men den bör kanske egentligen ligga i klassen för ett spel eftersom vissa kort ju kan vara värda olika mycket beroende på spel? En lösning på det skulle iofs kunna vara att ha en översättningstabell i såväl card som i spel-klassen och lägga till en setter-metod i card för att värdet på kortet ska kunna ändras vid behov - det tror jag eventuellt kan bli en bra lösning.  Sedan kanske det kommer att behövas någon metod för att plocka ut kortet från handen. 

 Jag använde mig inte av pseudokod när jag gjorde uppgiften, utan klass-beskrivningarna på landningssidan och UML-diagrammet skapade jag först när jag var klar med resten. Av tidigare erfarenhet från både OOPython och Databas-kurserna har jag kommit fram till att för min del är såväl klass-diagram som sekvens-diagram bra för att:  

 - förklara min kod för någon annan  

 - få bättre förståelse av hur den slutliga koden ska se ut när vi ska skriva kod helt eller delvis efter instruktioner  

 - analysera min egna kod i efterhand för att se möjligheter till förbättringar  

 
 Däremot fungerar det bättre för mig att "skissa" koden direkt som kod och att "planera" på det sättet. Jag skulle tro att detta kan ändras längre fram när jag fått mer erfarenhet kring vilka konstruktioner i koden som faktiskt fungerar och vilka som inte gör, men just nu känns det som att det inte blir värt att lägga för mycket tid, när jag arbetar ensam, på att planera kring något som jag inte ens vet förrän jag skriver den faktiska koden om det kommer att fungera eller inte.

 Mina TIL från detta kursmoment är:  

 - syntaxen för att komma åt medlemsvariabler i den egna instansen ($this->), klassen(self::) respektive superklassen(parent::) 

 - hur man går tillväxa för att skapa klass som ärver från en annan klass  

 - dela upp routes över flera filer genom att använda samma namespace  
