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

/* game21/incl/players.html.twig */
class __TwigTemplate_295033bad91981a04b8b6beb5e315a2c extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/players.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/players.html.twig"));

        // line 1
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["players"]) || array_key_exists("players", $context) ? $context["players"] : (function () { throw new RuntimeError('Variable "players" does not exist.', 1, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["player"]) {
            // line 2
            echo "    <div class=\"drawn-cards\">
    <p>";
            // line 3
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "name", [], "array", false, false, false, 3), "html", null, true);
            echo " | Money: ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "money", [], "array", false, false, false, 3), "html", null, true);
            echo " | Hand value: ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "handValue", [], "array", false, false, false, 3), "html", null, true);
            echo " </p>
        ";
            // line 4
            if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["player"], "cards", [], "array", false, false, false, 4)) > 0)) {
                // line 5
                echo "            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["player"], "cards", [], "array", false, false, false, 5));
                foreach ($context['_seq'] as $context["_key"] => $context["card"]) {
                    // line 6
                    echo "                <img class=\"card\" src=\"";
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(twig_get_attribute($this->env, $this->source, $context["card"], "link", [], "array", false, false, false, 6)), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["card"], "descr", [], "array", false, false, false, 6), "html", null, true);
                    echo "\">
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['card'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 8
                echo "        ";
            }
            // line 9
            echo "    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['player'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "game21/incl/players.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 9,  76 => 8,  65 => 6,  60 => 5,  58 => 4,  50 => 3,  47 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% for player in players %}
    <div class=\"drawn-cards\">
    <p>{{ player['name'] }} | Money: {{ player['money'] }} | Hand value: {{ player['handValue'] }} </p>
        {% if (player['cards']|length > 0) %}
            {% for card in player['cards'] %}
                <img class=\"card\" src=\"{{ asset(card['link']) }}\" alt=\"{{ card['descr'] }}\">
            {% endfor %}
        {% endif %}
    </div>
{% endfor %}", "game21/incl/players.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/game21/incl/players.html.twig");
    }
}
