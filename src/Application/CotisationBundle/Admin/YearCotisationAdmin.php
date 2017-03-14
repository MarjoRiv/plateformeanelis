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
            ->add('name', null, array('label' => 'Année de Cotisation'))
            ->add('dateEnabled')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('year', 'datetime', array('format' => 'Y',
            'label' => 'Année de Cotisation'))
            ->add('dateEnabled', null, array('label' => 'Date d\'activation'))
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
        $formMapper
            ->add('year', null, array('label' => 'Date de départ Cotisation'))
            ->add('name', null, array('label' => 'Descriptif'))
            ->add('dateEnabled', null, array('label' => 'Date d\'activation'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('year', null, array('label' => 'Date de départ Cotisation'))
            ->add('dateEnabled', null, array('label' => 'Date d\'activation'))
        ;
    }
}
