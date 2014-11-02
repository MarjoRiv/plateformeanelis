<?php
namespace Application\MailingBundle\Manager;

use Application\MainBundle\Model\BaseManager;
use Admin\UserBundle\Entity\User;
use Application\MailingBundle\Entity\UserConfig;

class UserConfigManager extends BaseManager {
    public function getNamespaceEntity(){
        return "ApplicationMailingBundle:UserConfig";
    }   
    
    public function getUserConfig(User $user){
        $result = $this->getRepository()->findByUserId($user);
        if($result == null){
            $result = new UserConfig();
            $result->setUserId($user);
            $result->setIsChecked(false);
            
            $this->persist($result);
            $this->flush();
            return $result;
        }
        return $result[0];
    }
    
    /**
     * Retourne la liste configurations ML d'utilisateurs enregistrés
     */
    public function getRegisterUser () {
        return $this->getRepository()->getRegisterConfig();
    }
}