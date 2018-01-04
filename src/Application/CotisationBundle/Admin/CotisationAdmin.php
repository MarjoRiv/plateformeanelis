<?php

namespace Application\CotisationBundle\Admin;

use Application\CotisationBundle\Entity\EnumTypePaiement;
use Application\CotisationBundle\Entity\TypeCotisation;
use Application\CotisationBundle\Entity\YearCotisation;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Sonata\AdminBundle\Show\ShowMapper;

class CotisationAdmin extends AbstractAdmin {


    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'datePaiement',
    );
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('id', null, array('label' => 'Id'))
            ->add('user', null, array('label' => 'Utilisateur'))
            ->add('payed', null, array('label' => 'Payée ?'))
            ->add('pricecotisation', null, array('label' => 'Prix Payé'))
            ->add('yearCotisation', null, array('label' => 'Année de Cotisation'))
            ->add('paymentType', null, array(), 'choice', array('label' => 'Type de Paiement', 'choices' =>
                EnumTypePaiement::getValuesFromLabel()))
            ->add('datePaiement', null, array('label' => 'Date de Paiement'));
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('id')
            ->add('user', null, array('label' => 'Utilisateur'))
            ->add('yearcotisation', null, array('label' => 'Année'))
            ->add('pricecotisation', null, array('label' => 'Prix Payé'))
            ->add('payed', null, array('label' => 'Payée ?'))
            ->add('paymentType', 'choice', array('label' => 'Type de Paiement', 'choices' =>
                EnumTypePaiement::getLabelsFromValues()))
            ->add('datePaiement', null, array('label' => 'Date de Paiement'))
            ->add('_action', null, array(
                'actions' => array(
                    'show'         => array(),
                    'edit'         => array(),
                    'entity_board' => array('template' => 'ApplicationCotisationBundle:Admin/CRUD:relancer_button.html.twig'),
                ),
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('user', null, array('label' => 'Utilisateur'))
            ->add('yearCotisation', null, array('label' => 'Année'))
            ->add('pricecotisation', null, array('label' => 'Prix Payé'))
            ->add('payed', null, array('label' => 'Payée ?'))
            ->add('datePaiement', null, array('label' => 'Date de Paiement'))
            ->add('paymentType', 'choice', array('label' => 'Type de Paiement', 'choices' => EnumTypePaiement::getValuesFromLabel()));
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('user', null, array('label' => 'Utilisateur'))
            ->add('yearcotisation', null, array('label' => 'Année'))
            ->add('pricecotisation', null, array('label' => 'Prix Payé'))
            ->add('payed', null, array('label' => 'Payée ?'))
            ->add('datePaiement', null, array('label' => 'Date de Paiement'))
            ->add('paymentType', 'choice', array('label' => 'Type de Paiement', 'choices' =>
                EnumTypePaiement::getLabelsFromValues()));
    }
}
