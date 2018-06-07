<?php

namespace Admin\ImportBundle\Form;

use Admin\ImportBundle\Entity\UserImportAction;
use Admin\ImportBundle\Entity\UserImportLine;
use Admin\ImportBundle\Entity\UserImportLineState;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserImportLinesEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('lines', CollectionType::class, array(
                'entry_type' => UserImportLineType::class
            ))
            ->add('check', SubmitType::class, array('label' => 'Vérifier les données'))
            ->add('submit', SubmitType::class, array('label' => 'Importer',
                'attr' => array('disabled' => $options['state'] == 0 ? 'disabled' : false)));
    }
}