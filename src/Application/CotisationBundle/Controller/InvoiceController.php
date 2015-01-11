<?php

namespace Application\CotisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\CotisationBundle\Entity\Invoice;
use Application\CotisationBundle\Manager\InvoiceManager;

class InvoiceController extends Controller
{
    public function getAction($id) {
        // Il faut vérifier que le mec puisse pas afficher la facture 
        // de quelqu'un d'autre !!
        $invoice = $this->getDoctrine()
            ->getRepository('ApplicationCotisationBundle:Invoice')
            ->find($id);

        if (!$invoice) {
            throw $this->createNotFoundException(
                'No invoice found for id '.$id
            );
        }

        return $this->render('ApplicationCotisationBundle:Default:invoice.html.twig', array(
            "invoice" => $invoice,
        ));
    }
}
