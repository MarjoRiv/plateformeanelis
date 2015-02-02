<?php

namespace Application\CotisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Manager\CotisationManager;
use Application\CotisationBundle\Manager\InvoiceManager;
use Application\CotisationBundle\Form\CotisationType;
use Application\CotisationBundle\Form\CotisationHandler;


class CotisationController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationCotisationBundle:Default:index.html.twig');
    }

    public function addAction() {
        $manager = new CotisationManager($this);
        $invoiceManager = new InvoiceManager($this);
        $cotisation = new Cotisation();
        $cotisation->setUser($this->get('security.context')->getToken()->getUser());
    
        $form = $this->createForm(new CotisationType(), $cotisation);
        $formHandler = new CotisationHandler($form, $this->get('request'), $manager, $invoiceManager);
            
        if ($formHandler->process()) {
            // Getting the last id invoice inserted 
            $repository = $this->getDoctrine()
                ->getRepository('ApplicationCotisationBundle:Invoice');
            $query = $repository->createQueryBuilder('p')
                ->orderBy('p.id', 'DESC')
                ->getQuery();

            $invoices = $query->getResult();
            $last_cotisation_id = $invoices[0]->getId();

            return $this->redirect($this->generateUrl('application_cotisation_invoice_get', array(
                'id' => $last_cotisation_id
               )));
        }
        else {
            return $this->render('ApplicationCotisationBundle:Default:add.html.twig', array(
                "form" => $form->createView(),
            ));
        }
    }

    public function deleteAction(Cotisation $cotisation) {

        if ($cotisation->getUser() == $this->get('security.context')->getToken()->getUser() && !$cotisation->getInvoice()->getPayed()) {
            $managerInvoice = new InvoiceManager($this);
            $managerInvoice->remove($cotisation->getInvoice());

            $managerCotisation = new CotisationManager($this);
            $managerCotisation->remove($cotisation);

            $managerInvoice->flush();
            $managerCotisation->flush();   
        }
        
        return $this->redirect($this->generateUrl('application_cotisation_homepage'));
    }
}
