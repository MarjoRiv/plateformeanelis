<?php
namespace Application\AnnuaireBundle\Form\Type;
use Application\AnnuaireBundle\Model\UserSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSearchType extends AbstractType
{
    //protected $perPage = 45;
    //protected $perPageChoices = array(12,15,110);
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // the perPage choices list is hard coded. In a real project, you won't do like that
        /*$perPageChoices = array();
        foreach($this->perPageChoices as $choice){
            $perPageChoices[$choice] = 'Display '.$choice.' items';
        }*/
        $builder
            ->add('name', TextType::class, array(
                'required' => false,
            ))
            ->add('surname', TextType::class, array(
                'required' => false,
            ))
            ->add('filiere', ChoiceType::class, array(
                'required' => false,
                'choices'   => array(
                    '' => '',
                    'F1' => 'F1',
                    'F2' => 'F2',
                    'F3' => 'F3',
                    'F4' => 'F4',
                    'F5' => 'F5',
                    'FI' => 'FI',
                    ),
            ))
            ->add('promotion', ChoiceType::class, array(
                'choices' => $this->lstPromotions(),
                'required'  => false,
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
   {
        $resolver->setDefaults(array(
            // avoid to pass the csrf token in the url (but it's not protected anymore)
            'csrf_protection' => false,
            'data_class' => 'Application\AnnuaireBundle\Model\UserSearch'
        ));
    }
    public function getBlockPrefix()
    {
        return 'user_search_type';
    }

    public function lstPromotions() {
        $result;

        for ($i = 1995 ; $i <= date('Y')+2 ; $i++) {
            $result["".$i] = $i;
        }
        return $result;
    }
}