<?php
namespace Admin\MailingBundle\Manager;

use Application\MainBundle\Model\BaseManager;

class MailingListManager extends BaseManager {
    public function getNamespaceEntity(){
        return "AdminMailingBundle:MailingList";
    }
}