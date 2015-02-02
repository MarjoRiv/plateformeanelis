<?php

namespace Application\CotisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\CotisationBundle\Entity\Invoice;
use Application\CotisationBundle\Manager\InvoiceManager;

class InvoiceController extends Controller
{
    public function getAction($id) {
        $invoice = $this->getDoctrine()
            ->getRepository('ApplicationCotisationBundle:Invoice')
            ->find($id);

        if (!$invoice || $invoice->getCotisation()->getUser() != $this->get('security.context')->getToken()->getUser()) {
            return $this->redirect($this->generateUrl('application_cotisation_homepage'));
        }

        return $this->render('ApplicationCotisationBundle:Default:invoice.html.twig', array(
            "invoice" => $invoice,
        ));
    }
}
