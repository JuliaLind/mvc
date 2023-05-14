# Metrics

## 6 C om kodkvalitet

### Codestyle  

Kodstil är bestämda villkor för hur koden ska se ut och kan variera från bolag till bolag. En bra kodstil gör koden mer läsbar för en anna person och underlättar för att kunna sätta sig in i koden snabbare. Kodstil kan exempelvis beskriva att ett indrag (indent) ska vara 4 mellanrum långt, att filen måste avslutas med en tom rad, att det sista tecknet på varje rad inte får efterföljas av mellanslag (no trailing spaces allowed) osv. Kodstilen kan också variera från språk till språk (tex att man använder snake_case i python och camelCase i PHP och Javascript, förutom för klassnamn där PascalCase används i båda).

### Coverage  

Coverage visar hur många rader av logisk kod som täcks in av testcases. Rader som täcks in är alltså rader som exekveras när testfallen körs. Ju högre coverage desto bättre - det innebär både att risken för buggar är mindre i de testade delarna, samt också att de testade delarna är enklare att bygga vidare på och/eller refactorisera eftersom det på ett enkelt sätt går att säkerställa att varje ändring man gör inte har sabbat andra delar av programmet. Hög coverage är också ett sätt att visa på kodvalitet för andra intressenter, tex kunder eller teammedlemmar. Det finns ingen bestämd siffra för hur hög coverage måste vara men en god riktlinje är 60-70%. Om jag hade haft kunskapen kring hur man testar alla delar så skulle jag för egen del vilja ligga på 100% - det finns ingen anledning till att inte göra det. Även om det tar tid att skriva tester så sparar det in den tiden och mer därtill senare när man arbetar med koden, och man minskar även risken för att någon annan än jag själv ska uppäcka fel i min kod. Ju längre dålig kod dessutom kommit i utveckling desto mer kostsamt kan det bli att hitta och laga buggar.

### Complexity

Ju högre värde desto mer komplex är koden, vilket är sämre. Det gör koden både svårare att underhålla och bygga vidare på. Ju fler intabbningar (if, switch, loopar) och ju djupare desto mer komplex kod. Komplex kod är också svårare att testa. Komplexitet bör inte ligga på över 10.

### Cohesion

Cohesion mäts av ett värde som helter Lack Of Cohesion of Methods (LCOM) och visar hur väl metoderna i en klass hänger ihop med varandra. En klass bör ha bara ett ansvarsområde och precis som med komplexitet är höga värden dåligt. Har man ett högt värde på en klass så bör man se över om klassen kan delas upp i flera. En riktlinje är att det som ska ändras ihop ska finnas på en plats. Det gör det enklare att återanvända koden i ett annat program utan att behöva ändra på något och det finns även utrymme om man skulle behöva bygga på klassen utan att den blir för stor och svår att maintaina. Cohesion värdet bör ligga på 1 - ett högre värde innebär att klassen har mer än ett ansvarsområde.

### Coupling  

Coupling är värden på beroenden mellan klasser. Det finns två typer av coupling:  

1. AC (afferent coupling) är antal klasser som är beroende av den klassen måttet avser, dvs outgoing connections. Ett högt värde innebär att den mätta klasen använder sig av många andra klasser  

2. EC (efferent coupling) är antal klasser som klassen som måttet avser är beroende av, dvs incoming connections. Ett högt värde innebär att den mätta klassen används av många andra klasser.  

Det är varken bra eller dåligt att ha höga värden, men ett högt värde på EC innebär att kod i fler klasser kan behöva uppdateras om jag måste göra ändringar i klassens publika API.

### CRAP

CRAP står för Change Risk analyzer and Predictor och beräknas på hur komplex en metod är i jämförelse med hur många testfall som täcker den. Om en metod har ett högt CRAP värde så är fler testfall det enklaste sättet att få ner dessa. Ju mer komplexa metoder desto fler testfall bör man ha.

## PHP Metrics  

Den första rapporten visade tydliget att några av klasserna bör skrivas om. 

Den största boven var inte helt oväntat Game21Easy klassen som hade den högsta cyclomatiska komplexiteten med ett värde på 23 (mer än det dubbla mot 10 som är gränsen för vad som är ok). Den maximala cyklomatiska komplexiteten på metodnivå för denna klass var 7. Klassen hade i teorin 0.59 buggar (näst högsta av alla klasser) och låg på 27.98 i Difficulty. Klassen hade dock ett bra LCOM score vilket betyder att den redan har en single responsibility. Det innebär att i förstahand så bör jag ser över komplexiteten inom metoderna och i andra hand över att dela upp metoderna över fler klasser.

