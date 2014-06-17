<?php

namespace Admin\UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use WebSite\MainBundle\Form\ImageType;

class RegistrationType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder
            ->add("name", "text", array(
                "required" => true,
            ))
            ->add("surname", "text", array(
                "required" => true,
            ))
            ->add("telephone", "text", array(
                "required" => true,
            ))
            ->add("address", "textarea", array(
                "required" => true,
            ));
    }

    public function getName()
    {
        return 'admin_user_registration';
    }
}