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

/* game21/incl/start-buttons.html.twig */
class __TwigTemplate_6c30fd389370685f5566b3feaa0a4763 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/start-buttons.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game21/incl/start-buttons.html.twig"));

        // line 1
        echo "<form method=\"post\" action=\"\">
<p>Klicka på en av knapparna för att börja spela</p>
    <p>
        <input type=\"submit\" name=\"level\" value=\"Easy\"
            onClick=\"this.form.action='";
        // line 5
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("init");
        echo "';\"
        >

        <input type=\"submit\" name=\"level\" value=\"Hard\"
            onClick=\"this.form.action='";
        // line 9
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("init", ["level" => 2]);
        echo "';\"
        >
    </p>
</form>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "game21/incl/start-buttons.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 9,  49 => 5,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<form method=\"post\" action=\"\">
<p>Klicka på en av knapparna för att börja spela</p>
    <p>
        <input type=\"submit\" name=\"level\" value=\"Easy\"
            onClick=\"this.form.action='{{ path('init') }}';\"
        >

        <input type=\"submit\" name=\"level\" value=\"Hard\"
            onClick=\"this.form.action='{{ path('init', {level: 2}) }}';\"
        >
    </p>
</form>", "game21/incl/start-buttons.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/game21/incl/start-buttons.html.twig");
    }
}
