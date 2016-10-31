<?php

namespace Admin\UserBundle\Manager;

use Application\MainBundle\Model\BaseManager;


class UserManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'AdminUserBundle:User';
    }
}