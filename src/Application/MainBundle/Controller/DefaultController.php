<?php

namespace Application\MainBundle\Controller;

use Admin\UserBundle\Entity\StaticText;
use Sonata\AdminBundle\SonataAdminBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository('AdminUserBundle:User')->findAll();

        //Searching the static textes on the page... Maybe use the name instead of the Id that can change on the DB.
        $welcomeText = $this->getDoctrine()->getRepository('AdminUserBundle:StaticText')->find(1);
        $agendaText = $this->getDoctrine()->getRepository('AdminUserBundle:StaticText')->find(2);

        return $this->render('ApplicationMainBundle:Default:index.html.twig', array(
            'users' => count($users),
            'welcomeText' => $welcomeText->getStaticText(),
            'agendaText' => $agendaText->getStaticText()
        ));
    }

    public function aideAction()
    {   
        return $this->render('ApplicationMainBundle:Default:aide.html.twig');
    }
}
