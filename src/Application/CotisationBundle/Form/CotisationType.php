<?php

namespace Application\CotisationBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CotisationType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $yearCotisation = $options['choices'];
        $random_string = base64_encode(random_bytes(10));
        $builder
            ->add('price', ChoiceType::class, array(
                'choices'      => [$yearCotisation->getMinAmount(), $yearCotisation->getProposedAmount1(),
                    $yearCotisation->getProposedAmount2(), $yearCotisation->getProposedAmount3(),
                    $yearCotisation->getProposedAmount4()],
                'choice_label' => function ($price, $key, $index) {
                    return $price . ' €';
                },
                'required'     => true,
            ))
            ->add('submit' . $options['formId'], SubmitType::class, array('label' => 'Cotiser'));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'choices' => null,
            'formId'  => null,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix() {
        return 'application_cotisationbundle_cotisation';
    }


}
