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

/* library/incl/show-many2.html.twig */
class __TwigTemplate_03e0b47020dee23a22b98812c1dc555b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/show-many2.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/show-many2.html.twig"));

        // line 1
        echo "
<main class=\"full-page show-many\">
<h1 class=\"heading\">Alla böcker</h1>
";
        // line 4
        echo twig_include($this->env, $context, "flash.html.twig");
        echo "
<a class=\"close\" href=\"";
        // line 5
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("library");
        echo "\">&#10554; <span class=\"smaller\">Tillbaka till startsidan</span></a>
<section class=\"books\" id=\"books\">



";
        // line 10
        echo twig_include($this->env, $context, "library/incl/reset-button.html.twig");
        echo "
<div class=\"box-container\">

";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["books"]) || array_key_exists("books", $context) ? $context["books"] : (function () { throw new RuntimeError('Variable "books" does not exist.', 13, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["book"]) {
            // line 14
            echo "<div class=\"box\">
    <div class=\"image\">
    <img src=\"";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "img", [], "any", false, false, false, 16), "html", null, true);
            echo "\" alt=\"bild på bok ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "title", [], "any", false, false, false, 16), "html", null, true);
            echo "\">
    </div>
    <div class=\"content\">
        <span class=\"book-title\">";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "title", [], "any", false, false, false, 19), "html", null, true);
            echo "</span>
        <span class=\"isbn\">ISBN ";
            // line 20
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "isbn", [], "any", false, false, false, 20), "html", null, true);
            echo "</span>
        <span class=\"author\">";
            // line 21
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "author", [], "any", false, false, false, 21), "html", null, true);
            echo "</span>
    <a class=\"btn\" href=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("read_one", ["isbn" => twig_get_attribute($this->env, $this->source, $context["book"], "isbn", [], "any", false, false, false, 22)]), "html", null, true);
            echo "\">Se bok</a>
    </div>
</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['book'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "
</div>

</section>

<span display=\"hidden\" id=\"placeholder-img\">";
        // line 31
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/placeholder.png"), "html", null, true);
        echo "</span>

</main>
<script>
const placeholder = document.getElementById(\"placeholder-img\");
const imagePath = placeholder.innerText;
placeholder.remove();
const images = document.querySelectorAll('img');

images.forEach(img => {
    img.addEventListener('error', function handleError() {
        img.src = imagePath;
        img.alt = 'placeholder image';
    });
});


</script>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "library/incl/show-many2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 31,  104 => 26,  94 => 22,  90 => 21,  86 => 20,  82 => 19,  74 => 16,  70 => 14,  66 => 13,  60 => 10,  52 => 5,  48 => 4,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
<main class=\"full-page show-many\">
<h1 class=\"heading\">Alla böcker</h1>
{{ include('flash.html.twig') }}
<a class=\"close\" href=\"{{ path('library') }}\">&#10554; <span class=\"smaller\">Tillbaka till startsidan</span></a>
<section class=\"books\" id=\"books\">



{{ include('library/incl/reset-button.html.twig') }}
<div class=\"box-container\">

{% for book in books %}
<div class=\"box\">
    <div class=\"image\">
    <img src=\"{{ book.img }}\" alt=\"bild på bok {{ book.title }}\">
    </div>
    <div class=\"content\">
        <span class=\"book-title\">{{ book.title }}</span>
        <span class=\"isbn\">ISBN {{ book.isbn }}</span>
        <span class=\"author\">{{ book.author }}</span>
    <a class=\"btn\" href=\"{{ path('read_one', {isbn: book.isbn}) }}\">Se bok</a>
    </div>
</div>
{% endfor %}

</div>

</section>

<span display=\"hidden\" id=\"placeholder-img\">{{ asset('img/placeholder.png') }}</span>

</main>
<script>
const placeholder = document.getElementById(\"placeholder-img\");
const imagePath = placeholder.innerText;
placeholder.remove();
const images = document.querySelectorAll('img');

images.forEach(img => {
    img.addEventListener('error', function handleError() {
        img.src = imagePath;
        img.alt = 'placeholder image';
    });
});


</script>", "library/incl/show-many2.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/library/incl/show-many2.html.twig");
    }
}
