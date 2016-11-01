<?php

namespace Admin\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\UserBundle\Entity\StaticText;
use Admin\UserBundle\Form\StaticTextType;

/**
 * StaticText controller.
 *
 */
class StaticTextController extends Controller
{

    /**
     * Lists all StaticText entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminUserBundle:StaticText')->findAll();

        return $this->render('AdminUserBundle:StaticText:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new StaticText entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new StaticText();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('statictext_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminUserBundle:StaticText:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a StaticText entity.
     *
     * @param StaticText $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(StaticText $entity)
    {
        $form = $this->createForm(new StaticTextType(), $entity, array(
            'action' => $this->generateUrl('statictext_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new StaticText entity.
     *
     */
    public function newAction()
    {
        $entity = new StaticText();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminUserBundle:StaticText:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a StaticText entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminUserBundle:StaticText')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StaticText entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminUserBundle:StaticText:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing StaticText entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminUserBundle:StaticText')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StaticText entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminUserBundle:StaticText:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a StaticText entity.
    *
    * @param StaticText $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(StaticText $entity)
    {
        $form = $this->createForm(new StaticTextType(), $entity, array(
            'action' => $this->generateUrl('statictext_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing StaticText entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminUserBundle:StaticText')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StaticText entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('statictext_edit', array('id' => $id)));
        }

        return $this->render('AdminUserBundle:StaticText:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a StaticText entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminUserBundle:StaticText')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StaticText entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('statictext'));
    }

    /**
     * Creates a form to delete a StaticText entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('statictext_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
