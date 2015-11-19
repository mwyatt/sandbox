<?php

/* partials/login.html.twig */
class __TwigTemplate_eca056ed834882152cbb7cfec3d78324b6e07627873963f55f05cff17f0e9e7a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("partials/base.html.twig", "partials/login.html.twig", 1);
        $this->blocks = array(
            'page' => array($this, 'block_page'),
            'form' => array($this, 'block_form'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "partials/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_page($context, array $blocks = array())
    {
        // line 4
        echo "    <section id=\"admin-login\" class=\"default-glow-shadow\">
        <h1>
            ";
        // line 6
        echo (isset($context["title"]) ? $context["title"] : null);
        echo "
        </h1>

        ";
        // line 9
        $this->loadTemplate("partials/messages.html.twig", "partials/login.html.twig", 9)->display($context);
        // line 10
        echo "
        <form method=\"post\" action=\"";
        // line 11
        echo (isset($context["base_url_relative"]) ? $context["base_url_relative"] : null);
        echo "\">
            ";
        // line 12
        $this->displayBlock('form', $context, $blocks);
        // line 13
        echo "        </form>
    </section>
";
    }

    // line 12
    public function block_form($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "partials/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 12,  53 => 13,  51 => 12,  47 => 11,  44 => 10,  42 => 9,  36 => 6,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends 'partials/base.html.twig' %}*/
/* */
/* {% block page %}*/
/*     <section id="admin-login" class="default-glow-shadow">*/
/*         <h1>*/
/*             {{ title }}*/
/*         </h1>*/
/* */
/*         {% include 'partials/messages.html.twig' %}*/
/* */
/*         <form method="post" action="{{ base_url_relative }}">*/
/*             {% block form %}{% endblock %}*/
/*         </form>*/
/*     </section>*/
/* {% endblock %}*/
