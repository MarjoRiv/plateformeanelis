<?php

namespace Application\OffreBundle\Manager;

use Application\MainBundle\Model\BaseManager;


class OffersManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'OffreBundle:Offers';
    }
}