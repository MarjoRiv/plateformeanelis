<?php

namespace Admin\ParcoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminParcoursBundle:Default:index.html.twig');
    }
}
