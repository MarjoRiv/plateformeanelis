<?php

namespace Application\SocialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Admin\SocialBundle\Form\SocialType;

class MachinType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userSocials', 'collection', array(
                'type' => new UserSocialType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            // Lier ce type avec l'user ? useless visiblement ...
            //'data_class' => "Admin\UserBundle\Entity\User"
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
