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

    public function relancerAction($id) {

        $cotisation = $this->getDoctrine()->getRepository('ApplicationCotisationBundle:Cotisation')->find($id);
        if (!$cotisation) {
            return $this->redirect($this->getRequest()->headers->get('referer'));   
        }

        $username = $cotisation->getUser()->getUsername();
        $surname = $cotisation->getUser()->getSurname();
        $annee = $cotisation->getYear();
        $email = $cotisation->getUser()->getEmail();

        $this->get ( 'session' )->getFlashBag ()->add ( 'success', 'Cotisation pour l\'utilisateur '. $username .' relancé par email.');
        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()
            ->setSubject('ANELIS - Facture '. $id .' en attente de paiement')
            ->setFrom('mailing@anelis.org')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'Emails/invoice_waiting.html.twig',
                    array(
                        'surname' => $surname,
                        'idfacture' => $id,
                        'annee' => $annee
                    )
                ),
                'text/html'
            )
        ;
        $mailer->send($message);

        return $this->redirect($this->getRequest()->headers->get('referer'));
    }
}
