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

/* landing_json.html.twig */
class __TwigTemplate_4df4084cb4eead9eb69a2c319a345dc8 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "landing_json.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "landing_json.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "landing_json.html.twig", 1);
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

        echo "Json routes";
        
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
        echo "<h1>Json routes overview</h1>
<table>
    <tr><th>Route</th><th>Description</th></tr>
";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["jsonRoutes"]) || array_key_exists("jsonRoutes", $context) ? $context["jsonRoutes"] : (function () { throw new RuntimeError('Variable "jsonRoutes" does not exist.', 9, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["route"]) {
            // line 10
            echo "    <tr>
        <td>
        ";
            // line 12
            if (twig_get_attribute($this->env, $this->source, $context["route"], "method", [], "any", false, false, false, 12)) {
                // line 13
                echo "            ";
                if ((twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 13) == "jsonDrawMany")) {
                    // line 14
                    echo "                <form action=\"";
                    echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 14), ["number" => 5]);
                    echo "\" method=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["route"], "method", [], "any", false, false, false, 14), "html", null, true);
                    echo ">
                <input type=\"submit\" value=";
                    // line 15
                    echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 15), ["number" => 5]);
                    echo ">
            ";
                } elseif ((twig_get_attribute($this->env, $this->source,                 // line 16
$context["route"], "link", [], "any", false, false, false, 16) == "jsonDeal")) {
                    // line 17
                    echo "                <form action=\"";
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 17), ["players" => 3, "cards" => 5]), "html", null, true);
                    echo "\" method=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["route"], "method", [], "any", false, false, false, 17), "html", null, true);
                    echo ">
                <input type=\"submit\" value=";
                    // line 18
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 18), ["players" => 3, "cards" => 5]), "html", null, true);
                    echo ">
            ";
                } else {
                    // line 20
                    echo "                <form action=\"";
                    echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 20));
                    echo "\" method=";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["route"], "method", [], "any", false, false, false, 20), "html", null, true);
                    echo ">
                <input type=\"submit\" value=";
                    // line 21
                    echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 21));
                    echo ">
            ";
                }
                // line 23
                echo "        </form>
        ";
            } elseif ((twig_get_attribute($this->env, $this->source,             // line 24
$context["route"], "link", [], "any", false, false, false, 24) == "single_book_json")) {
                // line 25
                echo "            <a href=\"";
                echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 25), ["isbn" => "9781492053514"]);
                echo "\">";
                echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 25), ["isbn" => "9781492053514"]);
                echo "</a>
        ";
            } else {
                // line 27
                echo "            <a href=\"";
                echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 27));
                echo "\">";
                echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, $context["route"], "link", [], "any", false, false, false, 27));
                echo "</a>
        ";
            }
            // line 29
            echo "        </td><td>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["route"], "descr", [], "any", false, false, false, 29), "html", null, true);
            echo "</td>
    </tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['route'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "</table>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "landing_json.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 32,  164 => 29,  156 => 27,  148 => 25,  146 => 24,  143 => 23,  138 => 21,  131 => 20,  126 => 18,  119 => 17,  117 => 16,  113 => 15,  106 => 14,  103 => 13,  101 => 12,  97 => 10,  93 => 9,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Json routes{% endblock %}

{% block body %}
<h1>Json routes overview</h1>
<table>
    <tr><th>Route</th><th>Description</th></tr>
{% for route in jsonRoutes %}
    <tr>
        <td>
        {% if route.method %}
            {% if route.link == \"jsonDrawMany\" %}
                <form action=\"{{ path(route.link, {number: 5}) }}\" method={{ route.method }}>
                <input type=\"submit\" value={{ path(route.link, {number: 5}) }}>
            {% elseif route.link == \"jsonDeal\" %}
                <form action=\"{{ path(route.link, {players: 3, cards: 5}) }}\" method={{ route.method }}>
                <input type=\"submit\" value={{ path(route.link, {players: 3, cards: 5}) }}>
            {% else %}
                <form action=\"{{ path(route.link) }}\" method={{ route.method }}>
                <input type=\"submit\" value={{ path(route.link) }}>
            {% endif %}
        </form>
        {% elseif route.link == \"single_book_json\" %}
            <a href=\"{{ path(route.link, {isbn: \"9781492053514\"}) }}\">{{ path(route.link, {isbn: \"9781492053514\"}) }}</a>
        {% else %}
            <a href=\"{{ path(route.link) }}\">{{ path(route.link) }}</a>
        {% endif %}
        </td><td>{{ route.descr }}</td>
    </tr>
{% endfor %}
</table>
{% endblock %}", "landing_json.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/landing_json.html.twig");
    }
}
