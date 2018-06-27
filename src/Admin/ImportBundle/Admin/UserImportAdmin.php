<?php

namespace Admin\ImportBundle\Admin;

use Admin\ImportBundle\Entity\UserImportState;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;


class UserImportAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'user_import';
    protected $baseRouteName = 'user_import';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['create', 'list', 'edit']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'Id'))
            ->add('createdDate', null, array('label' => 'Création'))
            ->add('createdBy', null, array('label' => 'Créé par'))
            ->add('importName', null, array('label' => 'Nom de l\'import'))
            ->add('lastRunDate', null, array('label' => 'Dernier lancement'))
            ->add('state', 'choice', array('label' => 'Etat', 'choices' => UserImportState::getLabelsFromValues()))
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