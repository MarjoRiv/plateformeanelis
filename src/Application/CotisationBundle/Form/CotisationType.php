<?php

namespace Application\CotisationBundle\Form;

use Application\CotisationBundle\Entity\YearCotisation;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class CotisationType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @var YearCotisation $yearCotisation
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
            ->add('cotisationLibre', IntegerType::class, array(
                'constraints' => new GreaterThanOrEqual($yearCotisation->getMinAmount()),
                'data' => $yearCotisation->getMinAmount(),

            ))
            ->add('submit' . $options['formId'], SubmitType::class, array('label' => 'Cotiser'))
            ;


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
