<?php

namespace Application\MainBundle\Manager;

use Application\MainBundle\Model\BaseManager;
use Application\MainBundle\Entity\Log;
use Admin\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LogManager extends BaseManager {
    public static function save(Controller $controller, $description) {
        $manager = new LogManager($controller);
        $manager->saveLog($description, $controller->getUser());
    }
    
    public function getNamespaceEntity() {
        return 'AdminUserBundle:User';
    }
    
    public function saveLog($description, User $user = null) {
        $log = new Log();
        $log->setDate(new \DateTime());
        $log->setIp($_SERVER['REMOTE_ADDR']);
        $log->setUrl($_SERVER["REQUEST_URI"]);
        $log->setDescription($description);
        $log->setUser($user);
        
        $this->persist($log);
        $this->flush();
    }
}