<?php

/* FOSUserBundle:Security:login.html.twig */
class __TwigTemplate_5319d0300b7d69d3339873fef7bc3a21fcb28b3a3f07e9d8b3c94b544a840ec3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("FOSUserBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'optbody' => array($this, 'block_optbody'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "FOSUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "Identification
";
    }

    // line 8
    public function block_optbody($context, array $blocks = array())
    {
        // line 9
        echo " class=\"focusedform\"
";
    }

    // line 12
    public function block_content($context, array $blocks = array())
    {
        // line 13
        echo "
<div class=\"verticalcenter\">
    <a href=\"index.php\"><img src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/img/anelis-logo.png"), "html", null, true);
        echo "\" alt=\"Logo\" class=\"brand\" /></a>
    <div class=\"panel panel-primary\">
    <form class=\"form-horizontal\" action=\"";
        // line 17
        echo $this->env->getExtension('routing')->getPath("fos_user_security_check");
        echo "\" method=\"post\">
        <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\" />

        <div class=\"panel-body\">
            <h4 class=\"text-center\" style=\"margin-bottom: 25px;\">S'identifier ou <a href=\"";
        // line 21
        echo $this->env->getExtension('routing')->getPath("fos_user_registration_register");
        echo "\">S'inscrire</a></h4>
            ";
        // line 22
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 23
            echo "                <div class=\"alert alert-danger\">Erreur login et/ou password</div>
            ";
        }
        // line 25
        echo "                        <div class=\"form-group\">
                            <div class=\"col-sm-12\">
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"><i class=\"fa fa-user\"></i></span>
                                    <input type=\"text\" class=\"form-control\" id=\"username\" name=\"_username\" placeholder=\"Nom d'utilisateur\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" required=\"required\">
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-sm-12\">
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"><i class=\"fa fa-lock\"></i></span>
                                    <input class=\"form-control\" placeholder=\"Mot de passe\" type=\"password\" id=\"password\" name=\"_password\" required=\"required\" />

                                </div>
                            </div>
                        </div>
                        <div class=\"clearfix\">
                            <div class=\"pull-right\"><label><input type=\"checkbox\" style=\"margin-bottom: 20px\" id=\"remember_me\" name=\"_remember_me\" value=\"on\"> Se souvenir de moi</label></div>

                        </div>
                    
        </div>
        <div class=\"panel-footer\">
            <a href=\"extras-forgotpassword.php\" class=\"pull-left btn btn-link\" style=\"padding-left:0\">Mot de passe oublié?</a>
            
            <div class=\"pull-right\">
                <input class=\"btn-default btn\" type=\"submit\" id=\"_submit\" name=\"_submit\" value=\"Se connecter\" />
                <a class=\"btn btn-default\" href=\"";
        // line 53
        echo $this->env->getExtension('routing')->getPath("fos_user_resetting_request");
        echo "\">Annuler</a>

            </div>
        </div>
        </form>
    </div>
 </div>
";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 53,  92 => 29,  86 => 25,  82 => 23,  80 => 22,  76 => 21,  70 => 18,  66 => 17,  61 => 15,  57 => 13,  54 => 12,  49 => 9,  46 => 8,  41 => 5,  38 => 4,  11 => 1,);
    }
}
