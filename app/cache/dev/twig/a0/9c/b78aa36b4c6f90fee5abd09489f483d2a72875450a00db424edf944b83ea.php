<?php

/* ApplicationMainBundle:Default:aide.html.twig */
class __TwigTemplate_a09cb78aa36b4c6f90fee5abd09489f483d2a72875450a00db424edf944b83ea extends Twig_Template
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
        echo "Aide";
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "        <div id=\"page-content\">
            <div id='wrap'>
                <div id=\"page-heading\" class=\"hidden-print\">
                    <ol class=\"breadcrumb\">
                        <li><a href=\"";
        // line 9
        echo $this->env->getExtension('routing')->getPath("application_main_homepage");
        echo "\">Plateforme</a></li>
                        <li class=\"active\">Aide</li>
                    </ol>

                    <h1>Aide</h1>
                </div>

                <div class=\"container\">

                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <div class=\"panel panel-danger\">
                              <div class=\"panel-heading\">
                                <h4>Cotisation</h4>
                                <div class=\"options\">
                                    <a href=\"#\"><i class=\"fa fa-cogs\"></i></a>
                                </div>
                            </div>
                            <div class=\"panel-body\">
                                <div id=\"accordioninpanel\" class=\"accordion-group\">
                                    <div class=\"accordion-item\">
                                        <a class=\"accordion-title\" data-toggle=\"collapse\" data-parent=\"#accordioninpanel\" href=\"#cotisation1\"><h4>J'ai réglé une facture de cotisation sur Paypal mais elle est marquée comme \"Impayé\"</h4></a>
                                        <div id=\"cotisation1\" class=\"collapse\">
                                            <div class=\"accordion-body\">Il faut attendre que le trésorier la valide.</div>
                                        </div>
                                    </div>
                                    <div class=\"accordion-item\">
                                        <a class=\"accordion-title\" data-toggle=\"collapse\" data-parent=\"#accordioninpanel\" href=\"#cotisation2\"><h4>Comment faire un don à ANELIS ?</h4></a>
                                        <div id=\"cotisation2\" class=\"collapse\">
                                            <div class=\"accordion-body \">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
                                        </div>
                                    </div>
                                    <div class=\"accordion-item\">
                                        <a class=\"accordion-title\" data-toggle=\"collapse\" data-parent=\"#accordioninpanel\" href=\"#cotisation3\"><h4>Combien de temps la cotisation est-elle valable ?</h4></a>
                                        <div id=\"cotisation3\" class=\"collapse\">
                                            <div class=\"accordion-body\">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
                                        </div>
                                    </div>
                                </div>
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
        return "ApplicationMainBundle:Default:aide.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 9,  46 => 5,  43 => 4,  37 => 3,  11 => 1,);
    }
}
