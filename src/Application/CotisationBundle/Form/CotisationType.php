<?php

namespace Application\CotisationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CotisationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', 'date', array(
                'required' => true
                ))
            ->add('endDate', 'date', array(
                'required' => true
                ))
            ->add('type', 'entity', array(
                    'class' => 'ApplicationCotisationBundle:TypeCotisation',
                    'property' => 'name',
                    'required' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\CotisationBundle\Entity\Cotisation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'application_cotisationbundle_cotisation';
    }

}
