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

/* library/incl/drafts/form-new.html.twig */
class __TwigTemplate_07a7456156ec568c5ba3e1a08b7c262a extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/drafts/form-new.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/drafts/form-new.html.twig"));

        // line 1
        echo "<div class=\"container\">
    <div class=\"container-close\"><a>&times;</a></div>
    <img src=\"\" alt=\"image\" id=\"photo\">
    <h2>Fyll i bokdetaljer här</h2>
        <form method=\"post\" action=\"\">
        
            <label for=\"title\">Titel</label>
            <input id=\"title\" type=\"text\" required=\"required\" min-length=\"1\" max-length=\"255\" placeholder=\"bokens titel\">

            <label for=\"isbn\">ISBN</label>
            <input id=\"isbn\" type=\"text\" required=\"required\" min-length=\"13\" max-length=\"13\" placeholder=\"isbn, 13 siffror\">

            <label for=\"author\">Författare</label>
            <input id=\"author\" type=\"text\" required=\"required\" min-length=\"1\" max-length=\"255\" placeholder=\"namn på författare\">

            <label for=\"image\">Bildlänk</label>
            <input id=\"image\" type=\"url\" required=\"required\" min-length=\"1\" max-length=\"255\" placeholder=\"länk till bild\">

            <input type=\"submit\" class=\"btn\" value=\"Spara\" name=\"do\">
        </form>
    </div>
  </div>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "library/incl/drafts/form-new.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"container\">
    <div class=\"container-close\"><a>&times;</a></div>
    <img src=\"\" alt=\"image\" id=\"photo\">
    <h2>Fyll i bokdetaljer här</h2>
        <form method=\"post\" action=\"\">
        
            <label for=\"title\">Titel</label>
            <input id=\"title\" type=\"text\" required=\"required\" min-length=\"1\" max-length=\"255\" placeholder=\"bokens titel\">

            <label for=\"isbn\">ISBN</label>
            <input id=\"isbn\" type=\"text\" required=\"required\" min-length=\"13\" max-length=\"13\" placeholder=\"isbn, 13 siffror\">

            <label for=\"author\">Författare</label>
            <input id=\"author\" type=\"text\" required=\"required\" min-length=\"1\" max-length=\"255\" placeholder=\"namn på författare\">

            <label for=\"image\">Bildlänk</label>
            <input id=\"image\" type=\"url\" required=\"required\" min-length=\"1\" max-length=\"255\" placeholder=\"länk till bild\">

            <input type=\"submit\" class=\"btn\" value=\"Spara\" name=\"do\">
        </form>
    </div>
  </div>
", "library/incl/drafts/form-new.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/library/incl/drafts/form-new.html.twig");
    }
}
