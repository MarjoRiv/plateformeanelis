<?php

namespace Application\SocialBundle\Manager;

use Application\MainBundle\Model\BaseManager;


class MachinManager extends BaseManager {
    public function getNamespaceEntity() {
        return 'ApplicationSocialBundle:UserSocial';
    }
}