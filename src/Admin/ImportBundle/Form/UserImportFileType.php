<?php

namespace Admin\ImportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserImportFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('file', FileType::class, array('label' => 'Fichier'))
            ->add('name', TextType::class, array('label' => 'Nom de l\'import'))
            ->add('save', SubmitType::class, array('label' => 'Préparer l\'import'));
    }
}