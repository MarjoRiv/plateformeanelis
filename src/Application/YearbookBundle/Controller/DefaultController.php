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
    public function listAction()
    {
        $doctrine = $this->getDoctrine();
        $business= new BusinessManager();
        $user =$this->get('security.token_storage')->getToken()->getUser()->getId();
        $messagesTo = $business->listMessagesTo($doctrine,$user);
        $messagesFrom = $business->listMessagesFrom($doctrine,$user);
        return $this->render('ApplicationYearbookBundle:Default:list.html.twig', array(
                'messagesTo' => $messagesTo,
                'messagesFrom' => $messagesFrom
            )
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listToAction()
    {
        $doctrine = $this->getDoctrine();
        $business= new BusinessManager();
        $user =$this->get('security.token_storage')->getToken()->getUser()->getId();
        $messages = $business->listMessagesTo($doctrine,$user);
        return $this->render('ApplicationYearbookBundle:Default:listTo.html.twig', array(
                'messagesTo' => $messages
            )
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listFromAction()
    {
        $doctrine = $this->getDoctrine();
        $business= new BusinessManager();
        $user =$this->get('security.token_storage')->getToken()->getUser()->getId();
        $messages = $business->listMessagesFrom($doctrine,$user);
        return $this->render('ApplicationYearbookBundle:Default:listFrom.html.twig', array(
                'messagesFrom' => $messages
            )
        );
    }


    /**
     * @param null $userId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function yearbookMenuAction($userId=NULL)
    {
        $doctrine = $this->getDoctrine();
        $business= new BusinessManager();
        $messages = $business->messagesUser($doctrine,$userId);
        $number = count($messages);
        // Retourne le nombre de messages à valider pour l'utilisateur userId
        return $this->render('ApplicationYearbookBundle:Default:menu.html.twig', array(
                'number' => $number
            )
        );
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function newAction(Request $request, User $user) {

        // Sécurité : on ne s'écrit pas à soi même
        if ($user->getId() == $this->get('security.token_storage')->getToken()->getUser()->getId() || $user->getPromotion() != date('Y')) {
           return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
        }

        //TODO: Faire la logique dans le BusinessManager

         $em = $this->getDoctrine()->getManager();
        $yearbookmessages = new YearbookMessages();
        $yearbookmessages->setUserFrom($this->get('security.token_storage')->getToken()->getUser());
        $yearbookmessages->setUserTo($user);

        $yearbookmessages->setYearbook($this->getDoctrine()->getRepository('ApplicationYearbookBundle:Yearbook')->findBy(array(
                'promotion' => date('Y'),
                'activated' => TRUE
            )
        )[0]);

        $form = $this->createForm(YearbookMessagesType::class, $yearbookmessages);
        $formHandler = new YearbookMessagesHandler($form, $request, $em);

        if ($formHandler->process()) {

            // Si un message vient d'être envoyé, on envoie un email à celui qui l'a reçu

            return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
        }

        return $this->render('ApplicationYearbookBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
           'name' => $user->getName(),
            'surname' => $user->getSurname()
        ));
    }


    public function deleteAction(YearbookMessages $yearbookmessage) {
        //TODO: Faire la logique dans le BusinessManager

        if ($yearbookmessage->getUserTo() != $this->get('security.token_storage')->getToken()->getUser()) {
            return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($yearbookmessage);
        $em->flush();

        return $this->redirect($this->generateUrl('application_yearbook_listmessages'));
    }
}