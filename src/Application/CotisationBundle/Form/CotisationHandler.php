<?php

namespace Application\CotisationBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Manager\CotisationManager;
use Application\CotisationBundle\Manager\InvoiceManager;
use Application\CotisationBundle\Entity\Invoice;

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
            $this->form->bind($this->request);

            if( $this->form->isValid() )
            {
                $this->onSuccess($this->form->getData());

                return true;
            }
        }

        return false;
    }

    public function onSuccess(Cotisation $cotisation) {
        $invoice = new Invoice();
        $invoice->setCotisation($cotisation);
        $invoice->setPayed(false);
        $invoice->setDate(new \DateTime('now'));

        // Implementation of an "hybrid system"
        $cotisation->setNameCotisation($cotisation->getTypeCotisation()->getName());
        $cotisation->setPriceCotisation($cotisation->getTypeCotisation()->getPrice());
        $cotisation->setInvoice($invoice);

        $this->invoiceManager->persist($invoice);
        $this->manager->persist($cotisation);
        
        $this->manager->flush();
    }
}