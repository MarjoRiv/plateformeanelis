<?php

/* ::application.html.twig */
class __TwigTemplate_2522c27a7826440c1e7ca6f774b51fe0abae488490559215de47418615f69bc8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("::base.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'content' => array($this, 'block_content'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    <link href='";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/demo/variations/default.css"), "html", null, true);
        echo "' rel='stylesheet' type='text/css' media='all' id='styleswitcher'> 
    
            <link href='";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/demo/variations/default.css"), "html", null, true);
        echo "' rel='stylesheet' type='text/css' media='all' id='headerswitcher'> 
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
        <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/ie8.css"), "html", null, true);
        echo "\">
        <script type=\"text/javascript\" src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>
        <script type=\"text/javascript\" src=\"http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/plugins/charts-flot/excanvas.min.js"), "html", null, true);
        echo "\"></script>
    <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->

<link rel='stylesheet' type='text/css' href='";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/plugins/codeprettifier/prettify.css"), "html", null, true);
        echo "' /> 
<link rel='stylesheet' type='text/css' href='";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/plugins/form-toggle/toggles.css"), "html", null, true);
        echo "' /> 
<link rel='stylesheet' type='text/css' href='";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/fonts/glyphicons/css/glyphicons.min.css"), "html", null, true);
        echo "' /> 
<link rel=\"stylesheet\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/pikaday.css"), "html", null, true);
        echo "\">
";
    }

    // line 26
    public function block_content($context, array $blocks = array())
    {
        // line 27
        echo "



    <header class=\"navbar navbar-inverse navbar-fixed-top\" role=\"banner\">
        <a id=\"leftmenu-trigger\" class=\"tooltips\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Agrandir/Réduire le menu\"></a>

        <div class=\"navbar-header pull-left\">
            <a class=\"navbar-brand\" href=\"index.php\">ANELIS</a>
        </div>

        <ul class=\"nav navbar-nav pull-right toolbar\">
            <li class=\"dropdown\">
                <a href=\"#\" class=\"dropdown-toggle username\" data-toggle=\"dropdown\"><span class=\"hidden-xs\">";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "surname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "name", array()), "html", null, true);
        echo "<i class=\"fa fa-caret-down\"></i></span>
                ";
        // line 41
        if (twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "avatar", array()), "extension", array()))) {
            // line 42
            echo "                                <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "avatar", array()), "defaultWebPath", array())), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array()), "html", null, true);
            echo "\" />
                            ";
        } else {
            // line 44
            echo "                                <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "avatar", array()), "webPath", array())), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array()), "html", null, true);
            echo "\" />
                            ";
        }
        // line 46
        echo "                </a>
                <ul class=\"dropdown-menu userinfo arrow\">
                    <li class=\"username\">
                        <a href=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("user_show_profile", array("id" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "id", array()))), "html", null, true);
        echo "\">
                            <div class=\"pull-left\">
                            ";
        // line 51
        if (twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "avatar", array()), "extension", array()))) {
            // line 52
            echo "                                <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "avatar", array()), "defaultWebPath", array())), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array()), "html", null, true);
            echo "\" />
                            ";
        } else {
            // line 54
            echo "                                <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "avatar", array()), "webPath", array())), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array()), "html", null, true);
            echo "\" />
                            ";
        }
        // line 56
        echo "                            </div>
                            <div class=\"pull-right\"><h5>Salut ";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "surname", array()), "html", null, true);
        echo " !</h5></div>
                        </a>
                    </li>
                    <li class=\"userlinks\">
                        <ul class=\"dropdown-menu\">
                            <li><a href=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("user_show_profile", array("id" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "id", array()))), "html", null, true);
        echo "\">Voir mon Profil<i class=\"pull-right fa fa-eye\"></i></a></li>
                            <li><a href=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("user_edit_profile", array("id" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "id", array()))), "html", null, true);
        echo "\">Mon Compte <i class=\"pull-right fa fa-pencil\"></i></a></li>
                            <li><a href=\"";
        // line 64
        echo $this->env->getExtension('routing')->getPath("application_cotisation_homepage");
        echo "\">Mes Cotisations <i class=\"pull-right fa fa-thumbs-o-up\"></i></a></li>
                            <li><a href=\"";
        // line 65
        echo $this->env->getExtension('routing')->getPath("application_main_help");
        echo "\">Aide <i class=\"pull-right fa fa-question-circle\"></i></a></li>
                            <li class=\"divider\"></li>
                            <li><a href=\"";
        // line 67
        echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
        echo "\" class=\"text-right\">Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </header>

    <div id=\"page-container\">
        <!-- BEGIN SIDEBAR -->
        <nav id=\"page-leftbar\" role=\"navigation\">
                <!-- BEGIN SIDEBAR MENU -->
            <ul class=\"acc-menu\" id=\"sidebar\">
                <li id=\"search\">
                    <a href=\"javascript:;\"><i class=\"fa fa-search opacity-control\"></i></a>
                     <form>
                        <input type=\"text\" class=\"search-query\" placeholder=\"Rechercher ...\">
                        <button type=\"submit\"><i class=\"fa fa-search\"></i></button>
                    </form>
                </li>
                <li class=\"divider\"></li>
                <li><a href=\"";
        // line 88
        echo $this->env->getExtension('routing')->getPath("application_main_homepage");
        echo "\"><i class=\"fa fa-home\"></i> <span>Accueil</span></a></li>
                <li><a href=\"";
        // line 89
        echo $this->env->getExtension('routing')->getPath("application_annuaire_homepage");
        echo "\"><i class=\"glyphicon glyphicon-search\"></i> <span>Annuaire</span></a></li>
                <li><a href=\"#\"><i class=\"glyphicon glyphicon-list\"></i> <span>Offres d'emplois / stages</span></a></li>
                <li><a href=\"messagerie.php\"><i class=\"glyphicon glyphicon-envelope\"></i> <span>Messagerie</span></a></li>
                <li class=\"divider\"></li>
                <li><a href=\"maps-vector.php\"><i class=\"fa fa-map-marker\"></i> <span>Carte des ZZs</span></a></li>
                <li><a href=\"gallery.php\"><i class=\"fa fa-camera\"></i> <span> Galerie Photo</span> </a></li>
                ";
        // line 95
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 96
            echo "                <li class=\"divider\"></li>
                <li><a href=\"javascript:;\"><i class=\"fa fa-briefcase\"></i> <span>Administration</span></a>
                    <ul class=\"acc-menu\">
                        <li><a href=\"#\">Parcours</a></li>
                    </ul>
                </li>
                ";
        }
        // line 103
        echo "
            </ul>
            <!-- END SIDEBAR MENU -->
        </nav>

