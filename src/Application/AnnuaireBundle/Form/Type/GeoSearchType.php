<?php
namespace Application\AnnuaireBundle\Form\Type;
use Application\AnnuaireBundle\Model\GeoSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GeoSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postalcode', 'text', array(
                'required' => false,
            ))
            ->add('city', 'text', array(
                'required' => false,
            ))
            ->add('country', 'country', array(
                'required' => false,
            ))
        ;
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
        $resolver->setDefaults(array(
            // avoid to pass the csrf token in the url (but it's not protected anymore)
            'csrf_protection' => false,
            'data_class' => 'Application\AnnuaireBundle\Model\GeoSearch'
        ));
    }
    public function getName()
    {
        return 'geo_search_type';
    }

}