<?php

namespace Admin\SocialBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Admin\SocialBundle\Entity\Social;
use Admin\SocialBundle\Manager\SocialManager;


class SocialHandler
{
    private $form;
    private $request;
    private $manager;

    public function __construct(Form $form, Request $request, SocialManager $manager)
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

    public function onSuccess(Social $social) {
        $this->manager->persist($social);
        $this->manager->flush();
    }
}