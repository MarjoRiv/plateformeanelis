<?php

namespace Application\ChatBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Application\ChatBundle\Manager\MessageManager;
use Application\ChatBundle\Entity\Message;


class MessageHandler
{
    private $form;
    private $request;
    private $manager;

    public function __construct(Form $form, Request $request, MessageManager $manager)
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

    public function onSuccess(Message $message) {
        $message->setDate(new \DateTime('now'));
        $message->setEnabled(true);
        $this->manager->persist($message);
        $this->manager->flush();
    }
}