";
        // line 108
        $this->displayBlock('body', $context, $blocks);
        // line 109
        echo "
<footer role=\"contentinfo\">
        <div class=\"clearfix\">
            <ul class=\"list-unstyled list-inline pull-left\">
                <li>ANELIS &copy; 2015</li>
            </ul>
            <button class=\"pull-right btn btn-inverse-alt btn-xs hidden-print\" id=\"back-to-top\"><i class=\"fa fa-arrow-up\"></i></button>
        </div>
    </footer>

</div> <!-- page-container -->

";
    }

    // line 108
    public function block_body($context, array $blocks = array())
    {
        echo " ";
    }

    // line 123
    public function block_javascripts($context, array $blocks = array())
    {
        // line 124
        echo "<script type='text/javascript' src='";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery-1.10.2.min.js"), "html", null, true);
        echo "'></script> 
<script type='text/javascript' src='";
        // line 125
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jqueryui-1.10.3.min.js"), "html", null, true);
        echo "'></script> 
<script type='text/javascript' src='";
        // line 126
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/bootstrap.min.js"), "html", null, true);
        echo "'></script> 
<script type='text/javascript' src='";
        // line 127
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/enquire.js"), "html", null, true);
        echo "'></script> 
<script type='text/javascript' src='";
        // line 128
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery.cookie.js"), "html", null, true);
        echo "'></script> 
<script type='text/javascript' src='";
        // line 129
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery.nicescroll.min.js"), "html", null, true);
        echo "'></script> 
<script type='text/javascript' src='";
        // line 130
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/application.js"), "html", null, true);
        echo "'></script> 
";
    }

    public function getTemplateName()
    {
        return "::application.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  297 => 130,  293 => 129,  289 => 128,  285 => 127,  281 => 126,  277 => 125,  272 => 124,  269 => 123,  263 => 108,  247 => 109,  245 => 108,  238 => 103,  229 => 96,  227 => 95,  218 => 89,  214 => 88,  190 => 67,  185 => 65,  181 => 64,  177 => 63,  173 => 62,  165 => 57,  162 => 56,  154 => 54,  146 => 52,  144 => 51,  139 => 49,  134 => 46,  126 => 44,  118 => 42,  116 => 41,  110 => 40,  95 => 27,  92 => 26,  86 => 23,  82 => 22,  78 => 21,  74 => 20,  66 => 15,  60 => 12,  53 => 8,  48 => 6,  42 => 4,  39 => 3,  11 => 1,);
    }
}
