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

/* game21/incl/card-deck.html.twig */
class __TwigTemplate_c177b8dd27490a0c5d2fd0b1b2eca2a8 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/card-deck.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/card-deck.html.twig"));

        // line 1
        echo "<div class=\"card-deck\">
<p>Cards left: ";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["cardsLeft"]) || array_key_exists("cardsLeft", $context) ? $context["cardsLeft"] : (function () { throw new RuntimeError('Variable "cardsLeft" does not exist.', 2, $this->source); })()), "html", null, true);
        echo "</p>
";
        // line 3
        if (((isset($context["cardsLeft"]) || array_key_exists("cardsLeft", $context) ? $context["cardsLeft"] : (function () { throw new RuntimeError('Variable "cardsLeft" does not exist.', 3, $this->source); })()) > 0)) {
            // line 4
            echo "        <img class=\"card\" src=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/cards/back.svg"), "html", null, true);
            echo "\" alt=\"card deck\">
";
        }
        // line 6
        echo "</div>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "game21/incl/card-deck.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 6,  52 => 4,  50 => 3,  46 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"card-deck\">
<p>Cards left: {{ cardsLeft }}</p>
{% if (cardsLeft > 0) %}
        <img class=\"card\" src=\"{{ asset('img/cards/back.svg') }}\" alt=\"card deck\">
{% endif %}
</div>", "game21/incl/card-deck.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/game21/incl/card-deck.html.twig");
    }
}
