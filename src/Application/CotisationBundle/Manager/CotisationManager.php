<?php

namespace Application\CotisationBundle\Manager;

use Application\MainBundle\Model\BaseManager;


class CotisationManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'ApplicationCotisationBundle:Cotisation';
    }
}