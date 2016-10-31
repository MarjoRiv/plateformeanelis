<?php

namespace Application\YearbookBundle\Manager;

use Application\MainBundle\Model\BaseManager;

class YearbookMessagesManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'ApplicationYearbookBundle:YearbookMessages';
    }
}