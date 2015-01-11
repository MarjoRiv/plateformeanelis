<?php

namespace Application\CotisationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CotisationAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('payed', 'text', array('label' => 'Payed'))
            ->add('year', 'date', array('label' => 'Année'))
            ->add('typeCotisation', 'entity', array(
                'class' => 'ApplicationCotisationBundle:TypeCotisation',
                'property' => 'name',
                'label' => "Nom",
            ))
            ->add('user', 'entity', array(
                'class' => 'AdminUserBundle:User',
                'property' => 'name',
                'label' => "Nom",
            ))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('user')
            ->add('year')
            ->add('payed')
            // add custom action links
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                )
            ))
        ;
    }
}