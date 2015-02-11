<?php

namespace Application\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository('AdminUserBundle:User')->findAll();
        return $this->render('ApplicationMainBundle:Default:index.html.twig', array(
            'users' => count($users)));
    }

    public function aideAction()
    {   
        return $this->render('ApplicationMainBundle:Default:aide.html.twig');
    }
}