Den klassen som hade sämst värde på LCOM var JsonController som hade hela 9. Vilket inte heller var helt oväntat, samtliga routes som börjar med "api" var ju samlade i den, även routes som inte var relaterade till varandra mer än samtliga visade data i json representation. De övriga klasserna låg på 1 eller 2 i LCOM. Riktlinjen är att varje klass ska ligga på 1, så de som låg på 2 låg egentligen också dåligt till. Jag hade nog fram tills nu inte riktigt förstått vad som menas med att klassen hänger ihop/cohesion men i detta kursmoment har jag iallafall förstått att metoder som jobbat mot samma interna attribut i klassen ska vara ihop och olika bör delas upp på olika klasser. Men däremot verkar det som att även klasser som inte har några egna attribut ändå kan få ett LCOM värde över 1 och den tyckte jag var såvarare att förstå varför det blir så. Här hade det varit till stor hjälp om Metrics rapporten hade haft funktionalitet med klickbara siffror som kunde leda vidare till en översikt vilka delar som Metrics tycker hör ihop och inte.     

När det kommer till violations hade jag 10 stycken till att börja med. De som låg under class violations med probably-bugged förstod jag direkt berodde på att jag inte hade tillräckligt med testfall i förhållande till mängden kod. För controllerna var det förklarligt - jag hade ju inte skrivit några. Det fanns dock potential till att lyfta ut delar, i framförallt controller-metoderna som vi skapade innan Game-klassen till "vanliga" klasser som går att testa med unittest. Jag blev lite förvånad över att Game21Easy-klassen hamnade här, eftersom jag hade 100% kodtäckning på den. I teorin hade den som sagt 0.59 buggar trots att jag hade testa alla scenarion som kan uppstå, förutsatt att klassen används på rätt sätt. 

Den klassen som hade högst buggar i teorin var JsonController som låg på hela 0.7. Den kontrollen hade också märkts med error på Blob / God object, vilket inte var oväntat med tanke på det höga LCOM scoret. Av alla routsen i Json Controllern var det max 2-3 stycken som hängde ihop och det är inga andra klasser som använder den så denna klass skulle inte ta särskilt mycket tid i anspråk att splitta upp i flera controllerklasser, om man jämför mot exempelvis Game21Easy som har både flera utomstående klasser som använder den (efferent coupling värde på 5) och en massa tester kopplade till sig - den förstod jag redan från början skulle bli tuff att hugga tag i, vilket också är i linje med det höga maintainability indexet på 65.43. JsonController fick 67.63 - men i detta fall skulle det bli enkelt att åtgärda, förutom att splitta upp den över fler controllerklasser så fanns det i detta läge också möjlighet att flyttar ut merparten av innehållet i routsen till egna "untitestbara" klasser och därmed också bättra på såväl maintainability och minska antal teoretiska buggar.

Package violations rubriken var svårare att förstå, men av sammanhanget så kändes det som att de blev orangemarkerade eftersom de används av klasser som ligger utanför den egna namespace och de klasserna i sin tur också kommer från olika namespaces. Samtliga tre hade violation mot Stable Abstractions Principle med kommentaren "This package is instable and abstract." och Cards hade även brutit mot Stable Dependecies principle med kommentaren "This package is more stable (0.143) than 1 package(s) that it depends on." Den senare framgick det dock tydligt att den kom från att den använde sig av klass i Exceptions namespace. När jag senare tog bort det namespacet och lade alla exceptions i den namespace de används i såg försvann dels varningen från Exceptions paketet och dels stable dependencies violation från Cards-paketet.  

Storleksmässigt lågt mina klasser relativt bra till. Klasserna med flest rader logisk kod var Game21Easy med 153 rader och JsonController med 125 rader, som ju är under gränsen för 200. 

Av alla klasser var det alltså Game21Easy som fick sämst värden på nästan alla mått förutom LCOM och det låga LCOM värdet kom troligtvis från att merparten av metoderna i klassen inte har in- och utparametrar utan läser av/ändrar på instansens attribut. Detta behöver inte nödvändigtvis vara en bra sak eftersom klasser med färre attribut och fler inparametrar blir lättare att dela upp i fler allteftersom de växer till sig. Nästa gång jag skapar en ny klass ska jag noga överväga vilka attribut som jag verkligen behöver, vilka metoder som verkligen behöver läsa av dessa direkt och vilka är bättre att skicka in i metoderna som argument. 

