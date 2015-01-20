<?php

/* ApplicationCotisationBundle:Default:index.html.twig */
class __TwigTemplate_5e807b5aef6848bb8b6affd69885a2c89a5b67334ab25cef08d7ce913a3989b0 extends Twig_Template
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
        echo "Mes cotisations";
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "    <div id=\"page-content\">
      <div id='wrap'>
        <div id=\"page-heading\">
          <ol class=\"breadcrumb\">
            <li><a href=\"index.php\">Plateforme</a></li>
            <li class=\"active\">Cotisations</li>
          </ol>

          <h1>Mes cotisations</h1>
        </div>
        <div class=\"container\">
          <div class=\"row\">
            <div class=\"col-xs-12\">
              <div class=\"panel panel-primary\">
                <div class=\"panel-heading\">
                  <h4>Historique des cotisations</h4>
                  <div class=\"options\">

                  </div>
                </div>
                <div class=\"panel-body\">
                  <p class=\"text-right\"><a href=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("application_cotisation_new");
        echo "\" title=\"Nouvelle cotisation\"><button class=\"btn-primary btn\">Nouvelle cotisation</button></a></p>
                  ";
        // line 28
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "cotisations", array())) > 0)) {
            // line 29
            echo "                    <table class=\"table\">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Année</th>
                          <th>Type</th>
                          <th>Prix</th>
                          <th>Statut</th>
                          <th>Facture</th>
                        </tr>
                      </thead>
                      <tbody>
                        ";
            // line 41
            $context["cotisationNumbers"] = 1;
            // line 42
            echo "                          ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "cotisations", array())));
            foreach ($context['_seq'] as $context["_key"] => $context["cotisation"]) {
                // line 43
                echo "                            
                            <tr>
                              <td>";
                // line 45
                echo twig_escape_filter($this->env, (isset($context["cotisationNumbers"]) ? $context["cotisationNumbers"] : $this->getContext($context, "cotisationNumbers")), "html", null, true);
                echo "</td>
                              <td>";
                // line 46
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["cotisation"], "year", array()), "Y"), "html", null, true);
                echo "</td>
                              <td>";
                // line 47
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["cotisation"], "typeCotisation", array()), "name", array()), "html", null, true);
                echo "</td>
                              <td>";
                // line 48
                echo twig_escape_filter($this->env, $this->getAttribute($context["cotisation"], "priceCotisation", array()), "html", null, true);
                echo " €</td>
                              <td>";
                // line 49
                if ($this->getAttribute($this->getAttribute($context["cotisation"], "invoice", array()), "payed", array())) {
                    echo "<button class=\"btn btn-success\">Payé</button>";
                } else {
                    echo "<button class=\"btn btn-danger\">Impayé</button>";
                }
                echo "</td>
                              <td><a href=\"";
                // line 50
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("application_cotisation_invoice_get", array("id" => $this->getAttribute($this->getAttribute($context["cotisation"], "invoice", array()), "id", array()))), "html", null, true);
                echo "\"><i class=\"fa fa-eye\"></i></a></td>
                            </tr>
                            ";
                // line 52
                $context["cotisationNumbers"] = ((isset($context["cotisationNumbers"]) ? $context["cotisationNumbers"] : $this->getContext($context, "cotisationNumbers")) + 1);
                // line 53
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cotisation'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 54
            echo "                          </tbody>
                        </table>
                        ";
        } else {
            // line 57
            echo "                        <p class=\"text-danger\"><strong>Aucune cotisation n'a été trouvé pour votre compte. N'hésitez pas à effectuer une demande de cotisation.</strong></p>
                      ";
        }
        // line 59
        echo "                      
                      
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
        return "ApplicationCotisationBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 59,  142 => 57,  137 => 54,  131 => 53,  129 => 52,  124 => 50,  116 => 49,  112 => 48,  108 => 47,  104 => 46,  100 => 45,  96 => 43,  91 => 42,  89 => 41,  75 => 29,  73 => 28,  69 => 27,  46 => 6,  43 => 5,  37 => 3,  11 => 1,);
    }
}
