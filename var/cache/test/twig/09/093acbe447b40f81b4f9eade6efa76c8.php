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

/* library/incl/header-lib.html.twig */
class __TwigTemplate_6d0b60082633856b446bb1484cb1369d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/header-lib.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/header-lib.html.twig"));

        // line 1
        echo "        <header class=\"site-header full-page\" style=\"background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/background3.jpg"), "html", null, true);
        echo ")\">
            ";
        // line 3
        echo "            <h1>Biblioteket</h1>

            <div class=\"flex-row full-width\">
            <a href=\"";
        // line 6
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("read_many");
        echo "\" class=\"btn primary\">Se alla böcker</a>
            <a href=\"";
        // line 7
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("create_form");
        echo "\" class=\"btn secondary from-top\">Ny bok</a>
            </div>
        
        </header>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "library/incl/header-lib.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 7,  53 => 6,  48 => 3,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("        <header class=\"site-header full-page\" style=\"background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset('img/background3.jpg') }})\">
            {# <span class=\"site-title\">Biblioteket</span> #}
            <h1>Biblioteket</h1>

            <div class=\"flex-row full-width\">
            <a href=\"{{ path('read_many') }}\" class=\"btn primary\">Se alla böcker</a>
            <a href=\"{{ path('create_form') }}\" class=\"btn secondary from-top\">Ny bok</a>
            </div>
        
        </header>", "library/incl/header-lib.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/library/incl/header-lib.html.twig");
    }
}
