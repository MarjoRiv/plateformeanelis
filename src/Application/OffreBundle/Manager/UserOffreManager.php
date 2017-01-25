<?php

namespace Application\OffreBundle\Manager;

use Application\MainBundle\Model\BaseManager;


class UserOffreManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'OffreBundle:UserOffre';
    }
}