När vi ändå pratar om maintainability så var det väldigt intressant att se vilken skillnad det blev med och utan kommentarer. Den första bilden är med kommentarer och den andra utan. Jag skulle aldrig trott att kommentarer kunde göra så stor skillnad med tanke på att, iaf mina, tycker jag inte är särskilt mycket mer beskrivande än själva koden, förutom möjligtvis där lintern tvingade mig att lägga till extra tydliga typehints.  

## Scrutinizer

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JuliaLind/mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/JuliaLind/mvc/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/JuliaLind/mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/JuliaLind/mvc/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/JuliaLind/mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/JuliaLind/mvc/build-status/main)



I den initiella uppladdningen fick jag 9.98 poäng, men då hade jag i förväg exkluderat några klasser. Senare, när jag fick reda på att alla klasser behövde vara med och ladda om så gick den score ner till 9.97, så 9.97 gick bli utgångsläget. Test coverage var ursprungligen väldigt lågt, vilket berodde på att jag endast testat game och cards klasserna.

Överlag låg klasserna bra till och jag hade A i betyg på alla, men det var en metod i Game21Easy som Scrutinizer utpekade som hotspot och som hade fått betyget B. Den metoden hade flest if satser och min första tanke var att det kanske är den som bidrar mest till den höga cyklomatiska komplexiteten som både Metrics och Scrutinizer visade för klassen. Det skulle vara intressant att se hur stor skillnad det skulle göra för klassens komplexitet om jag lyckades få ner komplexiteten i enbart denna metod.  


<div class="no-p">
<img src="img/metrics/scruti_hotspots.jpg" alt="issue1">  
</div>


Sedan är jag lite fundersam över vad Duplication kolumnen i Scrutinizer egentligen betyder. Jag vet med mig att jag kopierat flera kodstycken som var i Player klassen i Cards namespace till PlayerTrait i Game namespace, för att jag inte var helt säker på hur jag skulle lägga upp spelet och sedan inte orkat fixat det i efterhand. Jag är förvånad att dessa kodstycken inte dök upp i rapporten för när jag håller musen över kolumn-rubriken står det "Duplicated lines of code", men kanske menar de inom samma namespace alternativt inom samma klass eller samma metod.

Jag noterade ocksp att i Scrutinizer avser Complexity kolumnen samma värde som WMC (weighted method count) i Metrics rapporten, och är alltså inte samma som Class cyclomatic complexity. 

<div class="no-p">
<img src="img/metrics/scruti_issues_init1.jpg" alt="issue1">  
</div>
<div class="no-p">
<img src="img/metrics/scruti_issues_init2.jpg" alt="issue2">  
</div>

Till en början hade jag två issues. Båda hängde ihop med Library uppgiften, där jag känner att jag inte riktigt har koll på all kod så jag blev snarare förvånad över att det inte var fler.  

Den i BookRepository klassen var märkt med "bug" och "best practice" och jag löste den senare genom en if sats som kastar en "BookNotFoundException" om $book inte är av klassen Bok.  När jag löste denna kod så kunde jag också ta bort phpstan ignore, vilket var skönt eftersom jag helst vill undvika ignore kommentarer så långt det går så att om jag råkar introducera ett nytt fel på en rad (eller klass) som jag tidigare satt ignore på så vill jag inte att linterna hoppar över det nya felet också. 

Och den andra som kommer från min SqlFileLoader klass var märkt med "deprecated code" - den fick jag hjälp med att lösa av en kurskamrat - metoden exec() hade tydligen ersatts av en ny metod executeStatement(). Här hade det ju inte varit fel om verktyget också kunde hinta om vilken metod som den deprecated metoden har ersatts av :) Issuen med att jag behövde göra en extra check om att instansen av bokklassen faktiskt är av typen bok var en major issue, medan den med deprecated code var en minor - intressant, jag hade nog trott att det skulle vara tvärtom.  

## Förbättringar

