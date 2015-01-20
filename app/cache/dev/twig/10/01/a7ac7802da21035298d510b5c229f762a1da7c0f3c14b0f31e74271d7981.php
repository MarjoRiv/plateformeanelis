<?php

/* AdminUserBundle:Form:user.html.twig */
class __TwigTemplate_1001a7ac7802da21035298d510b5c229f762a1da7c0f3c14b0f31e74271d7981 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'admin_userbundle_user_widget' => array($this, 'block_admin_userbundle_user_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('admin_userbundle_user_widget', $context, $blocks);
    }

    public function block_admin_userbundle_user_widget($context, array $blocks = array())
    {
        // line 2
        echo "
    <form class=\"form-horizontal\" method=\"post\" ";
        // line 3
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo ">
        <div class=\"panel-body\">
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"domtabs\">
              <div class=\"row\">
                <div class=\"tab-container tab-left tab-danger\">
                  <ul class=\"nav nav-tabs\">
                    <li class=\"active\"><a href=\"#profil\" data-toggle=\"tab\">Profil</a></li>
                    <li><a href=\"#social\" data-toggle=\"tab\">Social</a></li>
                    <li><a href=\"#perso\" data-toggle=\"tab\">Perso</a></li>
                    <li><a href=\"#newsletters\" data-toggle=\"tab\">Newsletters</a></li>
                </ul>
                <div class=\"tab-content\">
                    <div class=\"tab-pane active\" id=\"profil\">

                        ";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
                        <div class=\"form-group";
        // line 19
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 20
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Login*"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 25
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                        <div class=\"form-group";
        // line 28
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 29
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Email*"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 31
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 34
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                        <div class=\"form-group";
        // line 37
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 38
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Nom*"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 40
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3\">
                                <p class=\"help-block\">";
        // line 43
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                        <div class=\"form-group";
        // line 46
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "maritalName", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 47
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "maritalName", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Nom Marital"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 49
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "maritalName", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3\">
                                <p class=\"help-block\">";
        // line 52
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "maritalName", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                        <div class=\"form-group";
        // line 55
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "surname", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 56
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "surname", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Prénom*"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 58
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "surname", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 61
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "surname", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                        <div class=\"form-group";
        // line 64
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "promotion", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 65
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "promotion", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Promotion"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 67
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "promotion", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 70
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "promotion", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                        <div class=\"form-group";
        // line 73
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "filiere", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 74
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "filiere", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Filière"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 76
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "filiere", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 79
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "filiere", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>

                        <div class=\"form-group";
        // line 83
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "address", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 84
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "address", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Adresse"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 86
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "address", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 89
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "address", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>

                        <div class=\"form-group";
        // line 93
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "postalcode", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 94
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "postalcode", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Code postal"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 96
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "postalcode", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 99
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "postalcode", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>

                        <div class=\"form-group";
        // line 103
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "city", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 104
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "city", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Ville"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 106
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "city", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 109
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "city", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>

                        <div class=\"form-group";
        // line 113
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "country", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 114
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "country", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Pays"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 116
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "country", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 119
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "country", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>

                        <div class=\"form-group";
        // line 123
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "telephone", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 124
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "telephone", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Téléphone"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 126
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "telephone", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 129
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "telephone", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                        <div class=\"form-group";
        // line 132
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "website", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 133
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "website", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Site Web"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 135
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "website", array()), 'widget', array("attr" => array("class" => "form-control", "placeholder" => "http://")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 138
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "website", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                        <div class=\"form-group";
        // line 141
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "biography", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 142
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "biography", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Biographie"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 144
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "biography", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 147
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "biography", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>

                        <div class=\"form-group";
        // line 151
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "avatar", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 152
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "avatar", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Avatar"));
        echo "
                            <div class=\"col-sm-6\">
                                <span class=\"btn btn-default btn-file\">
                                    <span class=\"fileinput-new\">Choisir le fichier</span>
                                    ";
        // line 156
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "avatar", array()), "input", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                                </span>

                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 161
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "avatar", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>



                    </div>
                    <div class=\"tab-pane\" id=\"social\">

                        <div id=\"social-fields-list\">
                            <div class=\"form-group";
        // line 171
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialFacebook", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                                ";
        // line 172
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialFacebook", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Facebook"));
        echo "
                                <div class=\"col-sm-6\">
                                    ";
        // line 174
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialFacebook", array()), 'widget', array("attr" => array("class" => "form-control", "placeholder" => "http://")));
        echo "
                                </div>
                                <div class=\"col-md-3 has-error\">
                                    <p class=\"help-block\">";
        // line 177
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialFacebook", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                                </div>
                            </div>
                            <div class=\"form-group";
        // line 180
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialTwitter", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                                ";
        // line 181
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialTwitter", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Twitter"));
        echo "
                                <div class=\"col-sm-6\">
                                    ";
        // line 183
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialTwitter", array()), 'widget', array("attr" => array("class" => "form-control", "placeholder" => "http://")));
        echo "
                                </div>
                                <div class=\"col-md-3 has-error\">
                                    <p class=\"help-block\">";
        // line 186
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialTwitter", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                                </div>
                            </div>
                            <div class=\"form-group";
        // line 189
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialLinkedin", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                                ";
        // line 190
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialLinkedin", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Linkedin"));
        echo "
                                <div class=\"col-sm-6\">
                                    ";
        // line 192
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialLinkedin", array()), 'widget', array("attr" => array("class" => "form-control", "placeholder" => "http://")));
        echo "
                                </div>
                                <div class=\"col-md-3 has-error\">
                                    <p class=\"help-block\">";
        // line 195
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "socialLinkedin", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class=\"tab-pane\" id=\"perso\">
                        <div class=\"form-group";
        // line 202
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "maritalStatus", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 203
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "maritalStatus", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Statut Marital"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 205
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "maritalStatus", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 208
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "maritalStatus", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                        <div class=\"form-group";
        // line 211
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "childrenNumber", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 212
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "childrenNumber", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Nombre d'enfant(s)"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 214
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "childrenNumber", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 217
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "childrenNumber", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>

                        <div class=\"form-group";
        // line 221
        if ( !twig_test_empty($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "birthday", array()), 'errors'))) {
            echo " has-error";
        }
        echo "\">
                            ";
        // line 222
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "birthday", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Date de naissance"));
        echo "
                            <div class=\"col-sm-6\">
                                ";
        // line 224
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "birthday", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <div class=\"col-md-3 has-error\">
                                <p class=\"help-block\">";
        // line 227
        echo twig_escape_filter($this->env, strtr($this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "birthday", array()), 'errors'), array("<li>" => "", "</li>" => "", "<ul>" => "", "</ul>" => "")), "html", null, true);
        echo "</p>
                            </div>
                        </div>
                    </div>
                    <div class=\"tab-pane\" id=\"newsletters\">
                        <div class=\"form-group\">
                            ";
        // line 233
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "newsletters", array()), 'label', array("label_attr" => array("class" => "col-sm-3 control-label"), "label" => "Abonnements"));
        echo "
                            <div class=\"col-sm-9\">
                                <div class=\"col-sm-6\">
                                    <ul class=\"list-unstyled\">
                                        ";
        // line 237
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "newsletters", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["newsletter"]) {
            // line 238
            echo "                                            <li>";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["newsletter"], 'widget');
            echo " ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["newsletter"], 'label');
            echo "</li>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['newsletter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 240
        echo "                                    </ul>
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
        // line 253
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo " 
<p class=\"text-right\"><button class=\"btn-primary btn\">Enregistrer</button></p>

