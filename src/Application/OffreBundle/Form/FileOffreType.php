<?php

namespace Application\OffreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileOffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, array(
                "required" => true,
            ))
        ;
    }

    public function getBlockPrefix()
    {
        return 'offrebundle_fileoffretype';
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
                'data_class' => 'Application\OffreBundle\Entity\FileOffre',
        ));
    }
}