<?php

namespace Application\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\ChatBundle\Entity\Message;
use Application\ChatBundle\Form\MessageType;
use Application\ChatBundle\Form\MessageHandler;
use Application\ChatBundle\Manager\MessageManager;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $message = new Message();
        $message->setUser($this->getUser());
        $form = $this->createForm(new MessageType(), $message);
        $em = new MessageManager($this);

        $handler = new MessageHandler($form, $this->get('request'), $em);
        if ($handler->process())
        {
            // Le mec a bien posté son commentaire
            //return $this->indexAction();            
        }

        $messages = $this->getDoctrine()->getRepository('ApplicationChatBundle:Message')->findAll();

        return $this->render('ApplicationChatBundle:Default:index.html.twig', array(
                'form' => $form->createView(),
                'messages' => $messages
        ));
    }

}
