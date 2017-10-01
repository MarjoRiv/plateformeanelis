<?php

namespace Application\ChatBundle\Controller;

use Application\ChatBundle\Entity\Message;
use Application\ChatBundle\Form\MessageHandler;
use Application\ChatBundle\Form\MessageType;
use Application\ChatBundle\Manager\MessageManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $message = new Message();
        $message->setUser($this->getUser());
        $form = $this->createForm(MessageType::class, $message);
        $em = $this->getDoctrine()->getManager();

        $handler = new MessageHandler($form, $request, $em);
        if ($handler->process())
        {
            // Le mec a bien posté son commentaire
        }

        $messages = $this->getDoctrine()->getRepository('ApplicationChatBundle:Message')->findAll();

        return $this->render('ApplicationChatBundle:Default:index.html.twig', array(
                'form' => $this->createForm(MessageType::class, new Message())->createView(),
                'messages' => $messages
        ));
    }

}
