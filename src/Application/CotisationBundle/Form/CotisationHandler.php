<?php

namespace Application\CotisationBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Manager\CotisationManager;


class CotisationHandler
{
    private $form;
    private $request;
    private $manager;

    public function __construct(Form $form, Request $request, CotisationManager $manager)
    {
        $this->form = $form;
        $this->request = $request;
        $this->manager = $manager;
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
        $cotisation->setNameCotisation($cotisation->getTypeCotisation()->getName());
        $cotisation->setPriceCotisation($cotisation->getTypeCotisation()->getPrice());
        $this->manager->persist($cotisation);
        $this->manager->flush();
    }
}