Följande förbättringar hag jag valt eftersom jag är nyfiken på att i praktiken förstå vad som påverkar dessa värden. Främst är jag intresserad av LCOM eftersom jag tycker att det ät lite svårt att greppa vad som egentligen räknas som "ett ansvarsområde" för en klass. genom att göra små ändringar och kolla utveckling i Metrics och Scrutinizer rapporetena ofta kan jag se vad i min kod som ändrar värdena till det bättre eller till det sämre, samt hur stor påverkan varje ändring egentligen har. Jag tror att det blir en bra erfarenhet inför projektarbetet.

1. Högre coverage - målet är att komma upp i 70%. Hittills har jag endast skrivit testfall för klasserna relatade till 21 spelet samt till Cards. Om jag lägger till testfall för alla andra klasser (som går att testa med untitests) så bör jag komma upp ärtt högt. Jag kommer även att lyfta ut ännu mer från routsen controller-klasserna till egna klasser som jag kan unittesta. I Game21Controllern är det inte jättemycket logik, men lite finns kvar att lyfta ut - tex om tre metoder kallas på från Controllern så kan jag slå ihop dessa tre till 1 metoder i en annan klass och testa med hjälp av mock att dessa tre verkligen anropas från den metoden. I main-controller, JsonControllern och Library ligger det mycket logik som kan lyftas ut till "testbara klasser". Högre kodtäckning tror jag kommer att påverka värdet för teoretiska buggar och maintainability index (i Metrics), och såklart värdena för coverage samt betyg i Scrutinizer. För min egen del kommer det underlätta för mig med de följande punkterna. Högre kodtäckning förbättrar även metodernas CRAP score - ju högre Crap Score man har desto fler tester bör metoden ha. På grund av begränsad tid har jag dock valt att inte koncentrera mig så jätte mycket just på CRAP score, jag har täckt alla metoder jag kunde en gång, och har metoden någon if/else if har den i så fall fler testfall för att täcka de olika fallen. Jag har inte skrivit flera testfall för samma scneario och har utgått ifrån att användaren vet hur metoden ska användas och skickar in rätt typ på inparametrar.

2. Mixa cyclomatic complexity i framförallt Game21Easy klassen, men även se över alla ifs och loopar i andra klasser som fått höga värden för att se om några av dessa kan lyftas ut till egna metoder.

2. Fixa buggar. Jag har inte så jättemånga till att börja med och Scrutinizer pekar så tydligt ut var felet ligger och vad det är, så bör inte vara svåra att fixa.  

3. Kvalitetsindex ligger rätt högt, men jag vill få upp den till 10. Jag är lite orolig att det inte ska gå på grund av att vi inte fick utesluta klasserna som hörde ihop med ORM övningen, men jag ger det ett försök.  

4. Få ner värden på LCOM som ligger över 2 genom att dela upp klasser i flera (även om jag är medveten om att det inte ska vara över 1, men med tanke på den begränsade tiden får jag satsa på de sämsta kalsserna och låta 2:orna vara så länge). Att dela upp en klass som har hög LCOM till flera är enkelt eftersom metoderna inte hänger ihop med varandra ändå, men det kan ändå bli en utmaning eftersom jag då kan behöva skriva om koden i andra klasser som använder sig av denna klass. Det jobbigaste blir att uppdatera alla tester eftersom varje metod i klassen kan ha fler än en tester kopplade till sig.

5. Jag vill förbättra maintainability indexet på de "röda" klasserna i rapporten från PHPMetrics. Jag tror att det blir enklast i framförallt kontrollerklasserna för main controller och json controller eftersom varje metod är en enskild route och många av de inte hör ihop på någon sätt. Klasserna som inte är controllers tror jag kan bli svårare att dela upp eftersom metoderna hämtar/ändrar instansens attribut och i de flesta fall inte använder sig av in- och ut-parameterar. Det kan därför bli svårare att ändra på detta efterhand eftersom det kan bli så att kod i andra klasserna kan behöva skrivas om att skriva om, så det kan ta in anspråk rätt mycket tid, som jag känner att vi inte riktigt har. Men jag ska iallafall ge det ett försök.



### Resultat

Jag har bättrat på både Coverage (från 41% till 71%) och kvalitetsbetyget (från 9.97 till 10) i Scrutinizer.

<div class="no-p">
<img src="img/metrics/scruti_init.jpg" alt="Scrutinizer initial upload">
<img src="img/metrics/scruti_after.jpg" alt="Scrutinizer after">
</div>


