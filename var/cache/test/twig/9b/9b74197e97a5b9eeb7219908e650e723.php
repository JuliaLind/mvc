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

/* game21/draw.html.twig */
class __TwigTemplate_b32a79f90bd28e8dcbbe3f3da328cd6c extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/draw.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/draw.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "game21/draw.html.twig", 1);
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

        echo "Game 21";
        
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
        echo "<h1>Level: ";
        echo twig_escape_filter($this->env, (isset($context["level"]) || array_key_exists("level", $context) ? $context["level"] : (function () { throw new RuntimeError('Variable "level" does not exist.', 6, $this->source); })()), "html", null, true);
        echo " | Round ";
        echo twig_escape_filter($this->env, (isset($context["currentRound"]) || array_key_exists("currentRound", $context) ? $context["currentRound"] : (function () { throw new RuntimeError('Variable "currentRound" does not exist.', 6, $this->source); })()), "html", null, true);
        echo " | Money in pot: ";
        echo twig_escape_filter($this->env, (isset($context["moneyPot"]) || array_key_exists("moneyPot", $context) ? $context["moneyPot"] : (function () { throw new RuntimeError('Variable "moneyPot" does not exist.', 6, $this->source); })()), "html", null, true);
        echo "</h1>
";
        // line 7
        echo twig_include($this->env, $context, "flash.html.twig");
        echo "
<div class=\"multi-player\" style=\"grid-template-rows: repeat(";
        // line 8
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["players"]) || array_key_exists("players", $context) ? $context["players"] : (function () { throw new RuntimeError('Variable "players" does not exist.', 8, $this->source); })())), "html", null, true);
        echo ", 1fr);\">

<div class=\"left-side\">
";
        // line 11
        $this->loadTemplate("game21/incl/card-deck.html.twig", "game21/draw.html.twig", 11)->display($context);
        // line 12
        echo "
<div class=\"buttons\">

";
        // line 15
        if (((isset($context["finished"]) || array_key_exists("finished", $context) ? $context["finished"] : (function () { throw new RuntimeError('Variable "finished" does not exist.', 15, $this->source); })()) == true)) {
            // line 16
            echo "    <p>Spela en omgång till?</p>
    ";
            // line 17
            $this->loadTemplate("game21/incl/start-buttons.html.twig", "game21/draw.html.twig", 17)->display($context);
        } elseif ((        // line 18
(isset($context["roundOver"]) || array_key_exists("roundOver", $context) ? $context["roundOver"] : (function () { throw new RuntimeError('Variable "roundOver" does not exist.', 18, $this->source); })()) == false)) {
            // line 19
            echo "    ";
            $this->loadTemplate("game21/incl/draw-buttons.html.twig", "game21/draw.html.twig", 19)->display($context);
        } else {
            // line 21
            echo "    ";
            $this->loadTemplate("game21/incl/next-round-button.html.twig", "game21/draw.html.twig", 21)->display($context);
        }
        // line 23
        echo "</div>
</div>
";
        // line 25
        $this->loadTemplate("game21/incl/players.html.twig", "game21/draw.html.twig", 25)->display($context);
        // line 26
        echo "
</div>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "game21/draw.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 26,  135 => 25,  131 => 23,  127 => 21,  123 => 19,  121 => 18,  119 => 17,  116 => 16,  114 => 15,  109 => 12,  107 => 11,  101 => 8,  97 => 7,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Game 21{% endblock %}

{% block body %}
<h1>Level: {{ level }} | Round {{ currentRound }} | Money in pot: {{ moneyPot }}</h1>
{{ include('flash.html.twig') }}
<div class=\"multi-player\" style=\"grid-template-rows: repeat({{ players|length}}, 1fr);\">

<div class=\"left-side\">
{% include 'game21/incl/card-deck.html.twig' %}

<div class=\"buttons\">

{% if finished == true %}
    <p>Spela en omgång till?</p>
    {% include 'game21/incl/start-buttons.html.twig' %}
{% elseif roundOver == false %}
    {% include 'game21/incl/draw-buttons.html.twig' %}
{% else %}
    {% include 'game21/incl/next-round-button.html.twig' %}
{% endif %}
</div>
</div>
{% include 'game21/incl/players.html.twig' %}

</div>

{% endblock %}
", "game21/draw.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/game21/draw.html.twig");
    }
}
