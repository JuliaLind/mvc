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

/* card/home.html.twig */
class __TwigTemplate_8fcde71018c5cc7dd78ff16c361e48c4 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "card/home.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "card/home.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "card/home.html.twig", 1);
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

        echo "Home";
        
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
        echo "<h1>Kortspel</h1>

<h2>Routes</h2>
<table>
    <tr><th>Route</th><th>Method</th></tr>
";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["cardRoutes"]) || array_key_exists("cardRoutes", $context) ? $context["cardRoutes"] : (function () { throw new RuntimeError('Variable "cardRoutes" does not exist.', 11, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["route"]) {
            // line 12
            echo "    <tr><td>
        ";
            // line 13
            if ((twig_get_attribute($this->env, $this->source, $context["route"], "method", [], "any", false, false, false, 13) != "GET")) {
                // line 14
                echo "            ";
                if ((twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 14) == "drawMany")) {
                    // line 15
                    echo "                <form action=\"";
                    echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 15), ["number" => 5]);
                    echo "\" method=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["route"], "method", [], "any", false, false, false, 15), "html", null, true);
                    echo ">
                <input type=\"submit\" value=";
                    // line 16
                    echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 16), ["number" => 5]);
                    echo ">
            ";
                } elseif ((twig_get_attribute($this->env, $this->source,                 // line 17
$context["route"], "link", [], "any", false, false, false, 17) == "deal")) {
                    // line 18
                    echo "                <form action=\"";
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 18), ["players" => 3, "cards" => 5]), "html", null, true);
                    echo "\" method=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["route"], "method", [], "any", false, false, false, 18), "html", null, true);
                    echo ">
                <input type=\"submit\" value=";
                    // line 19
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 19), ["players" => 3, "cards" => 5]), "html", null, true);
                    echo ">
            ";
                } else {
                    // line 21
                    echo "                <form action=\"";
                    echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 21));
                    echo "\" method=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["route"], "method", [], "any", false, false, false, 21), "html", null, true);
                    echo ">
                <input type=\"submit\" value=";
                    // line 22
                    echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 22));
                    echo ">
            ";
                }
                // line 24
                echo "        </form>
        ";
            } else {
                // line 26
                echo "            <a href=\"";
                echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 26));
                echo "\">";
                echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 26));
                echo "</a>
        ";
            }
            // line 28
            echo "        </td>
        <td>
            ";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["route"], "method", [], "any", false, false, false, 30), "html", null, true);
            echo "
        </td>        
    </tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['route'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "</table>

<h2>Klasser</h2>
<table>
<tr><th>Klass</th><th>Beskrivning</th></tr>
<tr><td>Card</td><td>Basklassen för ett spelkort. Innehåller bla information om kortets rank, suit, color (röd/svart) och värde i integer.</td></tr>
<tr><td>CardGraphic</td><td>Ärver från basklassen Card. Har en metod för att hämta bildlänk till svg representation av kortet. SVG bilderna för korten är skapade av Adrian Kennard och kan laddas ner härifrån <a href=\"https://www.me.uk/cards/\" target=\"_blank\">https://www.me.uk/cards/</a></td></tr>
<tr><td>DeckOfCards</td><td>Innehåller 52 kort (instanser av CardGraphic). Det är denna kortleken som för närvarande används på webbplatsen. DeckOfCards skapar instanser av CardGraphic. Det finns en metod i DeckOfCards för att plocka ut ett kort varefter CardGraphic kan fortsätta existera utanför DeckOfCards. Fram till att ett kort plockas ut från en DeckOfCards är relationen melan CardGraphic och DeckOfCards en komposition, efteråt skulle jag vilja säga att relationen blir dependency (DeckOfCards instantiates CardGraphic)</td></tr>
<tr><td>DeckOfCardsExt</td><td>Ärver från basklassen DeckOfCards. Innehåller 54 kort. Överlagrar Construct metoden från basklassen för att lägga till två kort - en röd respektive en svart joker. Används för närvarande inte på webbplatsen.</td></tr>
<tr><td>CardHand</td><td>Representerar en spelares hand. Relationen mellan CardHand och DeckOfCards är dependency eftersom en instans av DeckOfCards måste skickas in som argument till konstruktorn for CardHand. Inuti konstruktorn hämtas instanser av CardGraphic från kortleken och läggs till i handen - relationen mellan CardHand och CardGraphic blir då en komposition eftersom korten som ligger inuti CardHans försvinner om CardHand skulle tas bort.
 </td></tr>
</table>

<h2>UML klassdiagram</h2>
<img class=\"diagram\" src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/uml_kmom02.png"), "html", null, true);
        echo "\" alt=\"uml class diagram\">
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "card/home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 48,  170 => 34,  160 => 30,  156 => 28,  148 => 26,  144 => 24,  139 => 22,  132 => 21,  127 => 19,  120 => 18,  118 => 17,  114 => 16,  107 => 15,  104 => 14,  102 => 13,  99 => 12,  95 => 11,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Home{% endblock %}

