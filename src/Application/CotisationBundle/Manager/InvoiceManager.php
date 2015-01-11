<?php

namespace Application\CotisationBundle\Manager;

use Application\MainBundle\Model\BaseManager;


class InvoiceManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'ApplicationCotisationBundle:Invoice';
    }
}