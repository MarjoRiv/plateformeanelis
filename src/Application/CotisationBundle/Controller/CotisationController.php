<?php

namespace Application\CotisationBundle\Controller;

use Admin\UserBundle\Entity\User;
use Application\CotisationBundle\ApplicationCotisationBundle;
use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Entity\TypeCotisation;
use Application\CotisationBundle\Form\CotisationHandler;
use Application\CotisationBundle\Form\CotisationType;
use Application\CotisationBundle\Manager\CotisationManager;
use Application\CotisationBundle\Manager\InvoiceManager;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CotisationController extends Controller {
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $yearCotis = $em->getRepository('ApplicationCotisationBundle:YearCotisation')->findAll();
        $cotisOK = array();
        $cotisDispo = array();
        $cotisEnAttente = array();
        $dateCotisEnAttente = array();
        $returnForms = array();                                             //L'ensemble des formulaires de retour

        foreach ($this->getUser()->getCotisations() as $cotisation)          //Récupération des années de cotisation
        {
            $date = intval($cotisation->getYearCotisation()->getYear());            //Année courante
            //On récupère seulement si l'année de cotisation n'est pas passée.
            if ($date >= intval(date("Y"))) {
                if ($cotisation->isPayed()) {                              //Si la cotisation a bien été payée
                    $cotisOK[] = $cotisation->getYearCotisation()->getYear();
                } else {                                                    //Si le paiement est en attente
                    $cotisEnAttente[] = $cotisation;
                    $dateCotisEnAttente[] = $date;
                }
            }
        }

        $cotisation = new Cotisation();
        $cotisation->setUser($this->get('security.token_storage')->getToken()->getUser());

        foreach ($yearCotis as $yearCotisation) {

            $date = $yearCotisation->getYear();
            if (!in_array($date, $dateCotisEnAttente) && !in_array($date, $cotisOK) && $date >= intval(date("Y")) && new DateTime() >= $yearCotisation->getDateEnabled()) {
                $cotisDispo[] = $date;

                $returnCotisationForm = $this->get('form.factory')->createNamedBuilder('cotis_form_' . $yearCotisation->getId(), CotisationType::class, $cotisation,['choices' => $yearCotisation, 'formId' => $yearCotisation->getId()])->getForm();

                if ($request->request->get('cotis_form_' . $yearCotisation->getId()) != null) //Récupération du bon formulaire envoyé
                {
                    $cotisation->setYearCotisation($yearCotisation);


                    $formHandler = new CotisationHandler($returnCotisationForm, $request, $em);
                    if ($formHandler->process()) {
                        return $this->redirect($this->generateUrl('application_cotisation_homepage'));
                    }
                }

                $returnForms[] = $returnCotisationForm->createView();
            }

        }
        return $this->render('ApplicationCotisationBundle:Default:index.html.twig', array(
            "cotisDispo"   => $cotisDispo, //Ici on envoi à la vue les années à afficher.
            "cotisOK"      => $cotisOK,
            "cotisAttente" => $cotisEnAttente,
            "forms"        => $returnForms,
        ));

    }


    /*
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
    }*/

    public function deleteAction(Cotisation $cotisation) {

        if ($cotisation->getUser() == $this->get('security.token_storage')->getToken()->getUser() && !$cotisation->isPayed()) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($cotisation);

            $em->flush();
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

        //TODO : A tester, c'est peut être pété ici

        $this->get('session')->getFlashBag()->add('success', 'Cotisation pour l\'utilisateur ' . $username . ' relancé par email.');
        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()
            ->setSubject('ANELIS - Facture ' . $id . ' en attente de paiement')
            ->setFrom('mailing@anelis.org')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'Emails/invoice_waiting.html.twig',
                    array(
                        'surname'   => $surname,
                        'idfacture' => $id,
                        'annee'     => $annee,
                    )
                ),
                'text/html'
            );
        $mailer->send($message);

        return $this->redirect($request->headers->get('referer'));
    }
}
