<?php

namespace Admin\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController {
    public function loginAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $isMaintain = $em->getRepository('AdminUserBundle:Parameters')->findOneByName('anelis.accueil.isMaintenance');
        if (strcmp($isMaintain->getValue(), '1') == 0) {
            return $this->render('maintenance.html.twig',array());
        } else {
            return parent::loginAction($request);
        }
    }
}