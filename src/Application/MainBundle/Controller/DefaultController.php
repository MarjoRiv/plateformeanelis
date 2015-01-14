<?php

namespace Application\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationMainBundle:Default:index.html.twig');
    }

    public function aideAction()
    {
        return $this->render('ApplicationMainBundle:Default:aide.html.twig');
    }
}
