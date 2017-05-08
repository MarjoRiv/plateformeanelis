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

    public function paypalPaymentSuccessAction(Request $request, $year, $instId)
    {

        //TODO : Quand on saura si Paypal fait bien son boulot, on pourra voir si il y a besoin de plus de
        // vérifications. Normalement avec ce système, l'utilisateur ne peux pas mettre la cotisation a payée en
        // passant par la route de l'action puisqu'il lui faut plusieurs infos stockées en base (et hashée).
        $em = $this->getDoctrine()->getManager();

        $instruction = $em->getRepository('JMSPaymentCoreBundle:PaymentInstruction')->findOneBy(
            array('id' => $instId)
        );

        if($instruction->getExtendedData()->get('express_checkout_token') == $request->query->get('token'))
        {
            $user = $this->getUser();

            $yearCotisation = $em->getRepository('ApplicationCotisationBundle:YearCotisation')->findOneBy(
                array('year' => $year)
            );

            $cotis = $em->getRepository('ApplicationCotisationBundle:Cotisation')->findOneBy(
                array('user' => $user, 'yearCotisation' => $yearCotisation)
            );

            $cotis->setPayed(true);
            $cotis->setPaymentType(EnumTypePaiement::PAYPAL);
            $em->flush();
            $em->persist($cotis);

        }

        return $this->redirect($this->generateUrl('application_cotisation_homepage'));

    }

    public function createPaymentAction(Request $request, $year)
    {
        $config = [
            'paypal_express_checkout' => [
                'return_url' => 'application_cotisation_homepage', UrlGeneratorInterface::ABSOLUTE_URL
            ],
        ];



        $em = $this->getDoctrine()->getManager();
        $ppc = $this->get('payment.plugin_controller');

        $user = $this->getUser();

        $yearCotisation = $em->getRepository('ApplicationCotisationBundle:YearCotisation')->findOneBy(
            array('year' => $year)
        );

        $cotis = $em->getRepository('ApplicationCotisationBundle:Cotisation')->findOneBy(
            array('user' => $user, 'yearCotisation' => $yearCotisation)
        );

        $instruction = new PaymentInstruction($cotis->getPricecotisation(),'EUR','paypal_express_checkout', new ExtendedData());


        $transaction = new FinancialTransaction();
        $transaction->setRequestedAmount($cotis->getPricecotisation());

         $ppc->createPaymentInstruction($instruction);
         $payment = $this->createPayment($instruction);
         $payment->addTransaction($transaction);

        $instruction->getExtendedData()->set('return_url', $this->generateUrl('application_cotisation_success_paypal', ['year' => $year, 'instId' => $instruction->getId()], UrlGeneratorInterface::ABSOLUTE_URL));
        $instruction->getExtendedData()->set('cancel_url', $this->generateUrl('application_cotisation_homepage', array(), UrlGeneratorInterface::ABSOLUTE_URL));
         $result = $ppc->approveAndDeposit($payment->getId(), $payment->getTargetAmount());
         if ($result->getStatus() === Result::STATUS_PENDING) {

             $ex = $result->getPluginException();
             if ($ex instanceof ActionRequiredException) {
                 $action = $ex->getAction();

                 if ($action instanceof VisitUrl) {
                     return $this->redirect($action->getUrl());
                }
            }
         }
        throw $result->getPluginException();
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
