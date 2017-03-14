<?php

namespace Application\OffreBundle\Admin;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class OffreAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('description', TextareaType::class)
            ->add('datepublished')
            ->add('dateexpire')
            ->add('type', 'choice', array(
                'choices' => array(
                    '' => '',
                    'Stage' => 'Stage',
                    'Emploi' => 'Emploi',
                    'Logement' => 'Logement',
                    'Vente' => 'Vente',
                    'Autre' => 'Autre',
                    )))
            ->add('enabled')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('datepublished')
        ->add('dateexpire')
        ->add('title')
        ->add('id')
        ->add('reading')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name','text')
            ->add('title')
            ->add('type')
            ->add('enabled')
            ->add('dateexpire')
            ->add('reading')
            ->add('IdAttachement')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('name')
            ->add('description')
            ->add('datepublished')
            ->add('dateexpire')
            ->add('type')
            ->add('enabled')
            ->add('reading')
            ->add('IdAttachement')
        ;
    }
}