<?php

namespace Application\CotisationBundle\Admin;

use Application\CotisationBundle\Entity\TypeCotisation;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CotisationAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('payed', null, array('label' => 'Payé ?'))
            ->add('user', null, array('label' => 'Utilisateur'))
            ->add('typeCotisation', null, array('label' => 'Date et Type de Cotisation'))
            ->add('typeCotisation.price', null, array('label' => 'Prix'))

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('year', 'datetime', array('format' => 'Y','label' => 'Année'))
            ->add('payed', null, array('label' => 'Payé ?'))
            ->add('user', null, array('label' => 'Utilisateur'))
            ->add('typeCotisation', null, array('label' => 'Date et Type de Cotisation'))
            ->add('typeCotisation.price', null, array('label' => 'Prix'))
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'entity_board' => array('template' => 'ApplicationCotisationBundle:Admin/CRUD:relancer_button.html.twig')
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('year', null, array('label' => 'Année de Cotisation'))
            ->add('payed', null, array('label' => 'Payé ?'))
            ->add('user', null, array('label' => 'Utilisateur'))
            ->add('typeCotisation', null,array(
                'sortable' => 'typeCotisation',
                'label' => 'Date et Type de Cotisation'
            ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('year', 'datetime', array('format' => 'Y','label' => 'Année'))
            ->add('payed', null, array('label' => 'Payé ?'))
            ->add('user', null, array('label' => 'Utilisateur'))
            ->add('typeCotisation', null, array('label' => 'Date et Type de Cotisation'))
            ->add('typeCotisation.price', null, array('label' => 'Prix'))
        ;
    }
}
