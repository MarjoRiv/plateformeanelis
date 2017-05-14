<?php

namespace Application\CotisationBundle\Controller;

use Admin\UserBundle\Entity\User;
use Application\CotisationBundle\ApplicationCotisationBundle;
use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Entity\EnumTypePaiement;
use Application\CotisationBundle\Entity\TypeCotisation;
use Application\CotisationBundle\Form\CotisationHandler;
use Application\CotisationBundle\Form\CotisationType;
use Application\CotisationBundle\Manager\CotisationManager;
use Application\CotisationBundle\Manager\InvoiceManager;
use DateTime;
use JMS\Payment\CoreBundle\Entity\ExtendedData;
use JMS\Payment\CoreBundle\Entity\FinancialTransaction;
use JMS\Payment\CoreBundle\Entity\Payment;
use JMS\Payment\CoreBundle\Entity\PaymentInstruction;
use JMS\Payment\CoreBundle\Exception\Exception;
use JMS\Payment\CoreBundle\Form\ChoosePaymentMethodType;
use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;
use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use JMS\Payment\CoreBundle\PluginController\Result;
use JMS\Payment\PaypalBundle\JMSPaymentPaypalBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;




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
        $paypalForms = array();


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

                $cotisation->setPricecotisation($yearCotisation->getMinAmount());
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
            else if (in_array($date, $dateCotisEnAttente) && !in_array($date, $cotisOK) && $date >= intval(date("Y"))
                   && new DateTime() >= $yearCotisation->getDateEnabled())
            {
                $config = [
                    'paypal_express_checkout' => [
                        'return_url' => $this->generateUrl('application_cotisation_payer_paypal', ['year' => $yearCotisation->getYear()], UrlGeneratorInterface::ABSOLUTE_URL),
                        'cancel_url' => $this->generateUrl('application_cotisation_homepage', array(), UrlGeneratorInterface::ABSOLUTE_URL),
                        'useraction' => 'commit',
                    ],
                ];

                $paypalForm = $this->get('form.factory')->createNamedBuilder('paypalForm'.$yearCotisation->getId(),
                                                        ChoosePaymentMethodType::class, null, [
                    'amount'   => $this->getUser()->getCotisationByYear($yearCotisation->getYear())
                        ->getPriceCotisation(),
                    'currency' => 'EUR',
                    'predefined_data' => $config,
                ])->getForm();

                $paypalForm->handleRequest($request);

                if($paypalForm->isSubmitted() && $paypalForm->isValid()) {
                    $ppc = $this->get('payment.plugin_controller');
                    $ppc->createPaymentInstruction($instruction = $paypalForm->getData());

                    $cotisation = $this->getUser()->getCotisationByYear($yearCotisation->getYear());
                    $cotisation->setPaymentInstruction($instruction);
                    $em->persist($cotisation);
                    $em->flush($cotisation);
                    dump($yearCotisation->getYear());
                    return $this->redirect($this->generateUrl('application_cotisation_payer_paypal', ['year' =>
                    $yearCotisation->getYear()]));
                }

                $paypalForms[$yearCotisation->getYear()] = $paypalForm->createView();
            }

        }
        return $this->render('ApplicationCotisationBundle:Default:index.html.twig', array(
            "cotisDispo"   => $cotisDispo, //Ici on envoi à la vue les années à afficher.
            "cotisOK"      => $cotisOK,
            "cotisAttente" => $cotisEnAttente,
            "forms"        => $returnForms,
            "paypalForms"  => $paypalForms
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


    /**
     * @param Request $request
     * @param $year
     * @return mixed
     *
     * Action particulière de paiement.
     * Appellée une première fois pour lancer la transaction et rediriger vers paypal.
     * Au retour du site, si Paypal réussi la transaction, l'utilisateur est renvoyé sur cette action qui vérifie
     * auprès du service de paiement si la transaction est réussie. Si c'est le cas la cotisation est validée
     * automatiquement. Dans le cas contraire, une pop-up invitant à envoyer un mail à l'Anelis est affichée.
     */
    public function createPaymentAction(Request $request, $year)
    {
        $em = $this->getDoctrine()->getManager();
        $ppc = $this->get('payment.plugin_controller');

        $user = $this->getUser();

        $yearCotisation = $em->getRepository('ApplicationCotisationBundle:YearCotisation')->findOneBy(
            array('year' => $year)
        );

        $cotis = $em->getRepository('ApplicationCotisationBundle:Cotisation')->findOneBy(
            array('user' => $user, 'yearCotisation' => $yearCotisation)
        );

        $payment = $this->createPayment($cotis->getPaymentInstruction());
        $result = $ppc->approveAndDeposit($payment->getId(), $payment->getTargetAmount());

         if ($result->getStatus() === Result::STATUS_PENDING) { //Statut en attente : on redirige vers Paypal

             $ex = $result->getPluginException();
             if ($ex instanceof ActionRequiredException) {
                 $action = $ex->getAction();
                 if ($action instanceof VisitUrl) {
                     return $this->redirect($action->getUrl());
                }
            }
         }
         else if ($result->getStatus() !== Result::STATUS_SUCCESS) //Erreur, on renvoi l'utilisateur vers la page
             // avec une popup
         {
             //TODO : Passer le message dans la table STATIC_TEXT
             $message='Le paiement n\'a pas abouti, veuillez contacter l\'Anelis pour plus d\'informations';
             echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
             return $this->redirect($this->generateUrl('application_cotisation_homepage'));
         }

         //Si la transaction a réussie, la cotisation est validée !
         $cotis->setPayed(true);
         $cotis->setPaymentType(EnumTypePaiement::PAYPAL);
         $em->persist($cotis);
         $em->flush($cotis);
         return $this->redirect($this->generateUrl('application_cotisation_homepage'));
    }

    private function createPayment($instruction) {
        $pendingTransaction = $instruction->getPendingTransaction();

        if ($pendingTransaction !== null) {
            return $pendingTransaction->getPayment();
        }

        $ppc = $this->get('payment.plugin_controller');

        return $ppc->createPayment($instruction->getId(), $instruction->getAmount() - $instruction->getDepositedAmount());
    }
}
