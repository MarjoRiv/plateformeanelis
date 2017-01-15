<?php

namespace Application\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('input', FileType::class, array(
                "required" => false,
            ))
        ;
    }

    public function getBlockPrefix()
    {
        return 'application_mainbundle_imagetype';
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
                'data_class' => 'Application\MainBundle\Entity\Image',
        ));
    }
}