<?php

namespace Admin\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Application\MainBundle\Form\ImageType;

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
            ->add('promotion', 'choice', array(
                'choices' => $this->lstPromotions(),
                'required'  => false,
            ))
            ->add('filiere', 'choice', array(
                'choices'   => array(
                    'F1' => 'F1',
                    'F2' => 'F2',
                    'F3' => 'F3',
                    'F4' => 'F4',
                    'F5' => 'F5',
                    'FI' => 'FI',
                ),
            ))
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
            ->add('avatar', new ImageType())
            ->add('socialFacebook', 'text', array(
                'required' => false,
                ))
            ->add('socialTwitter', 'text', array(
                'required' => false,
                ))
            ->add('socialLinkedin', 'text', array(
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

    public function lstPromotions() {
        $result;

        for ($i = 1995 ; $i <= date('Y') ; $i++) {
            $result["".$i] = $i;
        }
        return $result;
    }
}