Jag har minskat antalet violations i PhpMetrics från 10 till 5. Den under Class Violation hade jag, om jag hade haft mer tid, kunnat lösa med fler tester, framförallt för de metoder osom har högst Cyclomatic complexity, samt lyfta ut fler metoder till egna klasser (snabbaste vägen att få ner cycloatic complexity på class-nivå).  

<div class="no-p">
<img src="img/metrics/metrics_violations_init.jpg" alt="Violations initial">
</div>
<div class="no-p">
<img src="img/metrics/metrics_violations_after.jpg" alt="Violations after">
</div>

Jag har fått ner komplexiteten på den enl Scrutinizer B-ratade metoden i Game21Easy klassen genom att lyfta ut varje if-block till egen protected metod. Det minskade metodens cyclomatiska complexity värde från 7 till 4.

Före:  

<div class="no-p">
<img src="img/metrics/metrics_method_before.jpg" alt="method improved">
</div>
Efter:  

<div class="no-p">
<img src="img/metrics/metrics_method_after.jpg" alt="method improved">
</div>
<div class="no-p">
<img src="img/metrics/scruti_game21easy_improved.jpg" alt="method improved">
</div>




Jag fick upp maintainability index på Game21Easy (som hade sämst scores av alla klasser) från 65.43 till 71.57 (representerat av färgen som gick från röd till gul) och den cyklomatiska komplexiteten ner från 23 till 18. Jag började med att dela upp metoden som Scrutinizer pekade ut som hotspot i flera mindre protected. Det var enkelt att genomföra eftersom jag inte behövde ändra på det publika APIet och minskade komplexiteten för just den metoden. Tyvärr verkade det inte som att det gjort någon skillnad för den cyklomatiska komplexiteten på klassen eftersom det värdet inte ändrades med en enda enhet. Då lyfte jag ut några av metoderna till egen klass - detta gjorde stor skillnad för både maintainability och komplexiteten men var också mycket jobbigare att genomföra eftersom det ändrade på publika APIt.  Med denna kunskapen så vet jag att jag hade kunnat bättra på dessa värden ytterligare genom att dela upp funktionaliteten i det som blev kvar av klassen i ytterligare fler klasser, men nu medveten om tidsåtgången för att genomföra detta valde jag att stanna här även om värdet fortfarande överstiger 10-gränsen på vad som är ok - inga röda stora cirklar får vara good enough då denna kod ändå inte är något som jag planerar att använda eller bygga vidare på. 

Före: 
<div class="no-p">
<img class="half-width" src="img/metrics/metrics_maintain1_init.jpg" alt="Metrics maintainability with comments initial">  
<img class="half-width" src="img/metrics/metrics_maintain2_init.jpg" alt="Metrics maintainability without comments initial">  
</div>

Efter: 
<div class="no-p">
<img class="half-width" src="img/metrics/metrics_maintain1_after.jpg" alt="Metrics maintainability with comments initial">  
<img class="half-width" src="img/metrics/metrics_maintain2_after.jpg" alt="Metrics maintainability without comments initial">  
</div>

Före:  

<div class="no-p">
<img src="img/metrics/metrics_cyclom_before.jpg" alt="Metrics cycl">  
</div>

Efter:  

<div class="no-p">
<img src="img/metrics/metrics_cyclom_after.jpg" alt="Metrics cycl">  
</div>

För att bättra på LCOM värdet på JsonController klassen delade jag upp i flera mindre klasser samt lyfte ut merparten av logiken till klasser som gick att unittesta. I den ursprungliga Metrics rapporten ledde JsonController med 9 i LCOM. Efter att ha splittat upp den över flera fick jag mer LCOM till 2 på de nya api-controller-klasserna. De "nyskapade" controllerna fick dessutom mycket bättre maintainability index på 84.41, 93.27, 101.71, och 101.24, som för JsonControllern usrprungligen låg på 67.63 (den andra röda cirkeln på bilden ovan). Därmed ligger mina klasser på 2 i cyklomatisk komplexitet som högst. Vilket fortfarande är för högt men ändå en stor ändring mot tidigare och nu vet jag hur jag ska gå tillväga nästa gång jag skriver kod för att inte hamna i samma läge igen.

Före:  

<div class="no-p">
<img src="img/metrics/metrics_lcom_before.jpg" alt="Metrics lcom">  
</div>

Efter:  

<div class="no-p">
<img src="img/metrics/metrics_lcom_after.jpg" alt="Metrics lcom">  
</div>



