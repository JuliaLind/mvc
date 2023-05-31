<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* game21/doc.html.twig */
class __TwigTemplate_821689983ce61b5c721d68f7765f0db1 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/doc.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/doc.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "game21/doc.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Game 21 docs";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "
<h2>Flödesschema</h2>
<img class=\"diagram\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/game.drawio.svg"), "html", null, true);
        echo "\" alt=\"flowchart\">

";
        // line 10
        echo (isset($context["about"]) || array_key_exists("about", $context) ? $context["about"] : (function () { throw new RuntimeError('Variable "about" does not exist.', 10, $this->source); })());
        echo "

<h2>Klasser</h2>
<table>
<tr><th>Klass</th><th>Beskrivning</th></tr>
<tr>
<td>Card</td>
<td>Basklassen för ett spelkort. Innehåller bla information om kortets rank, suit, color (röd/svart) och värde i integer.</td>
</tr>
<tr>
<td>CardGraphic</td>
<td>Ärver från basklassen Card. Har en metod för att hämta bildlänk till svg representation av kortet. SVG bilderna för korten är skapade av Adrian Kennard och kan laddas ner härifrån <a href=\"https://www.me.uk/cards/\" target=\"_blank\">https://www.me.uk/cards/</a></td>
</tr>
<tr>
<td>DeckOfCards</td>
<td>Innehåller 52 kort (instanser av CardGraphic). Det är denna kortleken som för närvarande används på webbplatsen. DeckOfCards skapar instanser av CardGraphic. Det finns en metod i DeckOfCards för att plocka ut ett kort varefter CardGraphic kan fortsätta existera utanför DeckOfCards. Fram till att ett kort plockas ut från en DeckOfCards är relationen melan CardGraphic och DeckOfCards en komposition, efteråt skulle jag vilja säga att relationen blir dependency (DeckOfCards instantiates CardGraphic)</td>
</tr>
<tr>
<td>CardHand</td>
<td>Representerar en spelares hand. Relationen mellan CardHand och DeckOfCards är dependency eftersom en instans av DeckOfCards måste skickas in som argument till konstruktorn for CardHand. Inuti konstruktorn hämtas instanser av CardGraphic från kortleken och läggs till i handen - relationen mellan CardHand och CardGraphic blir då en komposition eftersom korten som ligger inuti CardHans försvinner om CardHand skulle tas bort.</td>
</tr>
<tr>
<td>Player</td>
<td>Base class, represents a player in card-game.</td>
</tr>
<tr>
<td>Player 21</td>
<td>Inherits from base class Player. Has additional methods and attributes related to 21 game</td>
</tr>
<tr>
<td>
MoneyPot
</td>
<td>
Represents the moneypot that holds the betted money for each game round. Has methods for moving a certain amount of money from each player into the pot and move the money from pot to winner. Has a composition relationship with Game21Easy (and subclasses of Game21Easy - Game21Med and Game21Hard). Has assocation relationship with Player class.
</td>
</tr>
<tr>
<td>Game</td>
<td>Base class for a card-game</td>
</tr>
<tr>
<td>Game21Easy</td>
<td>Inherits from Game class and has additional attribute representing player and bank, both of class Player21 and additional methods related to 21 game. Bank picks cards as long as bank's hand value is below 17. Method for statistics calculate statistics based on remaining cards in deck. Has composition relationship with Payer21, DeckOfCards and MoneyPot classes. Implements PlayerInterface. Uses BettingGameTrait.</td>
</tr>
<tr>
<td>Game21Med</td>
<td>Inherits from Game21Easy. Overrides method for statistics to calculate statistics differently for bank (as the bank now also uses statistics) and thus the statistics needs to take into account the cards that already have been drawn from deck by the player. Uses DealBankTrait which overrides parent's method for bankDeal - the bank now picks cards based on statistics.</td>
</tr>
<tr>
<td>Game21Hard</td>
<td>Inherits from Game21Easy. Uses DealBankTrait which overrides parent's method for bankDeal - the bank now picks cards based on same statistics as player (i.e. only cards left in deck).</td>
</tr>

</table>


<h2>UML klassdiagram</h2>

