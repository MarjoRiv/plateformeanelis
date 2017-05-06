<?php

namespace Application\CotisationBundle\Form;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CotisationType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $yearCotisation = $options['choices'];
        $random_string = base64_encode(random_bytes(10));
        $builder
            ->add('priceCotisation', ChoiceType::class, array(
                'choices'      => [$yearCotisation->getMinAmount(), $yearCotisation->getProposedAmount1(),
                    $yearCotisation->getProposedAmount2(), $yearCotisation->getProposedAmount3(),
                    $yearCotisation->getProposedAmount4(),'Libre'],
                'choice_label' => function ($price, $key, $index) {
                    if($key != 5)
                        return $price . ' €';
                    else
                        return $price;
                },
                'required'     => true,
                'expanded'     => true))

            ->add('submit' . $options['formId'], SubmitType::class, array('label' => 'Cotiser'));

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();

                $cotis = $event->getData();

                if($form->get('priceCotisation')->getData() == 'Libre')
                {
                    $form->add('cotisationLibre', NumberType::class, array(
                        'disabled' => true
                    ));
                }
                else
                {
                    try
                    {
                        $form->remove('cotisationLibre');
                    }catch(\OutOfBoundsException $e)
                    {
                        //Ne rien faire
                    }

                }
                ;
            }
        );
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
