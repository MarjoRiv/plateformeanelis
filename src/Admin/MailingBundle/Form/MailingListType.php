<?php
namespace Admin\MailingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MailingListType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('name', 'text', array(
            'required' => true,
        ))
        ;
    }
    
    public function getName() {
        return "admin_mailing_mailinglist";
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver){
        $resolver->setDefaults(array(
                'data_class' => 'Admin\MailingBundle\Entity\MailingList',
        ));
    }
}