<?php

/* ApplicationAnnuaireBundle:Default:index.html.twig */
class __TwigTemplate_5818b3f67a6ac7ecbcd6072a06769ba4198a2467fd0d5df9f86a548b0e59bb71 extends Twig_Template
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
        echo "Annuaire";
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "    <div id=\"page-content\">
        <div id='wrap'>
            <div id=\"page-heading\">
                <ol class=\"breadcrumb\">
                    <li><a href=\"";
        // line 9
        echo $this->env->getExtension('routing')->getPath("application_main_homepage");
        echo "\">Plateforme</a></li>
                    <li class=\"active\">Annuaire</li>
                </ol>

                <h1>Annuaire</h1>
            </div>
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <h4>
                                <ul class=\"nav nav-tabs\">
                                    <li class=\"active\"><a href=\"#rechercheZZ\" data-toggle=\"tab\">Rechercher un ZZ</a></li>
                                    <li><a href=\"#rechercheEntreprise\" data-toggle=\"tab\">Rechercher une entreprise</a></li>

                                </ul>
                            </h4>
                            <div class=\"options\">
                                <a href=\"#\"><i class=\"fa fa-cogs\"></i></a>
                            </div>
                        </div>

                        <div class=\"panel-body\">
                            <div class=\"tab-content\">
                                <div class=\"tab-pane active\" id=\"rechercheZZ\">
                                    <form class=\"form-horizontal\" method=\"get\" ";
        // line 34
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo ">
                                    <div class=\"col-xs-6\">
                                        
                                            ";
        // line 37
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
                                            <div class=\"form-group\">
                                            ";
        // line 39
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "promotion", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Promotion"));
        echo "
                                                <div class=\"col-sm-6\">
                                                ";
        // line 41
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "promotion", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "

                                                </div>
                                            </div>
                                            <div class=\"form-group\">
                                            ";
        // line 46
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "filiere", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Filière"));
        echo "
                                                <div class=\"col-sm-6\">
                                                ";
        // line 48
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "filiere", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "

                                                </div>
                                            </div>
                                    </div>
                                    <div class=\"col-xs-6\"><form class=\"form-horizontal\">
                                        <div class=\"form-group\">
                                            ";
        // line 55
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Nom"));
        echo "
                                            <div class=\"col-sm-6\">
                                                ";
        // line 57
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                                            </div>
                                        </div>
                                        <div class=\"form-group\">
                                            ";
        // line 61
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "surname", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Prénom"));
        echo "
                                            <div class=\"col-sm-6\">
                                                ";
        // line 63
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "surname", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                                            </div>
                                        </div>
                                    </div>


                                    <div style=\"text-align: center;\">
                                        <div class=\"btn-toolbar\">
                                            <button class=\"btn-primary btn\">Rechercher</button>
                                            <button class=\"btn-default btn\">Annuler</button>
                                        </div>
                                    </div>
                                    
                                    ";
        // line 76
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo " 
                            </div>





                            
                            <div class=\"tab-pane\" id=\"rechercheEntreprise\">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, porro eveniet debitis quas sed harum nobis libero voluptatibus dolorum odio at veniam aut id corrupti hic esse quisquam fugiat.

                            </div>
                            
                        </div>



                    </div>
                </div>
                ";
        // line 95
        if ( !twig_test_empty((isset($context["results"]) ? $context["results"] : $this->getContext($context, "results")))) {
            // line 96
            echo "                    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["results"]) ? $context["results"] : $this->getContext($context, "results")));
            foreach ($context['_seq'] as $context["_key"] => $context["result"]) {
                // line 97
                echo "                <div class=\"col-sm-4\">
                <div class=\"panel panel-sky\">
                    <div class=\"panel-heading\" style=\"text-align: center;\">
                        <h4>";
                // line 100
                echo twig_escape_filter($this->env, $this->getAttribute($context["result"], "name", array()), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["result"], "surname", array()), "html", null, true);
                echo "</h4>
                    </div>
                    <div class=\"panel-body\">
                        <div class=\"media\">
                            
                            <a class=\"pull-left\" href=\"";
                // line 105
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("user_show_profile", array("id" => $this->getAttribute($context["result"], "id", array()))), "html", null, true);
                echo "\">
                                ";
                // line 106
                if ( !twig_test_empty($this->getAttribute($context["result"], "avatar", array()))) {
                    // line 107
                    echo "                                <img class=\"media-object dp img-circle\" src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute($context["result"], "avatar", array()), "webPath", array())), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["result"], "username", array()), "html", null, true);
                    echo "\" style=\"width: 100px;height:100px;\" />
                                ";
                } else {
                    // line 109
                    echo "                                <img class=\"media-object dp img-circle\" src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "avatar", array()), "defaultWebPath", array())), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["result"], "username", array()), "html", null, true);
                    echo "\" style=\"width: 100px;height:100px;\" />
                                ";
                }
                // line 111
                echo "                            </a>
                            <div class=\"media-body\">
                                <h5>Travaille chez <a href=\"#\">Entreprise</a></h5>
                                <hr style=\"margin:8px auto\">
                                <span class=\"label label-default\">";
                // line 115
                echo twig_escape_filter($this->env, $this->getAttribute($context["result"], "filiere", array()), "html", null, true);
                echo "</span>
                                <span class=\"label label-default\">";
                // line 116
                echo twig_escape_filter($this->env, $this->getAttribute($context["result"], "promotion", array()), "html", null, true);
                echo "</span>
                                <hr style=\"margin:8px auto\">
                                ";
                // line 118
                if ($this->getAttribute($context["result"], "isCotisant", array())) {
                    // line 119
                    echo "                                    <span class=\"badge badge-primary\">Cotisant</span>
                                ";
                } else {
                    // line 121
                    echo "                                ";
                }
                // line 122
                echo "                            </div>
                        </div>
                    </div>

                </div>
            </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['result'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 129
            echo "                ";
        }
        // line 130
        echo "                    
                
            </div>
        </div>

    </div> <!--wrap -->
</div> <!-- page-content -->

";
    }

    public function getTemplateName()
    {
        return "ApplicationAnnuaireBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  257 => 130,  254 => 129,  242 => 122,  239 => 121,  235 => 119,  233 => 118,  228 => 116,  224 => 115,  218 => 111,  210 => 109,  202 => 107,  200 => 106,  196 => 105,  186 => 100,  181 => 97,  176 => 96,  174 => 95,  152 => 76,  136 => 63,  131 => 61,  124 => 57,  119 => 55,  109 => 48,  104 => 46,  96 => 41,  91 => 39,  86 => 37,  80 => 34,  52 => 9,  46 => 5,  43 => 4,  37 => 3,  11 => 1,);
    }
}
