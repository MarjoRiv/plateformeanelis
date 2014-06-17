<?php

namespace Application\AnnuaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationAnnuaireBundle:Default:index.html.twig');
    }
}
