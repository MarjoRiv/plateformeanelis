<?php

/* AdminUserBundle:Profile:user.edit.html.twig */
class __TwigTemplate_eaf66a67c3b1afc2613ad0d4faa682e585fcee29d6f6bb45838a79a578a6e221 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("::application.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::application.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $this->env->getExtension('form')->renderer->setTheme((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), array(0 => "AdminUserBundle:Form:user.html.twig"));
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Mon Compte";
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "<div id=\"page-content\">
  <div id='wrap'>
    <div id=\"page-heading\">
      <ol class=\"breadcrumb\">
        <li><a href=\"";
        // line 9
        echo $this->env->getExtension('routing')->getPath("application_main_homepage");
        echo "\">Plateforme</a></li>
        <li class=\"active\">Mon Compte</li>
      </ol>
      <h1>Mon Compte</h1>
    </div>

    <div class=\"container\">      
      <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"panel panel-primary\">
            <div class=\"panel-heading\">
              <h4>Mon Compte</h4>
            </div>
                          ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
          </div>
        </div>
      </div>
    </div>
    <!-- container -->
  </div>
  <!--wrap -->
</div>
<!-- page-content -->

";
    }

    public function getTemplateName()
    {
        return "AdminUserBundle:Profile:user.edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 22,  55 => 9,  49 => 5,  46 => 4,  40 => 3,  36 => 1,  34 => 2,  11 => 1,);
    }
}
