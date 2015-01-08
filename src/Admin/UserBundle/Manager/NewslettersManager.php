<?php

namespace Admin\UserBundle\Manager;

use Application\MainBundle\Model\BaseManager;


class NewslettersManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'AdminUserBundle:Group';
    }
}