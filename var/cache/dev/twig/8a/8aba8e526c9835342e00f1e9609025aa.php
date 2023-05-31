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

/* library/incl/form-update.html.twig */
class __TwigTemplate_51828569c2ba34fb47708c210c044c8f extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/form-update.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/form-update.html.twig"));

        // line 1
        echo "<h1>Uppdatera bokdetaljer för '";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 1, $this->source); })()), "title", [], "any", false, false, false, 1), "html", null, true);
        echo "'</h1>

";
        // line 3
        echo twig_include($this->env, $context, "flash.html.twig");
        echo "

<div class=\"container\">
    <a class=\"close\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("read_one", ["isbn" => twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 6, $this->source); })()), "isbn", [], "any", false, false, false, 6)]), "html", null, true);
        echo "\">&times;</a>
    <div class=\"flex-row\">
    <div class=\"image-container\" id=\"image-container\">
    <img src=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 9, $this->source); })()), "img", [], "any", false, false, false, 9), "html", null, true);
        echo "\" alt=\"foto på bok ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 9, $this->source); })()), "title", [], "any", false, false, false, 9), "html", null, true);
        echo "\" id=\"photo\">
    </div>
        <form method=\"post\" action=\"";
        // line 11
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("book_update");
        echo "\">
            <div class=\"inputbox\">
            <input id=\"title\" class=\"is-filled\" name=\"title\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 13, $this->source); })()), "title", [], "any", false, false, false, 13), "html", null, true);
        echo "\">
            <span>Titel</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"isbn\" name=\"isbn\" type=\"text\" readonly=\"readonly\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 18, $this->source); })()), "isbn", [], "any", false, false, false, 18), "html", null, true);
        echo "\">
            ";
        // line 20
        echo "            <span>ISBN (13 siffror)</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"author\" name=\"author\" class=\"is-filled\" type=\"text\" required=\"required\" minlength=\"1\" max-length=\"255\" value=\"";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 24, $this->source); })()), "author", [], "any", false, false, false, 24), "html", null, true);
        echo "\">
            <span>Författare</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"image\" name=\"image\" class=\"is-filled\" type=\"url\" required=\"required\" minlength=\"1\" max-length=\"255\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 29, $this->source); })()), "img", [], "any", false, false, false, 29), "html", null, true);
        echo "\">
            <span>Url länk till bild</span>
            </div>
            <input type=\"hidden\" value=\"";
        // line 32
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 32, $this->source); })()), "id", [], "any", false, false, false, 32), "html", null, true);
        echo "\" name=\"book_id\">
            <input type=\"hidden\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["book"]) || array_key_exists("book", $context) ? $context["book"] : (function () { throw new RuntimeError('Variable "book" does not exist.', 33, $this->source); })()), "isbn", [], "any", false, false, false, 33), "html", null, true);
        echo "\" name=\"original_isbn\">
            <input type=\"submit\" class=\"btn\" value=\"Spara\" name=\"do\">
            <p>Samtliga fält är obligatoriska</p>

        </form>
    </div>
  </div>

<script>
    let photo = document.getElementById(\"photo\");
    let imageLink = document.getElementById(\"image\");
    let originalImg = photo.src;
    let originalAlt = photo.alt;
    let title = document.getElementById(\"title\");
    let isbn = document.getElementById(\"isbn\");
    let author = document.getElementById(\"author\");
    let imgContainer = document.getElementById(\"image-container\");

    imageLink.addEventListener(\"change\", function () {
        photo.src = imageLink.value;
        imgContainer.classList.remove(\"missing-image\");

        if (imageLink.value != \"\") {
            imageLink.classList.add(\"is-filled\");
        } else {
            imageLink.classList.remove(\"is-filled\");
            photo.src = originalImg;
            photo.alt = originalAlt;
        }
    });

    photo.addEventListener('error', function handleError() {
        photo.alt = `Om du ser denna text så betyder det att länken '\${imageLink.value}' inte leder till någon bild`;
        imgContainer.classList.add(\"missing-image\");
    });


    for (const field of [title, isbn, author]) {
        field.addEventListener(\"change\", function() {
            if (field.value != \"\") {
                field.classList.add(\"is-filled\");
            } else {
                field.classList.remove(\"is-filled\");
            }
        });
    }

</script>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "library/incl/form-update.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 33,  105 => 32,  99 => 29,  91 => 24,  85 => 20,  81 => 18,  73 => 13,  68 => 11,  61 => 9,  55 => 6,  49 => 3,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<h1>Uppdatera bokdetaljer för '{{ book.title }}'</h1>

{{ include('flash.html.twig') }}

<div class=\"container\">
    <a class=\"close\" href=\"{{ path('read_one', {isbn: book.isbn}) }}\">&times;</a>
    <div class=\"flex-row\">
    <div class=\"image-container\" id=\"image-container\">
    <img src=\"{{ book.img }}\" alt=\"foto på bok {{ book.title }}\" id=\"photo\">
    </div>
        <form method=\"post\" action=\"{{ path('book_update') }}\">
            <div class=\"inputbox\">
            <input id=\"title\" class=\"is-filled\" name=\"title\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\" value=\"{{ book.title }}\">
            <span>Titel</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"isbn\" name=\"isbn\" type=\"text\" readonly=\"readonly\" value=\"{{ book.isbn }}\">
            {# <input id=\"isbn\" name=\"isbn\" class=\"is-filled\" type=\"text\" required=\"required\" maxlength=\"13\" required pattern=\"[0-9]{13}\" value=\"{{ book.isbn }}\"> #}
            <span>ISBN (13 siffror)</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"author\" name=\"author\" class=\"is-filled\" type=\"text\" required=\"required\" minlength=\"1\" max-length=\"255\" value=\"{{ book.author }}\">
            <span>Författare</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"image\" name=\"image\" class=\"is-filled\" type=\"url\" required=\"required\" minlength=\"1\" max-length=\"255\" value=\"{{ book.img }}\">
            <span>Url länk till bild</span>
            </div>
            <input type=\"hidden\" value=\"{{ book.id }}\" name=\"book_id\">
            <input type=\"hidden\" value=\"{{ book.isbn }}\" name=\"original_isbn\">
            <input type=\"submit\" class=\"btn\" value=\"Spara\" name=\"do\">
            <p>Samtliga fält är obligatoriska</p>

        </form>
    </div>
  </div>

<script>
    let photo = document.getElementById(\"photo\");
    let imageLink = document.getElementById(\"image\");
    let originalImg = photo.src;
    let originalAlt = photo.alt;
    let title = document.getElementById(\"title\");
    let isbn = document.getElementById(\"isbn\");
    let author = document.getElementById(\"author\");
    let imgContainer = document.getElementById(\"image-container\");

    imageLink.addEventListener(\"change\", function () {
        photo.src = imageLink.value;
        imgContainer.classList.remove(\"missing-image\");

        if (imageLink.value != \"\") {
            imageLink.classList.add(\"is-filled\");
        } else {
            imageLink.classList.remove(\"is-filled\");
            photo.src = originalImg;
            photo.alt = originalAlt;
        }
    });

    photo.addEventListener('error', function handleError() {
        photo.alt = `Om du ser denna text så betyder det att länken '\${imageLink.value}' inte leder till någon bild`;
        imgContainer.classList.add(\"missing-image\");
    });


    for (const field of [title, isbn, author]) {
        field.addEventListener(\"change\", function() {
            if (field.value != \"\") {
                field.classList.add(\"is-filled\");
            } else {
                field.classList.remove(\"is-filled\");
            }
        });
    }

</script>
", "library/incl/form-update.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/library/incl/form-update.html.twig");
    }
}
