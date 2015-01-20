<?php

/* AdminUserBundle:Profile:show.html.twig */
class __TwigTemplate_b90636e0aa1c525ecb971bbced00b6ed145b78c559464ef2e105ba3973b35645 extends Twig_Template
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
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "surname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "name", array()), "html", null, true);
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "        <div id=\"page-content\">
            <div id='wrap'>
                <div id=\"page-heading\">
                    <ol class=\"breadcrumb\">
                        <li><a href=\"";
        // line 9
        echo $this->env->getExtension('routing')->getPath("application_main_homepage");
        echo "\">Plateforme</a></li>
                        <li>Profil</li>
                        <li class=\"active\">";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "surname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "name", array()), "html", null, true);
        echo "</li>
                    </ol>

                    <h1>Profil</h1>
                </div>
                <div class=\"container\">

                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <div class=\"panel panel-midnightblue\">
                                <div class=\"panel-body\">

                                    <div class=\"row\">
                                        <div class=\"col-md-6\">
                                            ";
        // line 25
        if (twig_test_empty($this->getAttribute($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "avatar", array()), "extension", array()))) {
            // line 26
            echo "                                                <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "avatar", array()), "defaultWebPath", array())), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "html", null, true);
            echo "\" class=\"pull-left\" style=\"margin: 0 20px 20px 0; width: 100px; height: 100px;\"/>
                                                ";
        } else {
            // line 28
            echo "                                                <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "avatar", array()), "webPath", array())), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "html", null, true);
            echo "\" class=\"pull-left\" style=\"margin: 0 20px 20px 0; width: 100px; height: 100px;\"/>
                                            ";
        }
        // line 30
        echo "                                            <div class=\"table-responsive\">
                                                <table class=\"table table-condensed\">
                                                    <h3><strong>";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "surname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "name", array()), "html", null, true);
        echo " </strong></h3>
                                            <!-- <thead>
                                                <tr>
                                                    <th width=\"50%\"></th>
                                                    <th width=\"50%\"></th>
                                                </tr>
                                            </thead> -->
                                            <tbody>
                                                <tr>
                                                    <td>Web</td>
                                                    <td><a href=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "website", array()), "html", null, true);
        echo "\" target=\"_blank\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "website", array()), "html", null, true);
        echo "</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    ";
        // line 46
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "isCotisant", array()) || ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "id", array()) == $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "id", array())))) {
            // line 47
            echo "                                                    <td><a href=\"mailto:";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "email", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "email", array()), "html", null, true);
            echo "</a></td>
                                                    ";
        } else {
            // line 49
            echo "                                                    <td><a data-toggle=\"modal\" href=\"#cotisationNeeded\">Inaccessible</a></td>
                                                    ";
        }
        // line 51
        echo "                                                </tr>
                                                <tr>
                                                    <td>Téléphone</td>
                                                    <td>";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "telephone", array()), "html", null, true);
        echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>Métier</td>
                                                    <td>Développeur</td>
                                                </tr>
                                                <tr>
                                                    <td>Entreprise</td>
                                                    <td>Michelin</td>
                                                </tr>
                                                ";
        // line 64
        if ((( !twig_test_empty($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "socialFacebook", array())) ||  !twig_test_empty($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "socialTwitter", array()))) ||  !twig_test_empty($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "socialLinkedin", array())))) {
            // line 65
            echo "                                                    <tr>
                                                        <td>Social</td>
                                                        <td>
                                                            ";
            // line 68
            if ( !twig_test_empty($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "socialFacebook", array()))) {
                // line 69
                echo "                                                                ";
                if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "isCotisant", array()) || ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "id", array()) == $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "id", array())))) {
                    // line 70
                    echo "                                                                    <a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "socialFacebook", array()), "html", null, true);
                    echo "\" class=\"btn btn-xs\" target=\"_blank\"><i class=\"fa fa-facebook\"></i></a>
                                                                    ";
                } else {
                    // line 72
                    echo "                                                                    <a data-toggle=\"modal\" href=\"#cotisationNeeded\" class=\"btn btn-xs\" target=\"_blank\"><i class=\"fa fa-facebook\"></i></a>
                                                                ";
                }
                // line 74
                echo "                                                            ";
            }
            // line 75
            echo "                                                            ";
            if ( !twig_test_empty($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "socialTwitter", array()))) {
                // line 76
                echo "                                                                ";
                if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "isCotisant", array()) || ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "id", array()) == $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "id", array())))) {
                    // line 77
                    echo "                                                                    <a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "socialTwitter", array()), "html", null, true);
                    echo "\" class=\"btn btn-xs\" target=\"_blank\"><i class=\"fa fa-twitter\"></i></a>
                                                                    ";
                } else {
                    // line 79
                    echo "                                                                    <a data-toggle=\"modal\" href=\"#cotisationNeeded\" class=\"btn btn-xs\" target=\"_blank\"><i class=\"fa fa-twitter\"></i></a>
                                                                ";
                }
                // line 81
                echo "                                                            ";
            }
            // line 82
            echo "                                                            ";
            if ( !twig_test_empty($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "socialLinkedin", array()))) {
                // line 83
                echo "                                                                ";
                if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "isCotisant", array()) || ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "id", array()) == $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "id", array())))) {
                    // line 84
                    echo "                                                                    <a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "socialLinkedin", array()), "html", null, true);
                    echo "\" class=\"btn btn-xs\" target=\"_blank\"><i class=\"fa fa-linkedin\"></i></a>
                                                                    ";
                } else {
                    // line 86
                    echo "                                                                    <a data-toggle=\"modal\" href=\"#cotisationNeeded\" class=\"btn btn-xs\" target=\"_blank\"><i class=\"fa fa-linkedin\"></i></a>
                                                                ";
                }
                // line 88
                echo "                                                            ";
            }
            // line 89
            echo "                                                        </td>
                                                    </tr>
                                                ";
        }
        // line 92
        echo "                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class=\"col-md-6\">
                                    <h3>À propos</h3>
                                    <p>

                                        ";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "biography", array()), "html", null, true);
        echo "
                                        
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class=\"row\">
                                <div class=\"col-md-12\">
                                    <div class=\"tab-container tab-success\">
                                        <ul class=\"nav nav-tabs\">
                                            <li class=\"active\"><a href=\"#home1\" data-toggle=\"tab\">Parcours Professionnel</a></li>
                                            <li class=\"\"><a href=\"#profile2\" data-toggle=\"tab\">Parcours Scolaire</a></li>
                                            <li class=\"\"><a href=\"#profile1\" data-toggle=\"tab\">Parcours Associatif</a></li>
                                        </ul>
                                        <div class=\"tab-content\">
                                            <div class=\"tab-pane active clearfix\" id=\"home1\">
                                                <div class=\"col-md-12\">
                                                    <h4 class=\"timeline-month\"><span>Novembre</span> <span>2013</span></h4>
                                                    <ul class=\"timeline\">
                                                        <li class=\"timeline-orange\">
                                                            <div class=\"timeline-icon\"><i class=\"fa fa-group\"></i></div>
                                                            <div class=\"timeline-body\">
                                                                <div class=\"timeline-header\">
                                                                    <span class=\"date\">Lundi 21 Novembre 2013</span>
                                                                </div>
                                                                <div class=\"timeline-content\">
                                                                    <h3>Entreprise</h3>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, officiis, molestiae, deserunt asperiores architecto ut vel repudiandae dolore inventore nesciunt necessitatibus doloribus ratione facere consectetur suscipit!</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class=\"col-md-12\">
                                                    <h4 class=\"timeline-month\"><span>Decembre</span> <span>2013</span></h4>
                                                    <ul class=\"timeline\">
                                                        <li class=\"timeline-success\">
                                                            <div class=\"timeline-icon\"><i class=\"fa fa-group\"></i></div>
                                                            <div class=\"timeline-body\">
                                                                <div class=\"timeline-header\">
                                                                    <span class=\"date\">Lundi 21 Decembre 2013</span>
                                                                </div>
                                                                <div class=\"timeline-content\">
                                                                    <h3>Entreprise</h3>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, officiis, molestiae, deserunt asperiores architecto ut vel repudiandae dolore inventore nesciunt necessitatibus doloribus ratione facere consectetur suscipit!</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class=\"tab-pane active clearfix\" id=\"profile2\">
                                                <div class=\"col-md-12\">
                                                    <h4 class=\"timeline-month\"><span>Novembre</span> <span>2013</span></h4>
                                                    <ul class=\"timeline\">
                                                        <li class=\"timeline-orange\">
                                                            <div class=\"timeline-icon\"><i class=\"fa fa-group\"></i></div>
                                                            <div class=\"timeline-body\">
                                                                <div class=\"timeline-header\">
                                                                    <span class=\"date\">Lundi 21 Novembre 2013</span>
                                                                </div>
                                                                <div class=\"timeline-content\">
                                                                    <h3>Ecole</h3>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, officiis, molestiae, deserunt asperiores architecto ut vel repudiandae dolore inventore nesciunt necessitatibus doloribus ratione facere consectetur suscipit!</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class=\"col-md-12\">
                                                    <h4 class=\"timeline-month\"><span>Decembre</span> <span>2013</span></h4>
                                                    <ul class=\"timeline\">
                                                        <li class=\"timeline-success\">
                                                            <div class=\"timeline-icon\"><i class=\"fa fa-group\"></i></div>
                                                            <div class=\"timeline-body\">
                                                                <div class=\"timeline-header\">
                                                                    <span class=\"date\">Lundi 21 Decembre 2013</span>
                                                                </div>
                                                                <div class=\"timeline-content\">
                                                                    <h3>Ecole</h3>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, officiis, molestiae, deserunt asperiores architecto ut vel repudiandae dolore inventore nesciunt necessitatibus doloribus ratione facere consectetur suscipit!</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class=\"tab-pane\" id=\"profile1\">
                                                <div class=\"tab-pane active clearfix\" id=\"home1\">
                                                    <div class=\"col-md-12\">
                                                        <h4 class=\"timeline-month\"><span>Novembre</span> <span>2013</span></h4>
                                                        <ul class=\"timeline\">
                                                            <li class=\"timeline-orange\">
                                                                <div class=\"timeline-icon\"><i class=\"fa fa-group\"></i></div>
                                                                <div class=\"timeline-body\">
                                                                    <div class=\"timeline-header\">
                                                                        <span class=\"date\">Lundi 21 Novembre 2013</span>
                                                                    </div>
                                                                    <div class=\"timeline-content\">
                                                                        <h3>Association</h3>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, officiis, molestiae, deserunt asperiores architecto ut vel repudiandae dolore inventore nesciunt necessitatibus doloribus ratione facere consectetur suscipit!</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class=\"col-md-12\">
                                                        <h4 class=\"timeline-month\"><span>Decembre</span> <span>2013</span></h4>
                                                        <ul class=\"timeline\">
                                                            <li class=\"timeline-success\">
                                                                <div class=\"timeline-icon\"><i class=\"fa fa-group\"></i></div>
                                                                <div class=\"timeline-body\">
                                                                    <div class=\"timeline-header\">
                                                                        <span class=\"date\">Lundi 21 Decembre 2013</span>
                                                                    </div>
                                                                    <div class=\"timeline-content\">
                                                                        <h3>Club</h3>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, officiis, molestiae, deserunt asperiores architecto ut vel repudiandae dolore inventore nesciunt necessitatibus doloribus ratione facere consectetur suscipit!</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div> 
