<?php

namespace Admin\ImportBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;


class UserImportAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'user_import';
    protected $baseRouteName = 'user_import';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list']);
    }
}