{% block body %}
<h1>Kortspel</h1>

<h2>Routes</h2>
<table>
    <tr><th>Route</th><th>Method</th></tr>
{% for route in cardRoutes %}
    <tr><td>
        {% if route.method != \"GET\" %}
            {% if route.link == \"drawMany\" %}
                <form action=\"{{ path(route.link, {number: 5}) }}\" method={{ route.method }}>
                <input type=\"submit\" value={{ path(route.link, {number: 5}) }}>
            {% elseif route.link == \"deal\" %}
                <form action=\"{{ path(route.link, {players: 3, cards: 5}) }}\" method={{ route.method }}>
                <input type=\"submit\" value={{ path(route.link, {players: 3, cards: 5}) }}>
            {% else %}
                <form action=\"{{ path(route.link) }}\" method={{ route.method }}>
                <input type=\"submit\" value={{ path(route.link) }}>
            {% endif %}
        </form>
        {% else %}
            <a href=\"{{ path(route.link) }}\">{{ path(route.link) }}</a>
        {% endif %}
        </td>
        <td>
            {{ route.method }}
        </td>        
    </tr>
{% endfor %}
</table>

<h2>Klasser</h2>
<table>
<tr><th>Klass</th><th>Beskrivning</th></tr>
<tr><td>Card</td><td>Basklassen för ett spelkort. Innehåller bla information om kortets rank, suit, color (röd/svart) och värde i integer.</td></tr>
<tr><td>CardGraphic</td><td>Ärver från basklassen Card. Har en metod för att hämta bildlänk till svg representation av kortet. SVG bilderna för korten är skapade av Adrian Kennard och kan laddas ner härifrån <a href=\"https://www.me.uk/cards/\" target=\"_blank\">https://www.me.uk/cards/</a></td></tr>
<tr><td>DeckOfCards</td><td>Innehåller 52 kort (instanser av CardGraphic). Det är denna kortleken som för närvarande används på webbplatsen. DeckOfCards skapar instanser av CardGraphic. Det finns en metod i DeckOfCards för att plocka ut ett kort varefter CardGraphic kan fortsätta existera utanför DeckOfCards. Fram till att ett kort plockas ut från en DeckOfCards är relationen melan CardGraphic och DeckOfCards en komposition, efteråt skulle jag vilja säga att relationen blir dependency (DeckOfCards instantiates CardGraphic)</td></tr>
<tr><td>DeckOfCardsExt</td><td>Ärver från basklassen DeckOfCards. Innehåller 54 kort. Överlagrar Construct metoden från basklassen för att lägga till två kort - en röd respektive en svart joker. Används för närvarande inte på webbplatsen.</td></tr>
<tr><td>CardHand</td><td>Representerar en spelares hand. Relationen mellan CardHand och DeckOfCards är dependency eftersom en instans av DeckOfCards måste skickas in som argument till konstruktorn for CardHand. Inuti konstruktorn hämtas instanser av CardGraphic från kortleken och läggs till i handen - relationen mellan CardHand och CardGraphic blir då en komposition eftersom korten som ligger inuti CardHans försvinner om CardHand skulle tas bort.
 </td></tr>
</table>

<h2>UML klassdiagram</h2>
<img class=\"diagram\" src=\"{{ asset('img/uml_kmom02.png') }}\" alt=\"uml class diagram\">
{% endblock %}", "card/home.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/card/home.html.twig");
    }
}
