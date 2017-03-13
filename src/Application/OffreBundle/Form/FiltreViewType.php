<?php

namespace Application\OffreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreViewType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ));
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
        return 'filtre_view_type';
    }
}

?>