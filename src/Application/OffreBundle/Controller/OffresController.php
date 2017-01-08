<?php

namespace Application\OffreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OffresController extends Controller
{
    public function indexAction()
    {
        return $this->render('OffreBundle:Default:index.html.twig');
    }
}