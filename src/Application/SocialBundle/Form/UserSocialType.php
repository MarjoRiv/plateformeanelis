<?php

namespace Application\SocialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Admin\SocialBundle\Form\SocialType;

class UserSocialType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('social', 'entity', array(
                'class' => 'Admin\SocialBundle\Entity\Social',
                'property' => 'name',
                'required' => false,
                'empty_value' => false
            ))
            ->add('value', 'text')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\SocialBundle\Entity\UserSocial'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'application_socialbundle_usersocial';
    }
}
