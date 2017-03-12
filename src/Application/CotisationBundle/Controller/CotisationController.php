<?php

namespace Application\CotisationBundle\Controller;

use Admin\UserBundle\Entity\User;
use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Form\CotisationHandler;
use Application\CotisationBundle\Form\CotisationType;
use Application\CotisationBundle\Manager\CotisationManager;
use Application\CotisationBundle\Manager\InvoiceManager;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CotisationController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $yearCotis = $em->getRepository('ApplicationCotisationBundle:YearCotisation')->findAll();
        $cotisOK = array();
        $cotisDispo = array();


        foreach($this->getUser()->getCotisations() as $cotisation)          //Récupération des années de cotisation
        {
            $date = intval($cotisation->getYear()->format('Y'));            //Année courante

            //On récupère seulement si l'année de cotisation n'est pas passée.
            if($date >= intval(date("Y")))
            {
                $cotisOK[] = $cotisation->getYear()->format('Y');
            }
        }

        foreach($yearCotis as $cotisation)
        {
            $date = intval($cotisation->getYear()->format('Y'));

            //  Si l'année de cotisation n'est pas passée, que l'utilisateur n'a pas cotisé cette année là et que
            //  la cotisation pour cette année est ouverte
            if(!in_array($date, $cotisOK) && $date >= intval(date("Y")) && new DateTime() >= $cotisation->getDateEnabled())
            {
                $cotisDispo[] = $cotisation->getYear()->format('Y');
            }
        }

        return $this->render('ApplicationCotisationBundle:Default:index.html.twig', array(
            "yearCotis" => $yearCotis,
            "cotisDispo" => $cotisDispo, //Ici on envoi à la vue les années à afficher.
            "cotisOK" =>$cotisOK
        ));
    }

    public function addAction(Request $request) {
        $invoiceManager = new InvoiceManager($this);
        $cotisation = new Cotisation();
        $cotisation->setUser($this->get('security.token_storage')->getToken()->getUser());
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CotisationType::class, $cotisation);
        $formHandler = new CotisationHandler($form, $request, $em, $invoiceManager);
            
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

        if ($cotisation->getUser() == $this->get('security.token_storage')->getToken()->getUser() && !$cotisation->getInvoice()->getPayed()) {
            $managerInvoice = new InvoiceManager($this);
            $managerInvoice->remove($cotisation->getInvoice());

            $managerCotisation = new CotisationManager($this);
            $managerCotisation->remove($cotisation);

            $managerInvoice->flush();
            $managerCotisation->flush();   
        }
        
        return $this->redirect($this->generateUrl('application_cotisation_homepage'));
    }

    public function relancerAction(Request $request, $id) {

        $cotisation = $this->getDoctrine()->getRepository('ApplicationCotisationBundle:Cotisation')->find($id);
        if (!$cotisation) {
            return $this->redirect($request->headers->get('referer'));   
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

        return $this->redirect($request->headers->get('referer'));
    }
}
