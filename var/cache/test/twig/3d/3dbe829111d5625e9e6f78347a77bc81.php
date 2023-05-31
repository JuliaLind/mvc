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

/* library/incl/form-show.html.twig */
class __TwigTemplate_9bc5d8c9004171a7be371cf79dfd9f5a extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/form-show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/form-show.html.twig"));

        // line 1
        echo "<h1>Detaljer för bok '";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 1, $this->source); })()), "title", [], "any", false, false, false, 1), "html", null, true);
        echo "'</h1>

";
        // line 3
        echo twig_include($this->env, $context, "flash.html.twig");
        echo "

<div class=\"container\">
    <a class=\"close\" href=\"";
        // line 6
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("read_many");
        echo "\">&times;</a>
    <div class=\"flex-row\">
    <div class=\"image-container\">
    <img src=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 9, $this->source); })()), "img", [], "any", false, false, false, 9), "html", null, true);
        echo "\" alt=\"Bild på bok '";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 9, $this->source); })()), "title", [], "any", false, false, false, 9), "html", null, true);
        echo "'\" id=\"photo\">
    </div>
        <form method=\"post\" action=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("book_delete_by_isbn", ["isbn" => twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 11, $this->source); })()), "isbn", [], "any", false, false, false, 11)]), "html", null, true);
        echo "\">
            <div class=\"inputbox\">
            <input id=\"title\" name=\"title\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\" readonly=\"readonly\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 13, $this->source); })()), "title", [], "any", false, false, false, 13), "html", null, true);
        echo "\" class=\"is-filled\">
            <span>Titel</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"isbn\" name=\"isbn\" type=\"text\" required=\"required\" maxlength=\"13\" required pattern=\"[0-9]{13}\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 18, $this->source); })()), "isbn", [], "any", false, false, false, 18), "html", null, true);
        echo "\" readonly=\"readonly\" class=\"is-filled\">
            <span>ISBN</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"author\" name=\"author\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 23, $this->source); })()), "author", [], "any", false, false, false, 23), "html", null, true);
        echo "\" readonly=\"readonly\" class=\"is-filled\">
            <span>Författare</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"image\" name=\"image\" type=\"url\" required=\"required\" minlength=\"1\" maxlength=\"255\" value=\"";
        // line 28
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 28, $this->source); })()), "img", [], "any", false, false, false, 28), "html", null, true);
        echo "\" readonly=\"readonly\" class=\"is-filled\">
            <span>Url länk till bild</span>
            </div>

            <a class=\"btn\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("update_form", ["isbn" => twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 32, $this->source); })()), "isbn", [], "any", false, false, false, 32)]), "html", null, true);
        echo "\">Redigera</a>
            <input type=\"submit\" class=\"btn alternative\" value=\"Radera\" name=\"do\">

        </form>
    </div>
  </div>

<span display=\"hidden\" id=\"placeholder-img\">";
        // line 39
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/placeholder.png"), "html", null, true);
        echo "</span>

<script>
const placeholder = document.getElementById(\"placeholder-img\");
const imagePath = placeholder.innerText;
placeholder.remove();
const image = document.getElementById('photo');


image.addEventListener('error', function handleError() {
    image.src = imagePath;
    image.alt = 'placeholder image';
});



</script>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "library/incl/form-show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 39,  104 => 32,  97 => 28,  89 => 23,  81 => 18,  73 => 13,  68 => 11,  61 => 9,  55 => 6,  49 => 3,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<h1>Detaljer för bok '{{ book.title }}'</h1>

{{ include('flash.html.twig') }}

<div class=\"container\">
    <a class=\"close\" href=\"{{ path('read_many') }}\">&times;</a>
    <div class=\"flex-row\">
    <div class=\"image-container\">
    <img src=\"{{ book.img }}\" alt=\"Bild på bok '{{ book.title }}'\" id=\"photo\">
    </div>
        <form method=\"post\" action=\"{{ path('book_delete_by_isbn', {isbn: book.isbn}) }}\">
            <div class=\"inputbox\">
            <input id=\"title\" name=\"title\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\" readonly=\"readonly\" value=\"{{ book.title }}\" class=\"is-filled\">
            <span>Titel</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"isbn\" name=\"isbn\" type=\"text\" required=\"required\" maxlength=\"13\" required pattern=\"[0-9]{13}\" value=\"{{ book.isbn }}\" readonly=\"readonly\" class=\"is-filled\">
            <span>ISBN</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"author\" name=\"author\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\" value=\"{{ book.author }}\" readonly=\"readonly\" class=\"is-filled\">
            <span>Författare</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"image\" name=\"image\" type=\"url\" required=\"required\" minlength=\"1\" maxlength=\"255\" value=\"{{ book.img }}\" readonly=\"readonly\" class=\"is-filled\">
            <span>Url länk till bild</span>
            </div>

            <a class=\"btn\" href=\"{{ path('update_form', {isbn: book.isbn}) }}\">Redigera</a>
            <input type=\"submit\" class=\"btn alternative\" value=\"Radera\" name=\"do\">

        </form>
    </div>
  </div>

<span display=\"hidden\" id=\"placeholder-img\">{{ asset('img/placeholder.png') }}</span>

<script>
const placeholder = document.getElementById(\"placeholder-img\");
const imagePath = placeholder.innerText;
placeholder.remove();
const image = document.getElementById('photo');


image.addEventListener('error', function handleError() {
    image.src = imagePath;
    image.alt = 'placeholder image';
});



</script>", "library/incl/form-show.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/library/incl/form-show.html.twig");
    }
}
