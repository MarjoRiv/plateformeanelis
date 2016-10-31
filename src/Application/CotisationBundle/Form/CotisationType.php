<?php

namespace Application\CotisationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CotisationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('year', 'datetime', array(
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy',
                'data' => new \DateTime("now")
                ))*/
            ->add('year', 'choice', array(
                'required' => true,
                'choices' => array(
                    "". Date('Y') ."" => "". Date('Y'). "",
                    "". Date('Y') + 1 ."" => "". Date('Y') + 1 ."",
                    "". Date('Y') + 2 ."" => "". Date('Y') + 2 ."",
                    "". Date('Y') + 3 ."" => "". Date('Y') + 3 ."",
                    "". Date('Y') + 4 ."" => "". Date('Y') + 4 ."",
                )))
            ->add('typeCotisation', 'entity', array(
                    'class' => 'ApplicationCotisationBundle:TypeCotisation',
                    'property' => 'name',
                    'required' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\CotisationBundle\Entity\Cotisation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'application_cotisationbundle_cotisation';
    }

    public function buildYearChoices() {
    $distance = 5;
    $yearsBefore = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") - $distance));
    $yearsAfter = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") + $distance));
    return array_combine(range($yearsBefore, $yearsAfter), range($yearsBefore, $yearsAfter));
}

}
