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
            ->add('username', 'text', array('label' => 'Username',
                'required' => true))

            //TODO : Change this otherwise editing an User may need to change his password.
                //Maybe we can just send him a random password at creation.
            ->add('plainpassword', 'password', array('label' => 'Mot de Passe',
                'required' => true))

            ->add('email', 'text', array('label' => 'Email',
                'required' => true))

            ->add('name', 'text', array('label' => 'Nom',
                'required' => true))

            ->add('surname', 'text', array('label' => 'Prénom',
                'required' => true))

            ->add('promotion', 'choice', array(
                'choices' => $this->lstPromotions(),
                'required' => true,
            ))

            ->add('filiere', 'choice', array(
                'choices' => array(
                    'F1' => 'F1',
                    'F2' => 'F2',
                    'F3' => 'F3',
                    'F4' => 'F4',
                    'F5' => 'F5',
                    'FI' => 'FI',
                    ),
                'required' => true
            ))

            ->add('birthday', 'birthday', array('label' => 'Date de naissance', 'required' => true))

        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        //TODO : Add french labels here
        $datagridMapper
            ->add('promotion')
            ->add('filiere')
            ->add('name')
            ->add('isEmailValid')
            ->add('mlInformations')
            ->add('mlEmployment')
            ->add('mlEvents')
            ->add('mlIsimaNews')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        //TODO : Add french labels here
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('surname')
            ->add('promotion')
            ->add('filiere')
            ->add('email')
            ->add('city')
            ->add('telephone')
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