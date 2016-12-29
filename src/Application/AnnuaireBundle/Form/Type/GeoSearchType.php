<?php
namespace Application\AnnuaireBundle\Form\Type;
use Application\AnnuaireBundle\Model\GeoSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GeoSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postalcode', TextType::class, array(
                'required' => false,
            ))
            ->add('city', TextType::class, array(
                'required' => false,
            ))
            ->add('country', CountryType::class, array(
                'required' => false,
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
   {
        $resolver->setDefaults(array(
            // avoid to pass the csrf token in the url (but it's not protected anymore)
            'csrf_protection' => false,
            'data_class' => 'Application\AnnuaireBundle\Model\GeoSearch'
        ));
    }
    public function getBlockPrefix()
    {
        return 'geo_search_type';
    }

}