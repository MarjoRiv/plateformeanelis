<?php

namespace Application\CotisationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class YearCotisationAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('year', null, array('label' => 'Année de Cotisation'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('year', null, array('label' => 'Année de Cotisation'))
            ->add('promoReduiteMax', null, array('label' => 'Promo Tarif Réduit Max'))
            ->add('dateEnabled', null, array('label' => 'Date d\'activation'))
            ->add('minAmount', null, array('label' => 'Montant Minimum'))
            ->add('reducedFeeAmount', null, array('label' => 'Tarif Réduit'))
            ->add('proposedAmount1', null, array('label' => 'Montant Proposé 1'))
            ->add('proposedAmount2', null, array('label' => 'Montant Proposé 2'))
            ->add('proposedAmount3', null, array('label' => 'Montant Proposé 3'))
            ->add('proposedAmount4', null, array('label' => 'Montant Proposé 4'))

            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        //FIXME : Erreur si l'année de cotisation existe déjà.
        $formMapper
            ->add('year', null, array('label' => 'Année de Cotisation'))
            ->add('promoReduiteMax', null, array('label' => 'Promo Tarif Réduit Max'))
            ->add('dateEnabled', null, array('label' => 'Date d\'activation'))
            ->add('minAmount', null, array('label' => 'Montant Minimum'))
            ->add('reducedFeeAmount', null, array('label' => 'Tarif Réduit'))
            ->add('proposedAmount1', null, array('label' => 'Montant Proposé 1'))
            ->add('proposedAmount2', null, array('label' => 'Montant Proposé 2'))
            ->add('proposedAmount3', null, array('label' => 'Montant Proposé 3'))
            ->add('proposedAmount4', null, array('label' => 'Montant Proposé 4'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('year', null, array('label' => 'Année de Cotisation'))
            ->add('promoReduiteMax', null, array('label' => 'Promo Tarif Réduit Max'))
            ->add('dateEnabled', null, array('label' => 'Date d\'activation'))
            ->add('minAmount', null, array('label' => 'Montant Minimum'))
            ->add('reducedFeeAmount', null, array('label' => 'Tarif Réduit'))
            ->add('proposedAmount1', null, array('label' => 'Montant Proposé 1'))
            ->add('proposedAmount2', null, array('label' => 'Montant Proposé 2'))
            ->add('proposedAmount3', null, array('label' => 'Montant Proposé 3'))
            ->add('proposedAmount4', null, array('label' => 'Montant Proposé 4'))
        ;
    }
}
