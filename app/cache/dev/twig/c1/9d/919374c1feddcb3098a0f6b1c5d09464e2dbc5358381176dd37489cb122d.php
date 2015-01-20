<?php

/* ApplicationMainBundle:Default:index.html.twig */
class __TwigTemplate_c19d919374c1feddcb3098a0f6b1c5d09464e2dbc5358381176dd37489cb122d extends Twig_Template
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
        echo "Accueil";
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "<div id=\"page-content\">
    <div id='wrap'>
        <div id=\"page-heading\" class=\"hidden-print\">
            <ol class=\"breadcrumb\">
                <li class=\"active\">Accueil</li>
            </ol>

            <h1>Bienvenue</h1>
        </div>

        <div class=\"container\">

        <div class=\"row\">
                <div class=\"col-md-7\">
                    <div class=\"panel panel-primary\">
                      <div class=\"panel-heading\">
                            <h4>Bienvenue</h4>
                      </div>
                      <div class=\"panel-body\">
                        <p>
                            Lorem ipsum sin adequat<br><br><br><br><br>
                        </p>
                      </div>
                    </div>
                </div>
                <div class=\"col-md-5\">
                    <div class=\"panel panel-primary\">
                      <div class=\"panel-heading\">
                            <h4>Prochains évènements</h4>
                      </div>
                      <div class=\"panel-body\">
                            <p>Lorem ipsum</p>
                      </div>
                    </div>
                </div>
            </div>

            <div class=\"row hidden-print\">
                <div class=\"col-md-12\">
                    <div class=\"row\">
                        <div class=\"col-md-3 col-xs-12 col-sm-6\">
                            <a class=\"info-tiles tiles-orange\" href=\"#\">
                                <div class=\"tiles-heading\">Membres</div>
                                <div class=\"tiles-body-alt\">
                                    <i class=\"fa fa-group\"></i>
                                    <div class=\"text-center\">2500</div>
                                    <small>anciens</small>
                                </div>
                            </a>
                        </div>
                        <div class=\"col-md-3 col-xs-12 col-sm-6\">
                            <a class=\"info-tiles tiles-toyo\" href=\"#\">
                                <div class=\"tiles-heading\">Annonces</div>
                                <div class=\"tiles-body-alt\">
                                    <i class=\"fa fa-eye\"></i>
                                    <div class=\"text-center\">854</div>
                                    <small>annonces disponible</small>
                                </div>
                            </a>
                        </div>
                        <div class=\"col-md-3 col-xs-12 col-sm-6\">
                            <a class=\"info-tiles tiles-success\" href=\"#\">
                                <div class=\"tiles-heading\">Récrées</div>
                                <div class=\"tiles-body-alt\">
                                    <i class=\"fa fa-video-camera\"></i>
                                    <div class=\"text-center\">10</div>
                                    <small>talks disponible</small>
                                </div>
                            </a>
                        </div>
                        
                        <div class=\"col-md-3 col-xs-12 col-sm-6\">
                            <a class=\"info-tiles tiles-alizarin\" href=\"#\">
                                <div class=\"tiles-heading\">Photos</div>
                                <div class=\"tiles-body-alt\">
                                    <i class=\"fa fa-camera\"></i>
                                    <div class=\"text-center\">57</div>
                                    <small>photos disponible</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div> <!--wrap -->
</div> <!-- page-content -->
";
    }

    public function getTemplateName()
    {
        return "ApplicationMainBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 5,  43 => 4,  37 => 3,  11 => 1,);
    }
}
