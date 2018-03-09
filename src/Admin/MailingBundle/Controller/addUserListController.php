<?php

namespace Admin\MailingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminMailingBundle:Default:index.html.twig');
    }
}
