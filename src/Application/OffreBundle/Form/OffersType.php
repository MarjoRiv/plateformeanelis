<?php

namespace Application\OffreBundle\Form;

use Application\OffreBundle\Entity\Offers;
use Symfony\Component\Form\AbstractType;
use Application\OffreBundle\Form\FileOffreType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffersType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'required' => true,
            ))
            ->add('type', ChoiceType::class, array(
                'required' => true,
                'choices'   => array(
                    '' => '',
                    'Stage' => 'Stage',
                    'Emploi' => 'Emploi',
                    'Logement' => 'Logement',
                    'Vente' => 'Vente',
                    'Autre' => 'Autre',
                    ),
            ))
            ->add('description', TextareaType::class, array(
                'required' => true,
            ))
            ->add('attachement', FileOffreType::class, array(
                'required' => false,
            ))
            ->add('enabled', HiddenType::class, array(
                'required' => false,
                'empty_data' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        	'csrf_protection' => false,
            // avoid to pass the csrf token in the url (but it's not protected anymore
            'data_class' => 'Application\OffreBundle\Entity\Offers'
        ));
    }
    public function getBlockPrefix()
    {
        return 'offers_type';
    }
}

?>