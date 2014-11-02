<?php
namespace Application\MailingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\MailingBundle\Manager\UserConfigManager;
use Application\MainBundle\Manager\LogManager;
use Application\MailingBundle\Form\UserConfigType;
use Application\MailingBundle\Form\UserConfigHandler;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * NOTES
 * 
 *  Il n'est pas nécessaires d'avoir une action pour ajouter une config utilisateur
 *  Par défault tout utilisateur doit en avoir une
 *  
 *  Il n'est pas possible non plus de supprimer une config utilisateur
 */

class UserConfigController extends Controller {
        
    /**
     *  Action d'abonnement de l'utilisateur connecté à une ML
     */ 
     //* @Secure(roles = "ROLE_APPLICATION_MAILINGLIST_EDIT")
     //*/
    public function setAbonnementAction () {
        $manager = new UserConfigManager($this);
        $config = $manager->getUserConfig($this->getUser());
        
        $config->setIsChecked(true);
        $manager->persist($config);
        $manager->flush();
        
        LogManager::save($this, '[Mailing] Abonnement de l\'utilisateur id : '.$this->getUser()->getId());
        
        return $this->redirect($this->generateUrl('application_mailing_homepage'));
    }
    
    /**
     * Désabonnement de l'utilisateur connecté de l'infobnei
     */ 
     //* @Secure(roles = "ROLE_APPLICATION_MAILINGLIST_EDIT")
     //*/
    public function deleteAbonnementAction () {
        $manager = new UserConfigManager($this);
        $config = $manager->getUserConfig($this->getUser());
    
        
        $config->setIsChecked(false);
        $manager->persist($config);
        $manager->flush();
        
        LogManager::save($this, '[Mailing] Désabonnement de l\'utilisateur id : '. $this->getUser()->getId());
        
        return $this->redirect($this->generateUrl('application_mailing_homepage'));
    }
}