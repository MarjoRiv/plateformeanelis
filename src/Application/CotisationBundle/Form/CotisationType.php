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
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class CotisationType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @var YearCotisation $yearCotisation
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $yearCotisation = $options['choices'];
        $user = $options['user'];
        if($user->getIntPromotion() >= $yearCotisation->getPromoReduiteMax())
        {
            $choices = [$yearCotisation->getReducedFeeAmount(), $yearCotisation->getMinAmount(),
                $yearCotisation->getProposedAmount1(), $yearCotisation->getProposedAmount2(),
                $yearCotisation->getProposedAmount3()];
            $constraint = new GreaterThanOrEqual($yearCotisation->getReducedFeeAmount());

        }
        else
        {
            $choices = [$yearCotisation->getMinAmount(), $yearCotisation->getProposedAmount1(),
                $yearCotisation->getProposedAmount2(), $yearCotisation->getProposedAmount3(),
                $yearCotisation->getProposedAmount4()];
            $constraint = new GreaterThanOrEqual($yearCotisation->getMinAmount());
        }
        $random_string = base64_encode(random_bytes(10));
        $builder
            ->add('priceCotisation', ChoiceType::class, array(
                'choices'      => $choices,
                'choice_label' => function ($price, $key, $index) {
                        return $price . ' €';
                },
                'data' => $yearCotisation->getMinAmount(),
                'empty_data' => $yearCotisation->getMinAmount(),
                'required'     => true,
                'expanded'     => true))
            ->add('cotisationLibre', MoneyType::class, array(
                'constraints' => $constraint,
                 'required' => false,
                'scale' => 0

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
            'user' => null
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix() {
        return 'application_cotisationbundle_cotisation';
    }


}
