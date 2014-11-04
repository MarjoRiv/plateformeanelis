<?php

namespace Application\SocialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\SocialBundle\Entity\UserSocial;
use Application\SocialBundle\Form\MachinType;
use Application\SocialBundle\Form\MachinHandler;
use Application\SocialBundle\Manager\MachinManager;

class DefaultController extends Controller
{


    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('ApplicationSocialBundle:UserSocial')->findByUser(
            $this->get('security.context')->getToken()->getUser()
        );

        return $this->render('ApplicationSocialBundle:Default:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function newAction()
    {

        $manager = new MachinManager($this);
        $form = $this->createForm(new MachinType(), $this->get('security.context')->getToken()->getUser());
        $formHandler = new MachinHandler($form, $this->get('request'), $manager);
            
        if ($formHandler->process()) {
            //LogManager::save($this, "Ajout du ... " . $usersocial->getId());
            //$this->get('session')->getFlashBag()->add('success', '...');
            return $this->redirect($this->generateUrl('application_social_homepage'));
        }



        return $this->render('ApplicationSocialBundle:Default:new.html.twig', array(
            'form'   => $form->createView(),
        ));

    }

}