</div>
</form>
<script src=\"";
        // line 258
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/moment.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 259
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/pikaday.js"), "html", null, true);
        echo "\"></script>
<script>

    var picker = new Pikaday({
        field: document.getElementById('admin_userbundle_user_birthday'),
        format: 'YYYY-MM-DD',
        yearRange: [1970,2015],
        onSelect: function() {
            console.log(this.getMoment().format('YYYY-MM-DD'));
        }
    });

</script>
";
    }

    public function getTemplateName()
    {
        return "AdminUserBundle:Form:user.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  608 => 259,  604 => 258,  596 => 253,  581 => 240,  570 => 238,  566 => 237,  559 => 233,  550 => 227,  544 => 224,  539 => 222,  533 => 221,  526 => 217,  520 => 214,  515 => 212,  509 => 211,  503 => 208,  497 => 205,  492 => 203,  486 => 202,  476 => 195,  470 => 192,  465 => 190,  459 => 189,  453 => 186,  447 => 183,  442 => 181,  436 => 180,  430 => 177,  424 => 174,  419 => 172,  413 => 171,  400 => 161,  392 => 156,  385 => 152,  379 => 151,  372 => 147,  366 => 144,  361 => 142,  355 => 141,  349 => 138,  343 => 135,  338 => 133,  332 => 132,  326 => 129,  320 => 126,  315 => 124,  309 => 123,  302 => 119,  296 => 116,  291 => 114,  285 => 113,  278 => 109,  272 => 106,  267 => 104,  261 => 103,  254 => 99,  248 => 96,  243 => 94,  237 => 93,  230 => 89,  224 => 86,  219 => 84,  213 => 83,  206 => 79,  200 => 76,  195 => 74,  189 => 73,  183 => 70,  177 => 67,  172 => 65,  166 => 64,  160 => 61,  154 => 58,  149 => 56,  143 => 55,  137 => 52,  131 => 49,  126 => 47,  120 => 46,  114 => 43,  108 => 40,  103 => 38,  97 => 37,  91 => 34,  85 => 31,  80 => 29,  74 => 28,  68 => 25,  62 => 22,  57 => 20,  51 => 19,  47 => 18,  29 => 3,  26 => 2,  20 => 1,);
    }
}
