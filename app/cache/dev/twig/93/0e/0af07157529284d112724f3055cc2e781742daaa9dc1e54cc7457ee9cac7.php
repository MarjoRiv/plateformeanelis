<?php

/* ::base.html.twig */
class __TwigTemplate_930e0af07157529284d112724f3055cc2e781742daaa9dc1e54cc7457ee9cac7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'optbody' => array($this, 'block_optbody'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo " - Plateforme ANELIS</title>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta name=\"description\" content=\"Plateforme ANELIS\">
        <meta name=\"author\" content=\"David Santiago\">

        <link href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/less/styles.less"), "html", null, true);
        echo "\" rel=\"stylesheet/less\" media=\"all\"> 
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

        ";
        // line 13
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 14
        echo "
        <script type=\"text/javascript\" src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/less.js"), "html", null, true);
        echo "\"></script>
    </head>
    <body";
        // line 17
        $this->displayBlock('optbody', $context, $blocks);
        echo ">
        ";
        // line 18
        $this->displayBlock('content', $context, $blocks);
        // line 19
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 20
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
    }

    // line 13
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 17
    public function block_optbody($context, array $blocks = array())
    {
    }

    // line 18
    public function block_content($context, array $blocks = array())
    {
    }

    // line 19
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 19,  84 => 18,  79 => 17,  74 => 13,  69 => 5,  63 => 20,  60 => 19,  58 => 18,  54 => 17,  49 => 15,  46 => 14,  44 => 13,  38 => 10,  30 => 5,  24 => 1,);
    }
}
