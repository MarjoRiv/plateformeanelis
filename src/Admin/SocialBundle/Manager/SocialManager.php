<?php

namespace Admin\SocialBundle\Manager;

use Application\MainBundle\Model\BaseManager;


class SocialManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'AdminSocialBundle:Social';
    }
}