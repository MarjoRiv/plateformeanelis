<?php

namespace Application\CareerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CareerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeCareer', 'entity', array(
                        'class' => 'ApplicationCareerBundle:TypeCareer',
                        //'property' => 'name',
                        'required' => true
            ))
            ->add('institution', TextType::class, array(
                'required' => true
            ))
            ->add('position', TextType::class, array(
                'required' => true,
            ))
            ->add('date', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => 'true',
            ))
            ->add('description', TextType::class, array(
                'required' => false
            ))
            ->add('localisation', TextType::class, array(
                'required' => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\CareerBundle\Entity\Career'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'application_careerbundle_career';
    }

}
