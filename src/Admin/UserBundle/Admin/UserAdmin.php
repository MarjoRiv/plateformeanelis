<?php

namespace Admin\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', 'text', array('label' => 'Username*'))
            ->add('email', 'text', array('label' => 'Email*'))
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('surname', 'text', array('label' => 'Prénom'))
            ->add('maritalName', 'text', array('label' => 'Nom Marital'))
            ->add('promotion', 'choice', array(
                'choices' => $this->lstPromotions()
            ))
            ->add('filiere', 'choice', array(
                'choices' => array(
                    'F1' => 'F1',
                    'F2' => 'F2',
                    'F3' => 'F3',
                    'F4' => 'F4',
                    'F5' => 'F5',
                    'FI' => 'FI',
                    )
            ))
            ->add('address', 'text', array('label' => 'Adresse'))
            ->add('telephone', 'text', array('label' => 'Téléphone'))
            ->add('website', 'text', array('label' => 'Site Web'))
            ->add('biography', 'text', array('label' => 'Biographie'))
            ->add('maritalStatus', 'text', array('label' => 'Statut marial'))
            ->add('childrenNumber', 'text', array('label' => 'Nombre d\'enfants'))
            ->add('birthday', 'birthday', array('label' => 'Date de naissance'))
            ->add('biography', 'text', array('label' => 'Biographie'))
            ->add('socialFacebook', 'text', array('label' => 'Facebook'))
            ->add('socialTwitter', 'text', array('label' => 'Twitter'))
            ->add('socialLinkedin', 'text', array('label' => 'Linkedin'))
            ->add('newsletters', 'entity', array(
                'class' => 'AdminUserBundle:Newsletters',
                'property' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => "Name",
            ))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('promotion')
            ->add('filiere')
            ->add('name')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('surname')
            ->add('promotion')
            ->add('filiere')
            ->add('email')
            // add custom action links
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                )
            ))
        ;
    }

    protected function lstPromotions() {
        $result;

        for ($i = 1995 ; $i <= date('Y')+2 ; $i++) {
            $result["".$i] = $i;
        }
        return $result;
    }
}