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

/* partials/topnav.html.twig */
class __TwigTemplate_bfbd4c4d188b85804161d5d7dd86c34d extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partials/topnav.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partials/topnav.html.twig"));

        // line 1
        echo "        <nav class=\"topnav\" id=\"myTopnav\">
            <a ";
        // line 2
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 2, $this->source); })()) == "/")) {
            echo " class=\"active\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        echo "\">Home</a>
            <a ";
        // line 3
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 3, $this->source); })()) == "/about")) {
            echo " class=\"active\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("about");
        echo "\">About</a>
            <a ";
        // line 4
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 4, $this->source); })()) == "/report")) {
            echo " class=\"active mobile-only\" ";
        } else {
            echo " class=\"mobile-only\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "\">Report</a>
            <div class=\"subnav desktop-only\">
            <a ";
        // line 6
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 6, $this->source); })()) == "/report")) {
            echo " class=\"active subnavbtn\" ";
        } else {
            echo " class=\"subnavbtn\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "\">Report &#x25BC;</a>
                <div class=\"subnav-content\">
                    <a href=\"";
        // line 8
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "\">Report</a>
                    <a href=\"";
        // line 9
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "#kmom01\">kmom01</a>
                    <a href=\"";
        // line 10
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "#kmom02\">kmom02</a>
                    <a href=\"";
        // line 11
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "#kmom03\">kmom03</a>
                    <a href=\"";
        // line 12
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "#kmom04\">kmom04</a>
                    <a href=\"";
        // line 13
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "#kmom05\">kmom05</a>
                    <a href=\"";
        // line 14
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "#kmom06\">kmom06</a>
                    <a href=\"";
        // line 15
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("report");
        echo "#kmom10\">kmom10</a>
                </div>
            </div>
            <a ";
        // line 18
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 18, $this->source); })()) == "/lucky")) {
            echo " class=\"active\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("lucky");
        echo "\">Lucky</a>
            <a ";
        // line 19
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 19, $this->source); })()) == "/card")) {
            echo " class=\"active\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("card");
        echo "\">Card</a>
            <a ";
        // line 20
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 20, $this->source); })()) == "/game")) {
            echo " class=\"active\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("gameMain");
        echo "\">Game</a>
            <a ";
        // line 21
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 21, $this->source); })()) == "/api")) {
            echo " class=\"active\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("api");
        echo "\">Json routes</a>
            <a ";
        // line 22
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 22, $this->source); })()) == "library")) {
            echo " class=\"active\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("library");
        echo "\">Library</a>
            <a ";
        // line 23
        if (((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 23, $this->source); })()) == "metrics")) {
            echo " class=\"active\" ";
        }
        echo " href=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("metrics");
        echo "\">Metrics</a>
            <a href=\"";
        // line 24
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("proj");
        echo "\">Project</a>
            <a class=\"nav-toggle\" id=\"nav-toggle\" title=\"Toggle Menu\" role=\"button\" aria-expanded=\"false\"
                tabindex=\"0\">
            <span class=\"bar\"></span>
            <span class=\"bar\"></span>
            <span class=\"bar\"></span>
            </a>
        </nav>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "partials/topnav.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  166 => 24,  158 => 23,  150 => 22,  142 => 21,  134 => 20,  126 => 19,  118 => 18,  112 => 15,  108 => 14,  104 => 13,  100 => 12,  96 => 11,  92 => 10,  88 => 9,  84 => 8,  73 => 6,  62 => 4,  54 => 3,  46 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("        <nav class=\"topnav\" id=\"myTopnav\">
            <a {% if url == '/' %} class=\"active\" {% endif %} href=\"{{ path('home') }}\">Home</a>
            <a {% if url == '/about' %} class=\"active\" {% endif %} href=\"{{ path('about') }}\">About</a>
            <a {% if url == '/report' %} class=\"active mobile-only\" {% else %} class=\"mobile-only\" {% endif %} href=\"{{ path('report') }}\">Report</a>
            <div class=\"subnav desktop-only\">
            <a {% if url == '/report' %} class=\"active subnavbtn\" {% else %} class=\"subnavbtn\" {% endif %} href=\"{{ path('report') }}\">Report &#x25BC;</a>
                <div class=\"subnav-content\">
                    <a href=\"{{ path('report') }}\">Report</a>
                    <a href=\"{{ path('report') }}#kmom01\">kmom01</a>
                    <a href=\"{{ path('report') }}#kmom02\">kmom02</a>
                    <a href=\"{{ path('report') }}#kmom03\">kmom03</a>
                    <a href=\"{{ path('report') }}#kmom04\">kmom04</a>
                    <a href=\"{{ path('report') }}#kmom05\">kmom05</a>
                    <a href=\"{{ path('report') }}#kmom06\">kmom06</a>
                    <a href=\"{{ path('report') }}#kmom10\">kmom10</a>
                </div>
            </div>
            <a {% if url == '/lucky' %} class=\"active\" {% endif %} href=\"{{ path('lucky') }}\">Lucky</a>
            <a {% if url == '/card' %} class=\"active\" {% endif %} href=\"{{ path('card') }}\">Card</a>
            <a {% if url == '/game' %} class=\"active\" {% endif %} href=\"{{ path('gameMain') }}\">Game</a>
            <a {% if url == '/api' %} class=\"active\" {% endif %} href=\"{{ path('api') }}\">Json routes</a>
            <a {% if url == 'library' %} class=\"active\" {% endif %} href=\"{{ path('library') }}\">Library</a>
            <a {% if url == 'metrics' %} class=\"active\" {% endif %} href=\"{{ path('metrics') }}\">Metrics</a>
            <a href=\"{{ path('proj') }}\">Project</a>
            <a class=\"nav-toggle\" id=\"nav-toggle\" title=\"Toggle Menu\" role=\"button\" aria-expanded=\"false\"
                tabindex=\"0\">
            <span class=\"bar\"></span>
            <span class=\"bar\"></span>
            <span class=\"bar\"></span>
            </a>
        </nav>", "partials/topnav.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/partials/topnav.html.twig");
    }
}
