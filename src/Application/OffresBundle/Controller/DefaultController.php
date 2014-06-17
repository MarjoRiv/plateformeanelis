<?php

namespace Application\OffresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationOffresBundle:Default:index.html.twig');
    }
}
