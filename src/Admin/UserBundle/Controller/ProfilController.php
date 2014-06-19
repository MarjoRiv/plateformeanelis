<?php

namespace Admin\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Admin\UserBundle\Entity\User;
use Admin\UserBundle\Form\UserType;
use Admin\UserBundle\Form\UserHandler;
use Admin\UserBundle\Manager\UserManager;
use Application\MainBundle\Manager\LogManager;

class ProfilController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminUserBundle:Default:index.html.twig');
    }

    public function showAction(User $user)
    {
        return $this->render('AdminUserBundle:Profile:show.html.twig', array(
            'user' => $user));
    }

    public function editAction(User $user) {
        
        // Vérification de l'id pour des raisons de sécurités
        if($user->getId() != $this->get('security.context')->getToken()->getUser()->getId())
        {
            return $this->redirect($this->generateUrl('user_edit_profile', array('id' => $this->get('security.context')->getToken()->getUser()->getId())));
        }

        $manager = new UserManager($this);
    
        $form = $this->createForm(new UserType(), $user);
        $formHandler = new UserHandler($form, $this->get('request'), $manager);
            
        if ($formHandler->process()) {
            LogManager::save($this, "Modification de l'utilisateur " . $user->getId());
            $this->get('session')->getFlashBag()->add('success', "L'utilisateur a été modifié.");

        }

        return $this->render('AdminUserBundle:Profile:user.edit.html.twig', array(
                "form" => $form->createView(),
        ));
        
    }

}
