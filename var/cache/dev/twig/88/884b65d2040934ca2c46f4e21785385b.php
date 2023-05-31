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

/* game21/incl/select-amount.html.twig */
class __TwigTemplate_67bf129e9a314e919d25536ef9d5062d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/select-amount.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/select-amount.html.twig"));

        // line 1
        echo "<form method=\"post\" id=\"betForm\" action=\"";
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("bet", ["amount" => 1]);
        echo "\">
<p>Välj belopp du vill betta i denna runda. Du har totalt ";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["money"]) || array_key_exists("money", $context) ? $context["money"] : (function () { throw new RuntimeError('Variable "money" does not exist.', 2, $this->source); })()), "html", null, true);
        echo ". Du kan investera max ";
        echo twig_escape_filter($this->env, (isset($context["limit"]) || array_key_exists("limit", $context) ? $context["limit"] : (function () { throw new RuntimeError('Variable "limit" does not exist.', 2, $this->source); })()), "html", null, true);
        echo "</p>
    <p> 
        <input type=\"number\" id=\"betAmount\" name=\"amount\" step=\"10\" max=\"";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["limit"]) || array_key_exists("limit", $context) ? $context["limit"] : (function () { throw new RuntimeError('Variable "limit" does not exist.', 4, $this->source); })()), "html", null, true);
        echo "\" min=\"10\" required=\"required\" value=\"10\">
        <input type=\"submit\" id=\"bet\" name=\"bet\" value=\"Betta\">
    </p>
</form>
<script>
    let betForm = document.getElementById(\"betForm\");
    let betAmount = document.getElementById(\"betAmount\");
    let btn = document.getElementById(\"bet\");
    let chosenAmount;
    btn.addEventListener(\"click\", function () {
        chosenAmount = betAmount.value;
        let url = betForm.action;
        url = url.substring(0,url.length-1);
        betForm.action = url + chosenAmount;
    })
</script>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "game21/incl/select-amount.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 4,  48 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<form method=\"post\" id=\"betForm\" action=\"{{ path('bet', {amount: 1}) }}\">
<p>Välj belopp du vill betta i denna runda. Du har totalt {{ money }}. Du kan investera max {{ limit }}</p>
    <p> 
        <input type=\"number\" id=\"betAmount\" name=\"amount\" step=\"10\" max=\"{{ limit }}\" min=\"10\" required=\"required\" value=\"10\">
        <input type=\"submit\" id=\"bet\" name=\"bet\" value=\"Betta\">
    </p>
</form>
<script>
    let betForm = document.getElementById(\"betForm\");
    let betAmount = document.getElementById(\"betAmount\");
    let btn = document.getElementById(\"bet\");
    let chosenAmount;
    btn.addEventListener(\"click\", function () {
        chosenAmount = betAmount.value;
        let url = betForm.action;
        url = url.substring(0,url.length-1);
        betForm.action = url + chosenAmount;
    })
</script>", "game21/incl/select-amount.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/game21/incl/select-amount.html.twig");
    }
}
