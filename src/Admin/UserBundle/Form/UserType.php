<?php

namespace Admin\UserBundle\Form;

use Admin\UserBundle\Form\TelType;
use Application\MainBundle\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'required' => true
                ))
            ->add('maritalName', TextType::class, array(
                'required' => false))
            ->add('nickname', TextType::class, array(
                'required' => false))
            ->add('promotion', ChoiceType::class, array(
                'choices' => $this->lstPromotions(),
                'required'  => false,
                ))
            ->add('filiere', ChoiceType::class, array(
                'choices'   => array(
                    'F1' => 'F1',
                    'F2' => 'F2',
                    'F3' => 'F3',
                    'F4' => 'F4',
                    'F5' => 'F5',
                    'FI' => 'FI',
                    ),
                ))
            ->add('genre', ChoiceType::class, array(
                'choices' => array(
                    'M' => 'M',
                    'F' => 'F',
                    ),
                ))
            ->add('address', TextareaType::class, array(
                'required' => false,
                ))
            ->add('postalcode', TextType::class, array(
                'required' => false,
                ))
            ->add('city', TextType::class, array(
                'required' => false,
                ))
            ->add('country', CountryType::class, array(
                'required' => false
                ))
            ->add('telephone', TelType::class, array(
                'required' => false,
                ))
            ->add('website', TextType::class, array(
                'required' => false,
                ))
            ->add('biography', TextareaType::class, array(
                'required' => false,
                ))
            ->add('avatar', new ImageType())
            ->add('socialFacebook', TextType::class, array(
                'required' => false,
                ))
            ->add('socialTwitter', TextType::class, array(
                'required' => false,
                ))
            ->add('socialLinkedin', TextType::class, array(
                'required' => false,
                ))
            ->add('socialGoogle', TextType::class, array(
                'required' => false,
                ))
            ->add('socialYoutube', TextType::class, array(
                'required' => false,
                ))
            ->add('socialInstagram', TextType::class, array(
                'required' => false,
                ))

            /*
            ->add('birthday', 'birthday', array(
                'widget' => 'choice',
                'input' => 'string',
                ))*/
            ->add('birthday', 'date', array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'required' => 'false',
            ))

            ->add('maritalStatus', ChoiceType::class, array(
                'choices'   => array(
                    'Célibataire' => 'Célibataire',
                    'En couple' => 'En couple',
                    'Fiancé(e)' => 'Fiancé(e)',
                    'Marié(e)' => 'Marié(e)',
                    'En union libre' => 'En union libre',
                    ),
                ))
            ->add('childrenNumber', IntegerType::class, array(
                'required' => false
                ))
            ->add('mlInformations', CheckboxType::class, array(
                'required' => false
                ))
            ->add('mlEmployment', CheckboxType::class, array(
                'required' => false
                ))
            ->add('mlEvents', CheckboxType::class, array(
                'required' => false
                ))
            ->add('mlIsimaNews', CheckboxType::class, array(
                'required' => false
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'admin_userbundle_user';
    }

    public function lstPromotions() {
        $result = array();

        for ($i = 1995 ; $i <= date('Y')+2 ; $i++) {
            $result["".$i] = $i;
        }
        return $result;
    }
}
