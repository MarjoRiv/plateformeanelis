<?php

namespace Admin\UserBundle\Form;

use Admin\UserBundle\Entity\User;
use Admin\UserBundle\Manager\UserManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;


class UserHandler
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

    public function onSuccess(User $user) {
        
        $this->manager->persist($user);
        $this->manager->flush();
    }
}