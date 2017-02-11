<?php

namespace Application\OffreBundle\Controller;

use Application\OffreBundle\Form\OffersType;
use Application\OffreBundle\Entity\Offers;
use Application\OffreBundle\Entity\UserOffre;
use Admin\UserBundle\Entity\User;
use Application\OffreBundle\Manager\OffersManager;
use Application\OffreBundle\Manager\UserOffreManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OffreController extends Controller
{

    public function showAction(Offers $offre)
    {
        if ($this->getUser()==$offre->getUser()->getUserApp())
        {
            $usercreation = true;
        }
        else
        {
            $usercreation = false;
            $offre->setReading($offre->getReading()+1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();
        }
        return $this->render('OffreBundle:Offre:show.html.twig', array(
            'offre' => $offre,
            'usercreation' => $usercreation));
    }

    public function editAction(Offers $offre, Request $request) {
        
        if ($offre->getUser()->getUserApp()==$this->getUser())
        {
            $OffersForm = $this->get('form.factory')
                ->createNamed(
                    '',
                    OffersType::class,
                    $offre,
                    array(
                        'action' => $this->generateUrl('offre_edit', array('id'=>$offre->getId())),
                        'method' => 'POST'
                    )
                );

            $OffersForm->handleRequest($request);
            
            if ($OffersForm->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($offre);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', "L'offre a été modifié.");
            }
        }
        else
        {
            return $this->redirect($this->generateUrl('offre_show', array('id' => $offre->getId())));
        }
        // Vérification de l'id pour des raisons de sécurités
        
        return $this->render('OffreBundle:Offre:offre.edit.html.twig', array(
                "form" => $OffersForm->createView(),
                "offre" => $offre,
        ));
        
    }

}
