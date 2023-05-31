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

/* library/incl/show-many.html.twig */
class __TwigTemplate_afdb899be03bbc91edc81c1e1cfd6ef9 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/show-many.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/show-many.html.twig"));

        // line 1
        echo "<main class=\"full-page show-many\">
";
        // line 2
        echo twig_include($this->env, $context, "library/incl/reset-button.html.twig");
        echo "
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["books"]) || array_key_exists("books", $context) ? $context["books"] : (function () { throw new RuntimeError('Variable "books" does not exist.', 3, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["book"]) {
            // line 4
            echo "        <p>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "id", [], "any", false, false, false, 4), "html", null, true);
            echo "</p>
        <p>";
            // line 5
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "title", [], "any", false, false, false, 5), "html", null, true);
            echo "</p>
        <p>";
            // line 6
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "isbn", [], "any", false, false, false, 6), "html", null, true);
            echo "</p>
        <p>";
            // line 7
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "author", [], "any", false, false, false, 7), "html", null, true);
            echo "</p>
        <img src=\"";
            // line 8
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "img", [], "any", false, false, false, 8), "html", null, true);
            echo "\" alt=\"bokomslag ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "title", [], "any", false, false, false, 8), "html", null, true);
            echo "\">
        <a class=\"btn\" href=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("read_one", ["isbn" => twig_get_attribute($this->env, $this->source, $context["book"], "isbn", [], "any", false, false, false, 9)]), "html", null, true);
            echo "\">Se bok</a>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['book'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "
<span display=\"hidden\" id=\"placeholder-img\">";
        // line 12
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/libro.svg"), "html", null, true);
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
        return "library/incl/show-many.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 12,  85 => 11,  77 => 9,  71 => 8,  67 => 7,  63 => 6,  59 => 5,  54 => 4,  50 => 3,  46 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<main class=\"full-page show-many\">
{{ include('library/incl/reset-button.html.twig') }}
    {% for book in books %}
        <p>{{ book.id }}</p>
        <p>{{ book.title }}</p>
        <p>{{ book.isbn }}</p>
        <p>{{ book.author }}</p>
        <img src=\"{{ book.img }}\" alt=\"bokomslag {{ book.title }}\">
        <a class=\"btn\" href=\"{{ path('read_one', {isbn: book.isbn}) }}\">Se bok</a>
    {% endfor %}

<span display=\"hidden\" id=\"placeholder-img\">{{ asset('img/libro.svg') }}</span>
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


</script>", "library/incl/show-many.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/library/incl/show-many.html.twig");
    }
}
