<?php

namespace Admin\UserBundle\Controller;

use Admin\UserBundle\Entity\User;
use Admin\UserBundle\Form\UserHandler;
use Admin\UserBundle\Form\UserType;
use Admin\UserBundle\Manager\UserManager;
use Application\MainBundle\Manager\LogManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function editAction(User $user) {
        
        // Vérification de l'id pour des raisons de sécurités
        if($user->getId() != $this->get('security.context')->getToken()->getUser()->getId())
        {
            return $this->redirect($this->generateUrl('user_edit_profile', array('id' => $this->get('security.context')->getToken()->getUser()->getId())));
        }

        $manager = new UserManager($this);
        
        $entity = new UserType();
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
