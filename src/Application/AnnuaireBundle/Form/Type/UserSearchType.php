<?php
namespace Application\AnnuaireBundle\Form\Type;
use Application\AnnuaireBundle\Model\UserSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class UserSearchType extends AbstractType
{
    protected $perPage = 5;
    protected $perPageChoices = array(2,5,10);
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // the perPage choices list is hard coded. In a real project, you won't do like that
        $perPageChoices = array();
        foreach($this->perPageChoices as $choice){
            $perPageChoices[$choice] = 'Display '.$choice.' items';
        }
        $builder
            ->add('name', 'text', array(
                'required' => false,
            ))
            ->add('surname', 'text', array(
                'required' => false,
            ))
            ->add('filiere', 'choice', array(
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
            ->add('promotion', 'choice', array(
                'choices' => $this->lstPromotions(),
                'required'  => false,
            ))
        ;
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
        $resolver->setDefaults(array(
            // avoid to pass the csrf token in the url (but it's not protected anymore)
            'csrf_protection' => false,
            'data_class' => 'Application\AnnuaireBundle\Model\UserSearch'
        ));
    }
    public function getName()
    {
        return 'user_search_type';
    }

    public function lstPromotions() {
        $result;

        for ($i = 1995 ; $i <= date('Y') ; $i++) {
            $result["".$i] = $i;
        }
        return $result;
    }
}