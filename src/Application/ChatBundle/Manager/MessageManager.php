<?php

namespace Application\ChatBundle\Manager;

use Application\MainBundle\Model\BaseManager;

class MessageManager extends BaseManager{
    
    public function getNamespaceEntity(){
        return "ApplicationChatBundle:Message";
    }
}