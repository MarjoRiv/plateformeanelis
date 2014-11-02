<?php
namespace Application\MailingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserConfigType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('choices', 'entity', array(
            'class' => 'Admin\MailingBundle\Entity\MailingList',
            'property' => 'name',
            'multiple' => true,
            'required' => false,
            'expanded' => true
        ));
    }
    
    public function getName() {
        return 'application_mailingbundle_userconfigtype';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults ( array (
                'data_class' => 'Application\MailingBundle\Entity\UserConfig',
        ) );
    }
}