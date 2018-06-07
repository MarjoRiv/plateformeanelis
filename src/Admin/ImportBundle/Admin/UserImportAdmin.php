<?php

namespace Admin\ImportBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;


class UserImportAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'user_import';
    protected $baseRouteName = 'user_import';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['create', 'list']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('createdDate')
            ->add('lastRunDate')
            ->add('state')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
}