<?php

namespace Admin\ImportBundle\Form;

use Admin\ImportBundle\Entity\UserImportAction;
use Admin\ImportBundle\Entity\UserImportLine;
use Admin\ImportBundle\Entity\UserImportLineState;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserImportLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('login', TextType::class, array('label' => false, 'required' => false))
            ->add('mail', EmailType::class, array('label' => false, 'required' => false))
            ->add('prenom', TextType::class, array('label' => false, 'required' => false))
            ->add('nom', TextType::class, array('label' => false, 'required' => false))
            ->add('promo', IntegerType::class, array('label' => false, 'required' => false))
            ->add('filiere', TextType::class, array('label' => false, 'required' => false))
            ->add('adresse', TextType::class, array('label' => false, 'required' => false))
            ->add('telephone', TextType::class, array('label' => false, 'required' => false))
            ->add('state', ChoiceType::class, array('attr' => array('read_only' => true),'choices' => UserImportLineState::getValuesFromLabel(), 'label' => false))
            ->add('action', ChoiceType::class, array('attr' => array('read_only' => true), 'choices' => UserImportAction::getValuesFromLabel(), 'label' => false));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserImportLine::class,
            'state' => null
        ));
    }
}