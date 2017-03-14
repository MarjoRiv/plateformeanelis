<?php

namespace Application\OffreBundle\Form;

use Application\OffreBundle\Entity\Offers;
use Application\OffreBundle\Entity\UserOffre;
use Application\OffreBundle\Manager\OffersManager;
use Application\OffreBundle\Manager\UserOffreManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
//
class OffersHandler
{
    private $form;
    private $request;
    private $manager;
    private $invoiceManager;

    public function __construct(Form $form, Request $request, $manager, InvoiceManager $invoiceManager)
    {
        $this->form = $form;
        $this->request = $request;
        $this->manager = $manager;
        $this->invoiceManager = $invoiceManager;
    }

    public function process()
    {
        if( $this->request->getMethod() == 'POST' )
        {
            $this->form->handleRequest($this->request);
            if( $this->form->isValid() )
            {
                $this->onSuccess($this->form->getData());
                return true;
            }
        }

        return false;
    }

    public function onSuccess(Cotisation $cotisation) {
        $date = new \DateTime();
        $date->setDate($cotisation->getYear(), 1, 1);
        $cotisation->setYear($date);
        
        $this->manager->persist($cotisation);
        $this->manager->flush();
    }
}