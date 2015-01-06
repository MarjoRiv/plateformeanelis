<?php

namespace Application\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('input', 'file', array(
                "required" => false,
            ))
        ;
    }

    public function getName()
    {
        return 'application_mainbundle_imagetype';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
                'data_class' => 'Application\MainBundle\Entity\Image',
        ));
    }
}