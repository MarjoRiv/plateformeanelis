<?php

namespace Application\CotisationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TypeCotisationAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'Descriptif'))
            ->add('price', null, array('label' => 'Prix'))
            ->add('yearCotisation', null, array('label' => 'Année de Cotisation'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name', null, array('label' => 'Descriptif'))
            ->add('price', null, array('label' => 'Prix'))
            ->add('yearCotisation', null, array('label' => 'Année de Cotisation'))
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
            ->add('name', null, array('label' => 'Descriptif'))
            ->add('price', null, array('label' => 'Prix'))
            ->add('yearCotisation', null, array('label' => 'Année de Cotisation'))

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name', null, array('label' => 'Descriptif'))
            ->add('price', null, array('label' => 'Prix'))
            ->add('yearCotisation', null, array('label' => 'Année de Cotisation'))

        ;
    }
}
