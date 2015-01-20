<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        if (0 === strpos($pathinfo, '/cotisation')) {
            // application_cotisation_homepage
            if ($pathinfo === '/cotisation') {
                return array (  '_controller' => 'Application\\CotisationBundle\\Controller\\CotisationController::indexAction',  '_route' => 'application_cotisation_homepage',);
            }

            // application_cotisation_new
            if ($pathinfo === '/cotisation/new') {
                return array (  '_controller' => 'Application\\CotisationBundle\\Controller\\CotisationController::addAction',  '_route' => 'application_cotisation_new',);
            }

            // application_cotisation_invoice_get
            if (0 === strpos($pathinfo, '/cotisation/invoice') && preg_match('#^/cotisation/invoice/(?P<id>\\d*)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'application_cotisation_invoice_get')), array (  '_controller' => 'Application\\CotisationBundle\\Controller\\InvoiceController::getAction',));
            }

        }

        // application_annuaire_homepage
        if ($pathinfo === '/annuaire') {
            return array (  '_controller' => 'Application\\AnnuaireBundle\\Controller\\UserController::statsAction',  '_route' => 'application_annuaire_homepage',);
        }

        // application_main_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'application_main_homepage');
            }

            return array (  '_controller' => 'Application\\MainBundle\\Controller\\DefaultController::indexAction',  '_route' => 'application_main_homepage',);
        }

        // application_main_help
        if ($pathinfo === '/aide') {
            return array (  '_controller' => 'Application\\MainBundle\\Controller\\DefaultController::aideAction',  '_route' => 'application_main_help',);
        }

        if (0 === strpos($pathinfo, '/profil')) {
            // user_show_profile
            if (preg_match('#^/profil/(?P<id>\\d*)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_show_profile')), array (  '_controller' => 'Admin\\UserBundle\\Controller\\ProfilController::showAction',));
            }

            // user_edit_profile
            if (preg_match('#^/profil/(?P<id>\\d*)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_edit_profile')), array (  '_controller' => 'Admin\\UserBundle\\Controller\\ProfilController::editAction',));
            }

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ($pathinfo === '/profile/edit') {
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
            }

        }

        if (0 === strpos($pathinfo, '/re')) {
            if (0 === strpos($pathinfo, '/register')) {
                // fos_user_registration_register
                if (rtrim($pathinfo, '/') === '/register') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
                }

                if (0 === strpos($pathinfo, '/register/c')) {
                    // fos_user_registration_check_email
                    if ($pathinfo === '/register/check-email') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_check_email;
                        }

                        return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                    }
                    not_fos_user_registration_check_email:

                    if (0 === strpos($pathinfo, '/register/confirm')) {
                        // fos_user_registration_confirm
                        if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirm;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',));
                        }
                        not_fos_user_registration_confirm:

                        // fos_user_registration_confirmed
                        if ($pathinfo === '/register/confirmed') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirmed;
                            }

                            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                        }
                        not_fos_user_registration_confirmed:

                    }

                }

            }

            if (0 === strpos($pathinfo, '/resetting')) {
                // fos_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_request;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
                }
                not_fos_user_resetting_request:

                // fos_user_resetting_send_email
                if ($pathinfo === '/resetting/send-email') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_resetting_send_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                }
                not_fos_user_resetting_send_email:

                // fos_user_resetting_check_email
                if ($pathinfo === '/resetting/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_check_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                }
                not_fos_user_resetting_check_email:

                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
                }
                not_fos_user_resetting_reset:

            }

        }

        // fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        if (0 === strpos($pathinfo, '/admin')) {
            // sonata_admin_redirect
            if (rtrim($pathinfo, '/') === '/admin') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_admin_redirect');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'sonata_admin_dashboard',  'permanent' => 'true',  '_route' => 'sonata_admin_redirect',);
            }

            // sonata_admin_dashboard
            if ($pathinfo === '/admin/dashboard') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => 'sonata_admin_dashboard',);
            }

            if (0 === strpos($pathinfo, '/admin/core')) {
                // sonata_admin_retrieve_form_element
                if ($pathinfo === '/admin/core/get-form-field-element') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',  '_route' => 'sonata_admin_retrieve_form_element',);
                }

                // sonata_admin_append_form_element
                if ($pathinfo === '/admin/core/append-form-field-element') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',  '_route' => 'sonata_admin_append_form_element',);
                }

                // sonata_admin_short_object_information
                if (0 === strpos($pathinfo, '/admin/core/get-short-object-description') && preg_match('#^/admin/core/get\\-short\\-object\\-description(?:\\.(?P<_format>html|json))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_admin_short_object_information')), array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',  '_format' => 'html',));
                }

                // sonata_admin_set_object_field_value
                if ($pathinfo === '/admin/core/set-object-field-value') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',  '_route' => 'sonata_admin_set_object_field_value',);
                }

            }

            // sonata_admin_search
            if ($pathinfo === '/admin/search') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::searchAction',  '_route' => 'sonata_admin_search',);
            }

            // sonata_admin_retrieve_autocomplete_items
            if ($pathinfo === '/admin/core/get-autocomplete-items') {
                return array (  '_controller' => 'sonata.admin.controller.admin:retrieveAutocompleteItemsAction',  '_route' => 'sonata_admin_retrieve_autocomplete_items',);
            }

            if (0 === strpos($pathinfo, '/admin/a')) {
                if (0 === strpos($pathinfo, '/admin/admin/user')) {
                    if (0 === strpos($pathinfo, '/admin/admin/user/user')) {
                        // admin_admin_user_user_list
                        if ($pathinfo === '/admin/admin/user/user/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.user',  '_sonata_name' => 'admin_admin_user_user_list',  '_route' => 'admin_admin_user_user_list',);
                        }

                        // admin_admin_user_user_create
                        if ($pathinfo === '/admin/admin/user/user/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.user',  '_sonata_name' => 'admin_admin_user_user_create',  '_route' => 'admin_admin_user_user_create',);
                        }

                        // admin_admin_user_user_batch
                        if ($pathinfo === '/admin/admin/user/user/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.user',  '_sonata_name' => 'admin_admin_user_user_batch',  '_route' => 'admin_admin_user_user_batch',);
                        }

                        // admin_admin_user_user_edit
                        if (preg_match('#^/admin/admin/user/user/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_admin_user_user_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.user',  '_sonata_name' => 'admin_admin_user_user_edit',));
                        }

                        // admin_admin_user_user_delete
                        if (preg_match('#^/admin/admin/user/user/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_admin_user_user_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.user',  '_sonata_name' => 'admin_admin_user_user_delete',));
                        }

                        // admin_admin_user_user_show
                        if (preg_match('#^/admin/admin/user/user/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_admin_user_user_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.user',  '_sonata_name' => 'admin_admin_user_user_show',));
                        }

                        // admin_admin_user_user_export
                        if ($pathinfo === '/admin/admin/user/user/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.user',  '_sonata_name' => 'admin_admin_user_user_export',  '_route' => 'admin_admin_user_user_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/admin/user/newsletters')) {
                        // admin_admin_user_newsletters_list
                        if ($pathinfo === '/admin/admin/user/newsletters/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.newsletters',  '_sonata_name' => 'admin_admin_user_newsletters_list',  '_route' => 'admin_admin_user_newsletters_list',);
                        }

                        // admin_admin_user_newsletters_create
                        if ($pathinfo === '/admin/admin/user/newsletters/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.newsletters',  '_sonata_name' => 'admin_admin_user_newsletters_create',  '_route' => 'admin_admin_user_newsletters_create',);
                        }

                        // admin_admin_user_newsletters_batch
                        if ($pathinfo === '/admin/admin/user/newsletters/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.newsletters',  '_sonata_name' => 'admin_admin_user_newsletters_batch',  '_route' => 'admin_admin_user_newsletters_batch',);
                        }

                        // admin_admin_user_newsletters_edit
                        if (preg_match('#^/admin/admin/user/newsletters/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_admin_user_newsletters_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.newsletters',  '_sonata_name' => 'admin_admin_user_newsletters_edit',));
                        }

                        // admin_admin_user_newsletters_delete
                        if (preg_match('#^/admin/admin/user/newsletters/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_admin_user_newsletters_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.newsletters',  '_sonata_name' => 'admin_admin_user_newsletters_delete',));
                        }

                        // admin_admin_user_newsletters_show
                        if (preg_match('#^/admin/admin/user/newsletters/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_admin_user_newsletters_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.newsletters',  '_sonata_name' => 'admin_admin_user_newsletters_show',));
                        }

                        // admin_admin_user_newsletters_export
                        if ($pathinfo === '/admin/admin/user/newsletters/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.newsletters',  '_sonata_name' => 'admin_admin_user_newsletters_export',  '_route' => 'admin_admin_user_newsletters_export',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/application/cotisation')) {
                    if (0 === strpos($pathinfo, '/admin/application/cotisation/typecotisation')) {
                        // admin_application_cotisation_typecotisation_list
                        if ($pathinfo === '/admin/application/cotisation/typecotisation/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.cotisationtype',  '_sonata_name' => 'admin_application_cotisation_typecotisation_list',  '_route' => 'admin_application_cotisation_typecotisation_list',);
                        }

                        // admin_application_cotisation_typecotisation_create
                        if ($pathinfo === '/admin/application/cotisation/typecotisation/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.cotisationtype',  '_sonata_name' => 'admin_application_cotisation_typecotisation_create',  '_route' => 'admin_application_cotisation_typecotisation_create',);
                        }

                        // admin_application_cotisation_typecotisation_batch
                        if ($pathinfo === '/admin/application/cotisation/typecotisation/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.cotisationtype',  '_sonata_name' => 'admin_application_cotisation_typecotisation_batch',  '_route' => 'admin_application_cotisation_typecotisation_batch',);
                        }

                        // admin_application_cotisation_typecotisation_edit
                        if (preg_match('#^/admin/application/cotisation/typecotisation/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_cotisation_typecotisation_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.cotisationtype',  '_sonata_name' => 'admin_application_cotisation_typecotisation_edit',));
                        }

                        // admin_application_cotisation_typecotisation_delete
                        if (preg_match('#^/admin/application/cotisation/typecotisation/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_cotisation_typecotisation_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.cotisationtype',  '_sonata_name' => 'admin_application_cotisation_typecotisation_delete',));
                        }

                        // admin_application_cotisation_typecotisation_show
                        if (preg_match('#^/admin/application/cotisation/typecotisation/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_cotisation_typecotisation_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.cotisationtype',  '_sonata_name' => 'admin_application_cotisation_typecotisation_show',));
                        }

                        // admin_application_cotisation_typecotisation_export
                        if ($pathinfo === '/admin/application/cotisation/typecotisation/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.cotisationtype',  '_sonata_name' => 'admin_application_cotisation_typecotisation_export',  '_route' => 'admin_application_cotisation_typecotisation_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/application/cotisation/cotisation')) {
                        // admin_application_cotisation_cotisation_list
                        if ($pathinfo === '/admin/application/cotisation/cotisation/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.cotisation',  '_sonata_name' => 'admin_application_cotisation_cotisation_list',  '_route' => 'admin_application_cotisation_cotisation_list',);
                        }

                        // admin_application_cotisation_cotisation_create
                        if ($pathinfo === '/admin/application/cotisation/cotisation/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.cotisation',  '_sonata_name' => 'admin_application_cotisation_cotisation_create',  '_route' => 'admin_application_cotisation_cotisation_create',);
                        }

                        // admin_application_cotisation_cotisation_batch
                        if ($pathinfo === '/admin/application/cotisation/cotisation/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.cotisation',  '_sonata_name' => 'admin_application_cotisation_cotisation_batch',  '_route' => 'admin_application_cotisation_cotisation_batch',);
                        }

                        // admin_application_cotisation_cotisation_edit
                        if (preg_match('#^/admin/application/cotisation/cotisation/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_cotisation_cotisation_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.cotisation',  '_sonata_name' => 'admin_application_cotisation_cotisation_edit',));
                        }

                        // admin_application_cotisation_cotisation_delete
                        if (preg_match('#^/admin/application/cotisation/cotisation/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_cotisation_cotisation_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.cotisation',  '_sonata_name' => 'admin_application_cotisation_cotisation_delete',));
                        }

                        // admin_application_cotisation_cotisation_show
                        if (preg_match('#^/admin/application/cotisation/cotisation/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_cotisation_cotisation_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.cotisation',  '_sonata_name' => 'admin_application_cotisation_cotisation_show',));
                        }

                        // admin_application_cotisation_cotisation_export
                        if ($pathinfo === '/admin/application/cotisation/cotisation/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.cotisation',  '_sonata_name' => 'admin_application_cotisation_cotisation_export',  '_route' => 'admin_application_cotisation_cotisation_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/application/cotisation/invoice')) {
                        // admin_application_cotisation_invoice_list
                        if ($pathinfo === '/admin/application/cotisation/invoice/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.invoice',  '_sonata_name' => 'admin_application_cotisation_invoice_list',  '_route' => 'admin_application_cotisation_invoice_list',);
                        }

                        // admin_application_cotisation_invoice_create
                        if ($pathinfo === '/admin/application/cotisation/invoice/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.invoice',  '_sonata_name' => 'admin_application_cotisation_invoice_create',  '_route' => 'admin_application_cotisation_invoice_create',);
                        }

                        // admin_application_cotisation_invoice_batch
                        if ($pathinfo === '/admin/application/cotisation/invoice/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.invoice',  '_sonata_name' => 'admin_application_cotisation_invoice_batch',  '_route' => 'admin_application_cotisation_invoice_batch',);
                        }

                        // admin_application_cotisation_invoice_edit
                        if (preg_match('#^/admin/application/cotisation/invoice/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_cotisation_invoice_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.invoice',  '_sonata_name' => 'admin_application_cotisation_invoice_edit',));
                        }

                        // admin_application_cotisation_invoice_delete
                        if (preg_match('#^/admin/application/cotisation/invoice/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_cotisation_invoice_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.invoice',  '_sonata_name' => 'admin_application_cotisation_invoice_delete',));
                        }

                        // admin_application_cotisation_invoice_show
                        if (preg_match('#^/admin/application/cotisation/invoice/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_cotisation_invoice_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.invoice',  '_sonata_name' => 'admin_application_cotisation_invoice_show',));
                        }

                        // admin_application_cotisation_invoice_export
                        if ($pathinfo === '/admin/application/cotisation/invoice/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.invoice',  '_sonata_name' => 'admin_application_cotisation_invoice_export',  '_route' => 'admin_application_cotisation_invoice_export',);
                        }

                    }

                }

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
