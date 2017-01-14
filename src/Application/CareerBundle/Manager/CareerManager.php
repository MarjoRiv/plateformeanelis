<?php

namespace Application\CareerBundle\Manager;

use Application\MainBundle\Model\BaseManager;


class CareerManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'ApplicationCareerBundle:Career';
    }
}