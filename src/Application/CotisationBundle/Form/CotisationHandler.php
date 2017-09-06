<?php

namespace Application\CotisationBundle\Form;

use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Entity\Invoice;
use Application\CotisationBundle\Manager\CotisationManager;
use Application\CotisationBundle\Manager\InvoiceManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CotisationHandler
 * @package Application\CotisationBundle\Form
 */
class CotisationHandler
{
    private $form;
    private $request;
    private $manager;
    private $invoiceManager;

    public function __construct(Form $form, Request $request, $manager)
    {
        $this->form = $form;
        $this->request = $request;
        $this->manager = $manager;
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
        if($cotisation->getCotisationLibre() != null)
        {
            $cotisation->setPricecotisation($cotisation->getCotisationLibre());
        }
        $this->manager->persist($cotisation);
        $this->manager->flush();
    }
}