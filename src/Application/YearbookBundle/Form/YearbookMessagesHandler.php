<?php

namespace Application\YearbookBundle\Form;

use Application\YearbookBundle\Entity\YearbookMessages;
use Application\YearbookBundle\Manager\YearbookMessagesManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;


class YearbookMessagesHandler
{
    private $form;
    private $request;
    private $manager;

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

    public function onSuccess(YearbookMessages $message) {
        $this->manager->persist($message);
        $this->manager->flush();
    }
}