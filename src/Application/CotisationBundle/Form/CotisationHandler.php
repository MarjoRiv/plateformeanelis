<?php

namespace Application\CotisationBundle\Form;

use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Entity\Invoice;
use Application\CotisationBundle\Manager\CotisationManager;
use Application\CotisationBundle\Manager\InvoiceManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class CotisationHandler
{
    private $form;
    private $request;
    private $manager;
    private $invoiceManager;

    public function __construct(Form $form, Request $request, CotisationManager $manager, InvoiceManager $invoiceManager)
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
            $this->form->submit($this->request);
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