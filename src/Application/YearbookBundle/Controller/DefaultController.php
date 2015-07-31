<?php

namespace Application\YearbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Admin\UserBundle\Entity\User;
use Application\YearbookBundle\Entity\Yearbook;
use Application\YearbookBundle\Entity\YearbookMessages;
use Application\YearbookBundle\Form\YearbookMessagesType;
use Application\YearbookBundle\Form\YearbookMessagesHandler;
use Application\YearbookBundle\Manager\YearbookMessagesManager;

class DefaultController extends Controller
{

    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository('ApplicationYearbookBundle:YearbookMessages');

        $messages = $repository->findBy(
            array('userTo' => $this->get('security.context')->getToken()->getUser()->getId()),
            array('id' => 'DESC')
            );

        return $this->render('ApplicationYearbookBundle:Default:list.html.twig', array(
            'messages' => $messages
            )
        );
    }

    public function addAction(User $user) {

        // Sécurité : on ne s'écrit pas à soi même
        if ($user->getId() == $this->get('security.context')->getToken()->getUser()->getId()) {
            return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
        }

        $manager = new YearbookMessagesManager($this);
        $yearbookmessages = new YearbookMessages();
        $yearbookmessages->setUserFrom($this->get('security.context')->getToken()->getUser());
        $yearbookmessages->setUserTo($user);

        $yearbookmessages->setYearbook($this->getDoctrine()->getRepository('ApplicationYearbookBundle:Yearbook')->findBy(array(
            'promotion' => date('Y'),
            'activated' => TRUE
            )
        )[0]);
        
        $form = $this->createForm(new YearbookMessagesType(), $yearbookmessages);
        $formHandler = new YearbookMessagesHandler($form, $this->get('request'), $manager);
        
        if ($formHandler->process()) {

            // Si un message vient d'être envoyé, on envoie un email à celui qui l'a reçu
            $mailer = $this->get('mailer');
            $message = $mailer->createMessage()
            ->setSubject('ANELIS - Yearbook - Vous avez un nouveau message')
            ->setFrom('mailing@anelis.org')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'Emails/yearbook_newmessage.html.twig',
                    array(
                        'from_surname' => $this->get('security.context')->getToken()->getUser()->getSurname(),
                        'from_name' => $this->get('security.context')->getToken()->getUser()->getName(),
                        'to_surname' => $user->getSurname(),
                        'to_name' => $user->getName()
                        )
                    ),
                'text/html'
                )
            ;
            $mailer->send($message);

            // On redirige le mec qui vient de laisser un message sur ses messages
            return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
        }

        return $this->render('ApplicationYearbookBundle:Default:add.html.twig', array(
            "form" => $form->createView(),
            "name" => $user->getName(),
            "surname" => $user->getSurname()
            ));
    }

    public function yearbookMenuAction($userId=NULL)
    {
        $messages = $this->getDoctrine()->getRepository('ApplicationYearbookBundle:YearbookMessages')->findBy(
            array('userTo' => $userId)
            );
        $number = count($messages);
        // Retourne le nombre de messages à valider pour l'utilisateur userId
        return $this->render('ApplicationYearbookBundle:Default:menu.html.twig', array(
            'number' => $number
            )
        );
    }

    public function deleteAction(YearbookMessages $yearbookmessage) {
        if ($yearbookmessage->getUserTo() != $this->get('security.context')->getToken()->getUser()) {
            return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
        }
        $manager = new YearbookMessagesManager($this);
        $manager->remove($yearbookmessage);
        $manager->flush();
        
        return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
    }
}
