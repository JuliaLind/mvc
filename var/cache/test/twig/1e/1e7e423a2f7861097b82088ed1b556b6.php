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

/* library/incl/form-new.html.twig */
class __TwigTemplate_4766a46499a7bcc1977097926f4342e6 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/form-new.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "library/incl/form-new.html.twig"));

        // line 1
        echo "<h1>Registrera ny bok</h1>

";
        // line 3
        echo twig_include($this->env, $context, "flash.html.twig");
        echo "

<div class=\"container\">
    <a class=\"close\" href=\"";
        // line 6
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("library");
        echo "\">&times;</a>
    <div class=\"flex-row\">
    <div class=\"image-container\" id=\"image-container\">
    <img class=\"no-border\" src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/libro.svg"), "html", null, true);
        echo "\" alt=\"Placeholder image\" id=\"photo\">
    </div>
        <form method=\"post\" action=\"";
        // line 11
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("book_create");
        echo "\">
            <div class=\"inputbox\">
            <input id=\"title\" name=\"title\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\">
            <span>Titel</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"isbn\" name=\"isbn\" type=\"text\" required=\"required\" maxlength=\"13\" required pattern=\"[0-9]{13}\">
            <span>ISBN (13 siffror)</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"author\" name=\"author\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\">
            <span>Författare</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"image\" name=\"image\" type=\"url\" required=\"required\" minlength=\"1\" maxlength=\"255\">
            <span>Url länk till bild</span>
            </div>
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
        return "library/incl/form-new.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 11,  59 => 9,  53 => 6,  47 => 3,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<h1>Registrera ny bok</h1>

{{ include('flash.html.twig') }}

<div class=\"container\">
    <a class=\"close\" href=\"{{ path('library') }}\">&times;</a>
    <div class=\"flex-row\">
    <div class=\"image-container\" id=\"image-container\">
    <img class=\"no-border\" src=\"{{ asset('img/libro.svg') }}\" alt=\"Placeholder image\" id=\"photo\">
    </div>
        <form method=\"post\" action=\"{{ path('book_create') }}\">
            <div class=\"inputbox\">
            <input id=\"title\" name=\"title\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\">
            <span>Titel</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"isbn\" name=\"isbn\" type=\"text\" required=\"required\" maxlength=\"13\" required pattern=\"[0-9]{13}\">
            <span>ISBN (13 siffror)</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"author\" name=\"author\" type=\"text\" required=\"required\" minlength=\"1\" maxlength=\"255\">
            <span>Författare</span>
            </div>

            <div class=\"inputbox\">
            <input id=\"image\" name=\"image\" type=\"url\" required=\"required\" minlength=\"1\" maxlength=\"255\">
            <span>Url länk till bild</span>
            </div>
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
", "library/incl/form-new.html.twig", "/home/juli22/dbwebb-kurser/mvc/me/report/templates/library/incl/form-new.html.twig");
    }
}
