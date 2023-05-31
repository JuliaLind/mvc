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

/* report.html.twig */
class __TwigTemplate_e7f64c1a1d32e5452c492f47f546f723 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "report.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "report.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "report.html.twig", 1);
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

        echo "Report";
        
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
        echo "    <h1>Report</h1>


    <section id=\"kmom01\">
        ";
        // line 10
        echo (isset($context["kmom01"]) || array_key_exists("kmom01", $context) ? $context["kmom01"] : (function () { throw new RuntimeError('Variable "kmom01" does not exist.', 10, $this->source); })());
        echo "
    </section>
    <section id=\"kmom02\">
        ";
        // line 13
        echo (isset($context["kmom02"]) || array_key_exists("kmom02", $context) ? $context["kmom02"] : (function () { throw new RuntimeError('Variable "kmom02" does not exist.', 13, $this->source); })());
        echo "
    </section> 
    <section id=\"kmom03\">
        ";
        // line 16
        echo (isset($context["kmom03"]) || array_key_exists("kmom03", $context) ? $context["kmom03"] : (function () { throw new RuntimeError('Variable "kmom03" does not exist.', 16, $this->source); })());
        echo "
    </section> 
    <section id=\"kmom04\">
        ";
        // line 19
        echo (isset($context["kmom04"]) || array_key_exists("kmom04", $context) ? $context["kmom04"] : (function () { throw new RuntimeError('Variable "kmom04" does not exist.', 19, $this->source); })());
        echo "
    </section> 
    <section id=\"kmom05\">
        ";
        // line 22
        echo (isset($context["kmom05"]) || array_key_exists("kmom05", $context) ? $context["kmom05"] : (function () { throw new RuntimeError('Variable "kmom05" does not exist.', 22, $this->source); })());
        echo "
    </section> 
    <section id=\"kmom06\">
        ";
        // line 25
        echo (isset($context["kmom06"]) || array_key_exists("kmom06", $context) ? $context["kmom06"] : (function () { throw new RuntimeError('Variable "kmom06" does not exist.', 25, $this->source); })());
        echo "
    </section> 
    <section id=\"kmom10\">
        ";
        // line 28
        echo (isset($context["kmom07"]) || array_key_exists("kmom07", $context) ? $context["kmom07"] : (function () { throw new RuntimeError('Variable "kmom07" does not exist.', 28, $this->source); })());
        echo "
    </section>  

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "report.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 28,  124 => 25,  118 => 22,  112 => 19,  106 => 16,  100 => 13,  94 => 10,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Report{% endblock %}

{% block body %}
    <h1>Report</h1>


    <section id=\"kmom01\">
        {{ kmom01 | raw }}
    </section>
    <section id=\"kmom02\">
        {{ kmom02 | raw }}
    </section> 
    <section id=\"kmom03\">
        {{ kmom03 | raw }}
    </section> 
    <section id=\"kmom04\">
        {{ kmom04 | raw }}
    </section> 
    <section id=\"kmom05\">
        {{ kmom05 | raw }}
    </section> 
    <section id=\"kmom06\">
        {{ kmom06 | raw }}
    </section> 
    <section id=\"kmom10\">
        {{ kmom07 | raw }}
    </section>  

{% endblock %}", "report.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/report.html.twig");
    }
}
