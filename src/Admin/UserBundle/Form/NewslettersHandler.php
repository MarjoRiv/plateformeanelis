<?php

namespace Admin\UserBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Admin\UserBundle\Manager\NewslettersManager;
use Admin\UserBundle\Entity\Newsletters;


class NewslettersHandler
{
    private $form;
    private $request;
    private $manager;

    public function __construct(Form $form, Request $request, NewslettersManager $manager)
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

    public function onSuccess(Newsletters $newsletters) {
        $this->manager->persist($newsletters);
        $this->manager->flush();
    }
}