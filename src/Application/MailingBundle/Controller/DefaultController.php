<?php

namespace Application\MailingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\MailingBundle\Manager\UserConfigManager;
use Application\MailingBundle\Form\UserConfigType;
use Application\MailingBundle\Form\UserConfigHandler;
use Application\MainBundle\Manager\LogManager;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $manager = new UserConfigManager($this);
        $config = $manager->getUserConfig($this->getUser());
        $form = $this->createForm(new UserConfigType(), $config);
        
        $handler = new UserConfigHandler($form, $this->getRequest(), $manager);
        if($handler->process()) {
            LogManager::save($this, '[MailingList] Modification des abonnements de l\'utilisateur id : '. $this->getUser()->getId());
            //$this->get('session')->getFlashBag()->add('success', "Vos abonnements ont été enregistrés.");
        }
        
        return $this->render('ApplicationMailingBundle:Default:index.html.twig', array(
            'config' => $config,
            'form' =>$form->createView(),
        ));
    }

}