<a href=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/uml_kmom03.svg"), "html", null, true);
        echo "\" target=\"_blank\"><img class=\"diagram\" src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/uml_kmom03.svg"), "html", null, true);
        echo "\" alt=\"uml class diagram\"></a>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "game21/doc.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 69,  97 => 10,  92 => 8,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Game 21 docs{% endblock %}

{% block body %}

<h2>Flödesschema</h2>
<img class=\"diagram\" src=\"{{ asset('img/game.drawio.svg') }}\" alt=\"flowchart\">

{{ about | raw }}

<h2>Klasser</h2>
<table>
<tr><th>Klass</th><th>Beskrivning</th></tr>
<tr>
<td>Card</td>
<td>Basklassen för ett spelkort. Innehåller bla information om kortets rank, suit, color (röd/svart) och värde i integer.</td>
</tr>
<tr>
<td>CardGraphic</td>
<td>Ärver från basklassen Card. Har en metod för att hämta bildlänk till svg representation av kortet. SVG bilderna för korten är skapade av Adrian Kennard och kan laddas ner härifrån <a href=\"https://www.me.uk/cards/\" target=\"_blank\">https://www.me.uk/cards/</a></td>
</tr>
<tr>
<td>DeckOfCards</td>
<td>Innehåller 52 kort (instanser av CardGraphic). Det är denna kortleken som för närvarande används på webbplatsen. DeckOfCards skapar instanser av CardGraphic. Det finns en metod i DeckOfCards för att plocka ut ett kort varefter CardGraphic kan fortsätta existera utanför DeckOfCards. Fram till att ett kort plockas ut från en DeckOfCards är relationen melan CardGraphic och DeckOfCards en komposition, efteråt skulle jag vilja säga att relationen blir dependency (DeckOfCards instantiates CardGraphic)</td>
</tr>
<tr>
<td>CardHand</td>
<td>Representerar en spelares hand. Relationen mellan CardHand och DeckOfCards är dependency eftersom en instans av DeckOfCards måste skickas in som argument till konstruktorn for CardHand. Inuti konstruktorn hämtas instanser av CardGraphic från kortleken och läggs till i handen - relationen mellan CardHand och CardGraphic blir då en komposition eftersom korten som ligger inuti CardHans försvinner om CardHand skulle tas bort.</td>
</tr>
<tr>
<td>Player</td>
<td>Base class, represents a player in card-game.</td>
</tr>
<tr>
<td>Player 21</td>
<td>Inherits from base class Player. Has additional methods and attributes related to 21 game</td>
</tr>
<tr>
<td>
MoneyPot
</td>
<td>
Represents the moneypot that holds the betted money for each game round. Has methods for moving a certain amount of money from each player into the pot and move the money from pot to winner. Has a composition relationship with Game21Easy (and subclasses of Game21Easy - Game21Med and Game21Hard). Has assocation relationship with Player class.
</td>
</tr>
<tr>
<td>Game</td>
<td>Base class for a card-game</td>
</tr>
<tr>
<td>Game21Easy</td>
<td>Inherits from Game class and has additional attribute representing player and bank, both of class Player21 and additional methods related to 21 game. Bank picks cards as long as bank's hand value is below 17. Method for statistics calculate statistics based on remaining cards in deck. Has composition relationship with Payer21, DeckOfCards and MoneyPot classes. Implements PlayerInterface. Uses BettingGameTrait.</td>
</tr>
<tr>
<td>Game21Med</td>
<td>Inherits from Game21Easy. Overrides method for statistics to calculate statistics differently for bank (as the bank now also uses statistics) and thus the statistics needs to take into account the cards that already have been drawn from deck by the player. Uses DealBankTrait which overrides parent's method for bankDeal - the bank now picks cards based on statistics.</td>
</tr>
<tr>
<td>Game21Hard</td>
<td>Inherits from Game21Easy. Uses DealBankTrait which overrides parent's method for bankDeal - the bank now picks cards based on same statistics as player (i.e. only cards left in deck).</td>
</tr>

</table>


<h2>UML klassdiagram</h2>

<a href=\"{{ asset('img/uml_kmom03.svg') }}\" target=\"_blank\"><img class=\"diagram\" src=\"{{ asset('img/uml_kmom03.svg') }}\" alt=\"uml class diagram\"></a>
{% endblock %}", "game21/doc.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/game21/doc.html.twig");
    }
}
