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
            ->add('maritalName', 'text', array('label' => 'Nom Marital', 'required' => false))
            ->add('promotion', 'choice', array(
                'choices' => $this->lstPromotions(),
                'required' => false,
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
                'required' => false
            ))
            ->add('address', 'text', array('label' => 'Adresse', 'required' => false))
            ->add('telephone', 'text', array('label' => 'Téléphone', 'required' => false))
            ->add('website', 'text', array('label' => 'Site Web', 'required' => false))
            ->add('biography', 'text', array('label' => 'Biographie', 'required' => false))
            ->add('maritalStatus', 'text', array('label' => 'Statut marial', 'required' => false))
            ->add('childrenNumber', 'text', array('label' => 'Nombre d\'enfants', 'required' => false))
            ->add('birthday', 'birthday', array('label' => 'Date de naissance', 'required' => false))
            ->add('biography', 'text', array('label' => 'Biographie', 'required' => false))
            ->add('socialFacebook', 'text', array('label' => 'Facebook', 'required' => false))
            ->add('socialTwitter', 'text', array('label' => 'Twitter', 'required' => false))
            ->add('socialLinkedin', 'text', array('label' => 'Linkedin', 'required' => false))
            ->add('socialGoogle', 'text', array('label' => 'Google', 'required' => false))
            ->add('socialYoutube', 'text', array('label' => 'Youtube', 'required' => false))
            ->add('socialInstagram', 'text', array('label' => 'Instagram', 'required' => false))
            ->add('isEmailValid', null, array('label' => 'Email valide ?', 'required' => false))
            ->add('mlInformations', null, array('label' => 'ML Informations', 'required' => false))
            ->add('mlEmployment', null, array('label' => 'ML Offres d\'emplois', 'required' => false))
            ->add('mlEvents', null, array('label' => 'ML Événements (BDE ...)', 'required' => false))
            ->add('mlIsimaNews', null, array('label' => 'ML Actualité ISIMA', 'required' => false))
            //->add('plainPassword', 'password')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
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