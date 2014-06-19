<?php

namespace Admin\SocialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Admin\SocialBundle\Entity\Social;
use Admin\SocialBundle\Form\SocialType;
use Admin\SocialBundle\Form\SocialHandler;
use Admin\SocialBundle\Manager\SocialManager;
use Application\MainBundle\Manager\LogManager;

// Rajouter role admin
class DefaultController extends Controller
{
    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function indexAction()
    {
        $manager = new SocialManager($this);
        $sociaux = $this->get('knp_paginator')->paginate($manager->findAllQuery('t'), $this->get('request')->query->get('page', 1));
        
        return $this->render('AdminSocialBundle:Default:index.html.twig', array(
            "sociaux" => $sociaux
        ));
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function addAction()
    {
        $manager = new SocialManager($this);
        $social = new Social();
    
        $form = $this->createForm(new SocialType(), $social);
        $formHandler = new SocialHandler($form, $this->get('request'), $manager);
            
        if ($formHandler->process()) {
            LogManager::save($this, "Ajout du réseau social " . $social->getId());
            $this->get('session')->getFlashBag()->add('success', 'Le réseau social a été ajouté.');
            return $this->redirect($this->generateUrl('admin_social_homepage'));
        }
        return $this->render('AdminSocialBundle:Default:add.html.twig', array(
            "form" => $form->createView(),
        ));

    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction(Social $social)
    {
        $manager = new SocialManager($this);
    
        $form = $this->createForm(new SocialType(), $social);
        $formHandler = new SocialHandler($form, $this->get('request'), $manager);
            
        if ($formHandler->process()) {
            LogManager::save($this, "Modification du réseau social " . $social->getId());
            $this->get('session')->getFlashBag()->add('success', 'La réseau social a été mise à jour.');
            return $this->redirect($this->generateUrl('admin_social_homepage'));
        }
        else {
            return $this->render('AdminSocialBundle:Default:edit.html.twig', array(
                    "form" => $form->createView(),
            ));
        }
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction(Social $social)
    {
        $manager = new SocialManager($this);
        $manager->remove($social);

        LogManager::save($this, "Suppression du réseau social " . $social->getId());
        $manager->flush();
        $this->get('session')->getFlashBag()->add('success', "La réseau social a été supprimée.");
        return $this->redirect($this->generateUrl('admin_social_homepage'));
    }    
}
