<?php

namespace Admin\UserBundle\Controller;

use Admin\UserBundle\Entity\User;
use Admin\UserBundle\Entity\Newsletter;
use Admin\UserBundle\Form\NewsLetterType;
use Admin\UserBundle\Form\UserHandler;
use Admin\UserBundle\Form\UserType;
use Admin\UserBundle\Manager\UserManager;
use Application\MainBundle\Manager\LogManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends Controller
{

    public function indexAction()
    {
        return $this->render('AdminUserBundle:Default:index.html.twig');
    }

    public function showAction(User $user)
    {
        $careers = $user->getCareers()->toArray();

        usort($careers, function($a, $b) {
            if ($a->getTypeCareer()->getId() == $b->getTypeCareer()->getId())
            {
                if($a->getDate() == $b->getDate()) return 0;
                return ($a->getDate() < $b->getDate()) ? -1 : 1;
            }
            else
                return ($a->getTypeCareer()->getId() < $b->getTypeCareer()->getId()) ? -1 : 1;
        });

        $careers = array_reverse($careers);

        /*usort($careers, function ($a, $b) {
            return strcmp($a->getTypeCareer()->getId(), $b->getTypeCareer()->getId());
        });*/

        return $this->render('AdminUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'careers' => $careers));
    }

    public function editAction(User $user, Request $request) {
        
        // Vérification de l'id pour des raisons de sécurités
        if($user->getId() != $this->get('security.token_storage')->getToken()->getUser()->getId())
        {
            return $this->redirect($this->generateUrl('user_edit_profile', array('id' => $this->get('security.context')->getToken()->getUser()->getId())));
        }

        $em = $this->getDoctrine()->getManager();
        


        $form = $this->createForm(UserType::class, $user);
        $formHandler = new UserHandler($form, $request, $em);
        if ($formHandler->process()) {
            //TODO : Search why we use this LogManager and where...
            //LogManager::save($this, "Modification de l'utilisateur " . $user->getId());
            $this->get('session')->getFlashBag()->add('success', "L'utilisateur a été modifié.");

        }
        $listnewsletter = $em->getRepository("AdminUserBundle:Newsletter")->findall();

        return $this->render('AdminUserBundle:Profile:user.edit.html.twig', array(
                "form" => $form->createView(),

        ));
        
    }

    public function showAllNewsLetter(){
        return $this->getDoctrine()->getRepository("AdminUserBundle:Subscriber")->findall();
    }

}
