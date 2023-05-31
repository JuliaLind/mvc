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

/* card/draw.html.twig */
class __TwigTemplate_f7865ab7ed6b73fd6b49111ce2d78382 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "card/draw.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "card/draw.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "card/draw.html.twig", 1);
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

        echo "Draw";
        
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
        echo "<h1>";
        echo twig_escape_filter($this->env, (isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 6, $this->source); })()), "html", null, true);
        echo "</h1>
<div class=\"multi-player\" style=\"grid-template-rows: repeat(";
        // line 7
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["players"]) || array_key_exists("players", $context) ? $context["players"] : (function () { throw new RuntimeError('Variable "players" does not exist.', 7, $this->source); })())), "html", null, true);
        echo ", 1fr);\">
<div class=\"left-side\">
<div class=\"card-deck\">
<p>Cards left: ";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["cardsLeft"]) || array_key_exists("cardsLeft", $context) ? $context["cardsLeft"] : (function () { throw new RuntimeError('Variable "cardsLeft" does not exist.', 10, $this->source); })()), "html", null, true);
        echo "</p>
";
        // line 11
        if (((isset($context["cardsLeft"]) || array_key_exists("cardsLeft", $context) ? $context["cardsLeft"] : (function () { throw new RuntimeError('Variable "cardsLeft" does not exist.', 11, $this->source); })()) > 0)) {
            // line 12
            echo "        <img class=\"card\" src=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/cards/back.svg"), "html", null, true);
            echo "\" alt=\"card deck\">
";
        }
        // line 14
        echo "</div>
</div>
";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["players"]) || array_key_exists("players", $context) ? $context["players"] : (function () { throw new RuntimeError('Variable "players" does not exist.', 16, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["player"]) {
            // line 17
            echo "    <div class=\"drawn-cards\">
    <p>";
            // line 18
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "playerName", [], "array", false, false, false, 18), "html", null, true);
            echo "</p>
        ";
            // line 19
            if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "cards", [], "array", false, false, false, 19)) > 0)) {
                // line 20
                echo "            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["player"], "cards", [], "array", false, false, false, 20));
                foreach ($context['_seq'] as $context["_key"] => $context["card"]) {
                    // line 21
                    echo "                <img class=\"card\" src=\"";
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(twig_get_attribute($this->env, $this->source, $context["card"], "link", [], "array", false, false, false, 21)), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["card"], "descr", [], "array", false, false, false, 21), "html", null, true);
                    echo "\">
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['card'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 23
                echo "        ";
            }
            // line 24
            echo "    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['player'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "</div>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "card/draw.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 26,  147 => 24,  144 => 23,  133 => 21,  128 => 20,  126 => 19,  122 => 18,  119 => 17,  115 => 16,  111 => 14,  105 => 12,  103 => 11,  99 => 10,  93 => 7,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Draw{% endblock %}

{% block body %}
<h1>{{ title }}</h1>
<div class=\"multi-player\" style=\"grid-template-rows: repeat({{ players|length}}, 1fr);\">
<div class=\"left-side\">
<div class=\"card-deck\">
<p>Cards left: {{ cardsLeft }}</p>
{% if (cardsLeft > 0) %}
        <img class=\"card\" src=\"{{ asset('img/cards/back.svg') }}\" alt=\"card deck\">
{% endif %}
</div>
</div>
{% for player in players %}
    <div class=\"drawn-cards\">
    <p>{{ player['playerName'] }}</p>
        {% if (player['cards']|length > 0) %}
            {% for card in player['cards'] %}
                <img class=\"card\" src=\"{{ asset(card['link']) }}\" alt=\"{{ card['descr'] }}\">
            {% endfor %}
        {% endif %}
    </div>
{% endfor %}
</div>

{% endblock %}", "card/draw.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/card/draw.html.twig");
    }
}
