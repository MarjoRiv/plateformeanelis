<?php

namespace Application\OffreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class OffresController extends Controller
{
    public function viewAction()
    {
    	$em1 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\Offers');
    	$em2 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\UserOffre');
    	$em3 = $this->getDoctrine()->getManager()->getRepository('Admin\UserBundle\Entity\User');

    	


    	$onglet=1;
        return $this->render('OffreBundle:Default:index.html.twig',array(
            'onglet' => $onglet,
        ));
    }
}