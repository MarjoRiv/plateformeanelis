<?php

namespace Application\SocialBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Application\SocialBundle\Entity\UserSocial;
use Application\SocialBundle\Manager\UserSocialManager;
use Admin\UserBundle\Entity\User;

class UserSocialHandler
{
    private $form;
    private $request;
    private $manager;

    public function __construct(Form $form, Request $request, UserSocialManager $manager)
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

    public function onSuccess(User $social) {
        $this->manager->persist($social);
        $this->manager->flush();
    }
}