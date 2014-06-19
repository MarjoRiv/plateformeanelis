<?php

namespace Admin\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'required' => true
                ))
            ->add('email', 'email')
            ->add('name', 'text')
            ->add('surname', 'text')
            ->add('address', 'textarea', array(
                'required' => false,
                ))
            ->add('telephone', 'text', array(
                'required' => false,
                ))
            ->add('website', 'text', array(
                'required' => false,
                ))
            ->add('biography', 'textarea', array(
                'required' => false,
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_userbundle_user';
    }
}
