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

/* game21/incl/draw-buttons.html.twig */
class __TwigTemplate_9bb60f14c191ccd93276160a4442d53d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/draw-buttons.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/draw-buttons.html.twig"));

        // line 1
        echo "<form method=\"post\" action=\"\">
    <p>";
        // line 2
        if (((isset($context["bankPlaying"]) || array_key_exists("bankPlaying", $context) ? $context["bankPlaying"] : (function () { throw new RuntimeError('Variable "bankPlaying" does not exist.', 2, $this->source); })()) == false)) {
            // line 3
            echo "        <input type=\"submit\" value=\"Draw a card\"
            onClick=\"this.form.action='";
            // line 4
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("playerDraw");
            echo "';\">
        ";
        }
        // line 6
        echo "        <input type=\"submit\" value=\"Done\"
            onClick=\"this.form.action='";
        // line 7
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("bankPlaying");
        echo "';\">
    </p>
</form>

";
        // line 11
        if (((isset($context["bankPlaying"]) || array_key_exists("bankPlaying", $context) ? $context["bankPlaying"] : (function () { throw new RuntimeError('Variable "bankPlaying" does not exist.', 11, $this->source); })()) == false)) {
            // line 12
            echo "<p>Sannolikhet att bli tjock vid nästa kort ";
            echo twig_escape_filter($this->env, (isset($context["risk"]) || array_key_exists("risk", $context) ? $context["risk"] : (function () { throw new RuntimeError('Variable "risk" does not exist.', 12, $this->source); })()), "html", null, true);
            echo "</p>
";
        }
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "game21/incl/draw-buttons.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 12,  66 => 11,  59 => 7,  56 => 6,  51 => 4,  48 => 3,  46 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<form method=\"post\" action=\"\">
    <p>{% if (bankPlaying == false) %}
        <input type=\"submit\" value=\"Draw a card\"
            onClick=\"this.form.action='{{ path('playerDraw') }}';\">
        {% endif %}
        <input type=\"submit\" value=\"Done\"
            onClick=\"this.form.action='{{ path('bankPlaying') }}';\">
    </p>
</form>

{% if (bankPlaying == false) %}
<p>Sannolikhet att bli tjock vid nästa kort {{ risk }}</p>
{% endif %}", "game21/incl/draw-buttons.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/game21/incl/draw-buttons.html.twig");
    }
}
