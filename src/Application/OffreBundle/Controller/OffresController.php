<?php

namespace Application\OffreBundle\Controller;

use Application\OffreBundle\Form\OffersType;
use Application\OffreBundle\Form\OffersHandler;
use Application\OffreBundle\Entity\Offers;
use Application\OffreBundle\Entity\UserOffre;
use Admin\UserBundle\Entity\User;
use Application\OffreBundle\Manager\OffersManager;
use Application\OffreBundle\Manager\UserOffreManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class OffresController extends Controller
{
    public function viewAction(Request $request)
    {
    	$em1 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\Offers');
    	$em2 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\UserOffre');
    	$em3 = $this->getDoctrine()->getManager()->getRepository('Admin\UserBundle\Entity\User');

    	$offer = new Offers();

    	$OffersForm = $this->get('form.factory')
            ->createNamed(
                '',
                OffersType::class,
                $offer,
                array(
                    'action' => $this->generateUrl('offre_homepage'),
                    'method' => 'GET'
                )
            );
        $OffersForm->handleRequest($request);

        $results = null;
        $formSubmited = false;

        if ($OffersForm->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();
        }

        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

    	$onglet=1;
        return $this->render('OffreBundle:Default:index.html.twig',array(
            'onglet' => $onglet,
            'form' => $OffersForm->createView(),
            'formSubmited' => $formSubmited,
        ));
    }

    


}