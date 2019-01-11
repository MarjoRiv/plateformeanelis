<?php
/**
 * Created by PhpStorm.
 * User: Marjorie
 * Date: 04/01/2019
 * Time: 12:00
 */

namespace Application\YearbookBundle\Controller;


use Admin\UserBundle\Entity\User;
use Application\YearbookBundle\Business\BusinessManager;
use Application\YearbookBundle\Entity\YearbookMessages;
use Application\YearbookBundle\Form\YearbookMessagesHandler;
use Application\YearbookBundle\Form\YearbookMessagesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request, User $userTo=null)
    {
        $doctrine = $this->getDoctrine();
        $business= new BusinessManager();
        $userFrom =$this->get('security.token_storage')->getToken()->getUser()->getId();
        $messagesTo = $business->listMessagesReceived($doctrine,$userFrom);
        $messagesFrom = $business->listMessagesSend($doctrine,$userFrom);
        $listUsersNotSend=$business->listUsersNotSend($doctrine,$userFrom);
        $listUsersSend=$business->listUsersSend($doctrine,$userFrom);
        $yearbookmessages=null;

        if(isset($userTo))
        {
            $yearbookmessages = $business->getMessage($doctrine,$userTo,$userFrom);
        }
        $form = $this->createForm(YearbookMessagesType::class, $yearbookmessages);

        return $this->render('ApplicationYearbookBundle:Default:list.html.twig', array(
                'messagesTo' => $messagesTo,
                'messagesFrom' => $messagesFrom,
                'listUsersNotSend' => $listUsersNotSend,
                'listUsersSend' => $listUsersSend,
                'form' => $form->createView(),
                'user' => $userTo,
            )
        );
    }

    /**
     * show the list of messages received
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listToAction()
    {
        $doctrine = $this->getDoctrine();
        $business= new BusinessManager();
        $user =$this->get('security.token_storage')->getToken()->getUser()->getId();
        $messages = $business->listMessagesReceived($doctrine,$user);
        return $this->render('ApplicationYearbookBundle:Default:listTo.html.twig', array(
                'messagesTo' => $messages
            )
        );
    }

    /**
     * show the list messages send
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listFromAction()
    {
        $doctrine = $this->getDoctrine();
        $business= new BusinessManager();
        $user =$this->get('security.token_storage')->getToken()->getUser()->getId();
        $messages = $business->listMessagesSend($doctrine,$user);
        return $this->render('ApplicationYearbookBundle:Default:listFrom.html.twig', array(
                'messagesFrom' => $messages
            )
        );
    }


    /**
     * show shortcut yearbook in menu
     * @param null $userId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function yearbookMenuAction($userId=NULL)
    {
        $doctrine = $this->getDoctrine();
        $business= new BusinessManager();
        $messages = $business->listMessagesReceived($doctrine,$userId);
        $number = count($messages);
        // Retourne le nombre de messages à valider pour l'utilisateur userId
        return $this->render('ApplicationYearbookBundle:Default:menu.html.twig', array(
                'number' => $number
            )
        );
    }

    /**
     * create message
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function newAction(Request $request, User $user) {

        // Sécurité : on ne s'écrit pas à soi même
        if ($user->getId() == $this->get('security.token_storage')->getToken()->getUser()->getId() || $user->getPromotion() != date('Y')) {
           return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
        }



         $em = $this->getDoctrine()->getManager();
        $business= new BusinessManager();
        $yearbookmessages = $business->newMessage($user);
        $form = $this->createForm(YearbookMessagesType::class, $yearbookmessages);
        $formHandler = new YearbookMessagesHandler($form, $request, $em);

        if ($formHandler->process()) {

            // TODO:Si un message vient d'être envoyé, on envoie un email à celui qui l'a reçu (essayer de les envoyer pour les mails de la journée)

            return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
        }

        return $this->render('ApplicationYearbookBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
           'name' => $user->getName(),
            'surname' => $user->getSurname()
        ));
    }

    /**
     * update message
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, User $user) {

        $doctrine = $this->getDoctrine();
        $business= new BusinessManager();
        $sender= $this->get('security.token_storage')->getToken()->getUser();
        $yearbookmessages = $business->getMessage($doctrine,$user,$sender);
        $form = $this->createForm(YearbookMessagesType::class, $yearbookmessages);

        return $this->render('ApplicationYearbookBundle:Default:list.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,

        ));
    }

    /**
     * delete message
     * @param YearbookMessages $yearbookmessage
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(YearbookMessages $yearbookmessage) {
        if ($yearbookmessage->getUserTo() != $this->get('security.token_storage')->getToken()->getUser()) {
            return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
        }
        $business= new BusinessManager();
        $doctrine = $this->getDoctrine();
        $business->deleteMessage($doctrine,$yearbookmessage);

        return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
    }
}