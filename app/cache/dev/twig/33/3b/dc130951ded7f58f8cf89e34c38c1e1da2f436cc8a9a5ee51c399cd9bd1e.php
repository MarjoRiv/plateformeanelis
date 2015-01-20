<?php

/* ApplicationCotisationBundle:Default:add.html.twig */
class __TwigTemplate_333bdc130951ded7f58f8cf89e34c38c1e1da2f436cc8a9a5ee51c399cd9bd1e extends Twig_Template
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Nouvelle cotisation";
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "
    <div id=\"page-content\">
      <div id='wrap'>
        <div id=\"page-heading\">
          <ol class=\"breadcrumb\">
            <li><a href=\"";
        // line 10
        echo $this->env->getExtension('routing')->getPath("application_main_homepage");
        echo "\">Plateforme</a></li>
            <li><a href=\"";
        // line 11
        echo $this->env->getExtension('routing')->getPath("application_cotisation_homepage");
        echo "\" title=\"Cotisation\">Cotisations</a></li>
            <li class=\"active\">Nouvelle cotisation</li>
        </ol>
        <h1>Nouvelle cotisation</h1>
    </div>
    <div class=\"container\">

        <div class=\"panel panel-midnightblue\">
            <div class=\"panel-heading\">
              <h4>Nouvelle cotisation</h4>
          </div>
          <div class=\"panel-body collapse in\">
            <p class=\"text-info\">Il existe deux types de cotisation : <strong>Membre (10 &euro;)</strong> et <strong>Membre Bienfaisant (montant libre)</strong>.<br />L'argent récolté nous permet de faire <strong>vivre l'association</strong> et d'<strong>organiser des événements</strong> comme les récrées ANELIS.</p>
            <form class=\"form-horizontal\" method=\"post\" ";
        // line 24
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo ">
                <div class=\"form-group\">
                    ";
        // line 26
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "typeCotisation", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Type*"));
        echo "
                    <div class=\"col-sm-6\">
                        ";
        // line 28
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "typeCotisation", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                    </div>
                </div>
                <div class=\"form-group\">
                    ";
        // line 32
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "year", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Année*"));
        echo "
                    <div class=\"col-sm-6\">
                        ";
        // line 34
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "year", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                    </div>
                </div>
                <div class=\"form-group\">
                    ";
        // line 38
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
                    ";
        // line 39
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "

                </div>
                <p class=\"text-warning\">Une fois votre demande de cotisation effectuée, il suffit de visualiser la facture générée et de la payer pour que celle-ci soit prise en compte.</p>
                <div class=\"panel-footer\">
                    <div class=\"row\">
                        <div class=\"text-center\">
                            <div class=\"btn-toolbar\">
                                <button class=\"btn-primary btn\">Cotiser</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!--wrap -->
</div>
<!-- page-content -->
<script>
        global = {
            locale   : '";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "locale", array()), "html", null, true);
        echo "'
        }
</script>


";
    }

    public function getTemplateName()
    {
        return "ApplicationCotisationBundle:Default:add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 63,  106 => 39,  102 => 38,  95 => 34,  90 => 32,  83 => 28,  78 => 26,  73 => 24,  57 => 11,  53 => 10,  46 => 5,  43 => 4,  37 => 3,  11 => 1,);
    }
}
