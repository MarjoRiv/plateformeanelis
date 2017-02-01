<?php

namespace Application\OffreBundle\Controller;

use Application\OffreBundle\Form\OffersType;
use Application\OffreBundle\Entity\Offers;
use Application\OffreBundle\Entity\UserOffre;
use Admin\UserBundle\Entity\User;
use Application\OffreBundle\Manager\OffersManager;
use Application\OffreBundle\Manager\UserOffreManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OffreController extends Controller
{

    public function showAction(Offers $offre)
    {
        
        return $this->render('OffreBundle:Offre:show.html.twig', array(
            'offre' => $offre));
    }

    public function editAction(Offers $offre, Request $request) {
        
        // Vérification de l'id pour des raisons de sécurités
        if($user->getId() != $this->get('security.token_storage')->getToken()->getUser()->getId())
        {
            return $this->redirect($this->generateUrl('user_edit_profile', array('id' => $this->get('security.context')->getToken()->getUser()->getId())));
        }

        $em = $this->getDoctrine()->getManager();
        
        $entity = new UserType();
        $form = $this->createForm(UserType::class, $user);
        $formHandler = new UserHandler($form, $request, $em);
            
        if ($formHandler->process()) {
            //TODO : Search why we use this LogManager and where...
            //LogManager::save($this, "Modification de l'utilisateur " . $user->getId());
            $this->get('session')->getFlashBag()->add('success', "L'utilisateur a été modifié.");

        }

        return $this->render('AdminUserBundle:Profile:user.edit.html.twig', array(
                "form" => $form->createView(),
        ));
        
    }

}
