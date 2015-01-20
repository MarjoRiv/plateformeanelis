<?php

/* ApplicationCotisationBundle:Default:invoice.html.twig */
class __TwigTemplate_f8410de02af7b56c216e19e1cc3a01fc29a36abca81ccb07e86dbd949f851b51 extends Twig_Template
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
        echo "Facture";
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "  <div id=\"page-content\">
    <div id='wrap'>
      <div id=\"page-heading\">
        <ol class=\"breadcrumb\">
          <li><a href=\"index.php\">Plateforme</a></li>
          <li><a href=\"";
        // line 11
        echo $this->env->getExtension('routing')->getPath("application_cotisation_homepage");
        echo "\" title=\"Cotisation\">Cotisations</a></li>
          <li class=\"active\">Facture n° ";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "id", array()), "html", null, true);
        echo "</li>
        </ol>
      </div>

      <div class=\"container\">



        <div class=\"row\">
          <div class=\"col-md-12\">
            <div class=\"panel panel-default\">
            <!-- <div class=\"panel-heading\">
              <h4>Invoice</h4>
            </div> -->
            <div class=\"panel-body\">
              <div class=\"clearfix\">
                <div class=\"pull-left\">
                  <h4>Facture n° <strong>";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "id", array()), "html", null, true);
        echo "</strong></h4>
                      ";
        // line 30
        if ($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "payed", array())) {
            // line 31
            echo "                      <span class=\"btn btn-success\">Payé</span>
                      ";
        } else {
            // line 33
            echo "                      <span class=\"btn btn-danger\">Impayé</span>
                      ";
        }
        // line 35
        echo "
                </div>
                <div class=\"pull-right\">
                  <h4 class=\"text-right\"><img src=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/img/anelis-logo.png"), "html", null, true);
        echo "\" alt=\"ANELIS\" style=\"width: 224px; height: 72px;\"></h4>
                  <strong>ANELIS</strong><br>
                      ISIMA, Campus des Cézeaux<br>
                      63170 Aubière<br>
                </div>
              </div>
              <div class=\"row\">
                <div class=\"col-md-12\">
                  <h3 style=\"background: #85c744; padding: 5px 10px; color: #fff; border-radius: 1px; margin: 20px 0 20px; text-align:center\">Facture</h3>
                  <div class=\"pull-left\">
                    <address>
                      <strong>";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "user", array()), "name", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "user", array()), "surname", array()), "html", null, true);
        echo "</strong><br>
                      ";
        // line 50
        echo nl2br(twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "user", array()), "address", array()), "html", null, true));
        echo "
                    </address>
                  </div>
                  <div class=\"pull-right\">
                    <ul class=\"text-right list-unstyled\">
                      <li><strong>Date:</strong> ";
        // line 55
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "date", array()), "d/m/Y"), "html", null, true);
        echo "</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class=\"row\">
                <div class=\"col-md-12\">
                  <div class=\"table-responsive\">
                    <table class=\"table table-bordered table-striped table-hover\">
                      <thead>
                        <th>#</th>
                        <th>Article</th>
                        <th>Description</th>
                        <th>Quantité</th>
                        <th>Coût unitaire</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Cotisation</td>
                          <td>Type : <strong>";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "nameCotisation", array()), "html", null, true);
        echo "</strong></td>
                          <td>1</td>
                          <td>";
        // line 78
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "priceCotisation", array()), "html", null, true);
        echo " &euro;</td>
                          <td>";
        // line 79
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "priceCotisation", array()), "html", null, true);
        echo " &euro;</td>
                        </tr>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class=\"row\">
                <div class=\"col-md-3 col-md-offset-9\">
                  <p class=\"text-right\">TVA: Non applicable</p>
                  <hr>
                  <h3 class=\"text-right\">";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "priceCotisation", array()), "html", null, true);
        echo " &euro;</h3>
                </div>
              </div>
              <div class=\"panel-footer hidden-print\">
                <div class=\"pull-right\">
                  <form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_top\">
                  <input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">
                  <input type=\"hidden\" name=\"hosted_button_id\" value=\"M2LFT36X5JHZC\">
                  <input type=\"hidden\" name=\"on0\" value=\"Cotisation\">
                  <input type=\"hidden\" name=\"os0\" value=\"";
        // line 100
        if (($this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "priceCotisation", array()) == 10)) {
            echo "Membre";
        } elseif (($this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "priceCotisation", array()) == 20)) {
            echo "Membre bienfaiteur 20";
        } elseif (($this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "priceCotisation", array()) == 25)) {
            echo "Membre bienfaiteur 25";
        } elseif (($this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "priceCotisation", array()) == 30)) {
            echo "Membre bienfaiteur 30";
        } elseif (($this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "priceCotisation", array()) == 40)) {
            echo "Membre bienfaiteur 40";
        } elseif (($this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : $this->getContext($context, "invoice")), "cotisation", array()), "priceCotisation", array()) == 50)) {
            echo "Membre bienfaiteur 50";
        } else {
            echo "Membre";
        }
        echo "\">
                  <input type=\"hidden\" name=\"currency_code\" value=\"EUR\">
                  <button class=\"btn-primary btn\">Payer</button>
                  </form>
                </div>



              </div>
            </div>
          </div>

        </div>

      </div>



      



    </div> <!-- container -->

  </div>

</div> <!--wrap -->
</div> <!-- page-content -->

";
    }

    public function getTemplateName()
    {
        return "ApplicationCotisationBundle:Default:invoice.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  184 => 100,  172 => 91,  157 => 79,  153 => 78,  148 => 76,  124 => 55,  116 => 50,  110 => 49,  96 => 38,  91 => 35,  87 => 33,  83 => 31,  81 => 30,  77 => 29,  57 => 12,  53 => 11,  46 => 6,  43 => 5,  37 => 3,  11 => 1,);
    }
}
