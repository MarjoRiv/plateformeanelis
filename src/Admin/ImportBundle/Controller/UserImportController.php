<?php

namespace Admin\ImportBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class UserImportController extends CRUDController
{
    public function listAction()
    {
        return $this->render('AdminImportBundle:Default:index.html.twig');
    }
}