Under tiden som jag jobbade med, framförallt tester, lyckades jag introducera issues ett flertal gånger. Ibland introducerade jag fler issues än jag fixade. 

<div class="no-p">
<img src="img/metrics/scrutinizer_log.jpg" alt="Scrutinizer log">  
</div>


Men lyckligtvis lyckades jag lösa samtliga till slut. 

<div class="no-p">
<img src="img/metrics/scruti_all_issues_fixed.jpg" alt="Metrics volume intial">  
</div>

Det var en som var särskilt jobbig att lösa men som även den gav med sig till slut. När jag skapade en testklass för att testa ett trait gjorde jag så att jag använde "use" trait i testklassen. Sedan skapade jag mock-objekt för Player21 klassen som attribut i testklassen (för att därefter kunna testa att traitets metoder fungerar som de ska när de används som testklassens metoder). Felet jag tydligen hade gjort var att första assigna mocken till testklassen och därefter tillsätta den metoden, såhär:
```
$this->winner = $this->createMock(Player21::class);
$this->winner->method('getName')->willReturn("real winner");
```
och då sade Scrutinizer ifrån att Player21 inte har metoden 'method'. Jag försökte med allt möjligt, i början hade jag så att metoden 'getName' låg i en player trait, jag flyttade över den till Player21 klassen - det hjälpte inte. Och som ett sista försök nu så ändrade jag koden i testklassen till:

```
$winner = $this->createMock(Player21::class);
$winner->method('getName')->willReturn("real winner");
$this->winner = $winner;
```

Och det löste tydligen problemet, trots att koden gör precis samma sak. Ibland har jag verkligen svårt att förstå varför linters mm är så kinkiga ibland och varför det andra sättet att skriva på är ok och den första är en issue.




## Diskussion  

Jag tyckte att både Metrics och Scrutinizer var riktigt bra verktyg och de kompletterade varandra bra. Metrics hade fler värden att titta på medan Scrutinizer pekde tydlgiare ut exakt var i koden som felen låg och exakt vad som behövde fixas.  

De största födelarna från att jobba på detta sätt får man nog om man använder verktygen redan från start när man börjar skriva sitt första kodstycke och därefter skapa och granska rapporter ofta, efter varje större ändring. Man blir då tidigt ummärksammad på buggar, om komplexiteten börjar dra iväg mm. Skapar man även enhetstester från start så tror jag att man kan få till ren och snygg kod genom att testa mot både egna tester och de automatiska verktygen. Jag önskar att det fanns liknande verktyg som kan hjälpa en att döpa funktioner och variabler på ett bra sätt - det hade inte varit fel att få hjälp med det också :).

Att skriva om klasser som har en dålig kodbas i efterhand är otroligt tidskrävande, framförallt om kodtäckningen inte är 100% till att börja med och varje ändring behöver åtföljas med manuella tester så att all funktionalitet fortfarande fungerar - det räcker med en liten felskrivning för att programmet ska krascha och utan enhetstester kan den bli svårare att hitta.  

När jag kom upp i som mest kodtäckning var det dessutom ändå bara 70 % vilket innebär att det finns 30% som kan gå sönder utan att jag märker det. Dessa 30% behöver därför testas manuellt efter varje ändring, för väntar jag för länge mellan testningar blir det svårt i efterhand att hitta tillbaka till vilken ändring exakt som orsakade felet - logiska fel kan ju inte upptäckas av varken metrics eller Scrutinizer om jag inte har skrivit tester för dessa själv. I denna övning märktes det extra tydligt hur mycket mer tid det tar att arbeta med kod som inte har full kodtäckning och hur mycket det är till hjälp att ha automatiska egenskapade tester som testar logiken.

På grund av tidsbrist finns det nog stor risk att, som i mitt fall, försöka uppnå bättre värden med läsbar kod som kompromiss. För att få ner komplexitet och LCOM har jag nog på flera ställen delat upp kod mellan klasser och även inom klassen på ett inte helt logiskt sett, och ju fler klasser/metoder jag fick skapa desto rörigare blev det med vad metodnamnen ska heta.  

Dessutom var min kod mer väldkoumenterad innan, men jag har inte hunnit justera/lägga till kommentarer i samma fart som jag skrev om koden - jag tror att om man ska försöka bättra på värdena i efterhand ska man nog räkna med att det kan ta lång tid, fundera ut exakt hur allt ska delas upp och göra lite i taget, samt se till att uppdatera docblocks ofta. 