";
        // line 244
        if ( !$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "isCotisant", array())) {
            // line 245
            echo "    <div class=\"modal fade\" id=\"cotisationNeeded\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
        <div class=\"modal-dialog\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title\">Cotisation requise</h4>
                </div>
                <div class=\"modal-body\">
                    <h4>Information</h4>
                    <p>Il est nécessaire de <strong><a href=\"";
            // line 254
            echo $this->env->getExtension('routing')->getPath("application_cotisation_homepage");
            echo "\" title=\"Cotisation\">cotiser</a></strong> pour accéder à cette information.</p>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Fermer</button>
                </div>
            </div>
        </div>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "AdminUserBundle:Profile:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  398 => 254,  387 => 245,  385 => 244,  238 => 100,  228 => 92,  223 => 89,  220 => 88,  216 => 86,  210 => 84,  207 => 83,  204 => 82,  201 => 81,  197 => 79,  191 => 77,  188 => 76,  185 => 75,  182 => 74,  178 => 72,  172 => 70,  169 => 69,  167 => 68,  162 => 65,  160 => 64,  147 => 54,  142 => 51,  138 => 49,  130 => 47,  128 => 46,  119 => 42,  104 => 32,  100 => 30,  90 => 28,  80 => 26,  78 => 25,  59 => 11,  54 => 9,  48 => 5,  45 => 4,  37 => 3,  11 => 1,);
    }
}
