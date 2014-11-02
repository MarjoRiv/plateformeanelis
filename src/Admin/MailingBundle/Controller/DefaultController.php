<?php
namespace Admin\MailingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Admin\MailingBundle\Entity\MailingList;
use Admin\MailingBundle\Manager\MailingListManager;
use Admin\MailingBundle\Form\MailingListType;
use Admin\MailingBundle\Form\MailingListHandler;
use Application\MainBundle\Manager\LogManager;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $mailingLists = $this->getDoctrine ()->getRepository ( 'AdminMailingBundle:MailingList' )->findAll();
        return $this->render('AdminMailingBundle:Default:index.html.twig', array(
            'mailingLists' => $mailingLists
        ));
    }

     /**
     * Permet d'ajouter une ML
     */
     // @Secure(roles = "ROLE_ADMIN_MAILINGLIST_ADD")
     //*/
    public function addAction() {
        $mailing = new MailingList ();
        $em = new MailingListManager ( $this );
        
        $form = $this->createForm ( new MailingListType(), $mailing );
        $handler = new MailingListHandler ( $form, $this->getRequest (), $em );
        
        if ($handler->process ()) {
            LogManager::save ( $this, "Ajout d'une mailing liste, id : " . $mailing->getId () );
            //$this->get('session')->getFlashBag()->add('success', 'Le bloc d\'mailing a été ajouté');
            return $this->redirect ( $this->generateUrl ( 'admin_mailing_homepage' ) );
        } else {
            return $this->render ( 'AdminMailingBundle:MailingList:add.html.twig', array (
                    'form' => $form->createView(), 
            ) );
        }
    }
    
    /**
     * Permet d'éditer une ML
     */ 
     //* @Secure(roles = "ROLE_ADMIN_MAILINGLIST_EDIT")
     //*/
    public function editAction(MailingList $mailing) {
        $em = new MailingListManager($this);
        
        $form = $this->createForm(new MailingListType(), $mailing);
        $handler = new MailingListHandler($form, $this->getRequest(), $em);
        
        if($handler->process()){
            LogManager::save($this, "[MailingList] Modification de la mailing liste ".$mailing->getName(). " , id : ".$mailing->getId());
            //$this->get('session')->getFlashBag()->add('success', 'Le bloc d\'mailing a été édité , id : '.$mailing->getId().' , idUser : '.$this->getUser()->getId());
            return $this->redirect($this->generateUrl('admin_mailing_homepage'));
        }
        return $this->render('AdminMailingBundle:MailingList:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Permet de supprimer une ML
     */ 
     //* @Secure(roles = "ROLE_ADMIN_MAILINGLIST_DELETE")
     //*/
    public function deleteAction(MailingList $mailing) {
        $em = new MailingListManager($this);
        
        $em->remove($mailing);
        $em->flush();
        
        LogManager::save($this, "[MailingList] Suppression de la mailing liste id : ".$mailing->getId());
        //$this->get('session')->getFlashBag()->add('success', 'Le bloc d\'mailing a été supprimé');
        
        return $this->redirect($this->generateUrl('admin_mailing_homepage'));
    }
}
