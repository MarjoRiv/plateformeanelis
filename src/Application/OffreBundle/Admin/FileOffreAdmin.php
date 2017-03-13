<?php

namespace Application\OffreBundle\Admin;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FileOffreAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('filename')
            ->add('path')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('filename')
            ->add('path')
            ->add('file','file')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
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
            ->add('filename')
            ->add('path')
            ->add('file','file', array(
                'required' => false
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
            ->add('filename')
            ->add('path')
        ;
    }

    public function prePersist($file) 
    {
        $this->manageFileUpload($file);
    }

    public function preUpdate($file) 
    {
        $this->manageFileUpload($file);
    }

    private function manageFileUpload($file) 
    {
        if ($file->getFile()) {
            $file->refreshUpdated();
        }
    }

}
