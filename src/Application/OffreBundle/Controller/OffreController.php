<?php

namespace Application\OffreBundle\Controller;

use Application\OffreBundle\Form\OffersType;
use Application\OffreBundle\Form\Offers2Type;
use Application\OffreBundle\Entity\Offers;
use Application\OffreBundle\Entity\UserOffre;
use Application\OffreBundle\Entity\FileOffre;
use Admin\UserBundle\Entity\User;
use Application\OffreBundle\Manager\OffersManager;
use Application\OffreBundle\Manager\UserOffreManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OffreController extends Controller
{

    public function addAction(Request $request)
    {
        $offer = new Offers();
        $userOffre=$this->UserOffreCreat();

        $OffersForm = $this->get('form.factory')
            ->createNamed(
                '',
                OffersType::class,
                $offer,
                array(
                    'action' => $this->generateUrl('offre_homepage'),
                    'method' => 'POST'
                )
            );
        $OffersForm->handleRequest($request);
        $offer->setUser($userOffre);
        $formSubmited = false;
        $autorize= $userOffre->getAutorized();
        if ($autorize==true)
        {
            if ($OffersForm->isValid()) 
            {
                $prop=$userOffre->getNbpropfait();
                if ($prop<($userOffre->getNbpropMax()))
                {
                    $userOffre->setNbpropfait($prop+1);
                    $offer->getAttachement()->upload();
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($userOffre);
                    $em->persist($offer);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                    $formSubmited = true;
                }
                else
                {
                    $request->getSession()->getFlashBag()->add('notice', 'Trop d\'annonce publiée, contactez l\'administrateur pour en avoir plus.');
                }
            }
        }
        return $this->render('OffreBundle:Offre:add.html.twig',array(
            'autorize' => $autorize,
            'form' => $OffersForm->createView(),
            'formSubmited' => $formSubmited,
        ));
    }

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
        $formSubmited=false;
        $autorize=false;
        if ($offre->getUser()->getUserApp()==$this->getUser())
        {
            $OffersForm = $this->get('form.factory')
                ->createNamed(
                    '',
                    Offers2Type::class,
                    $offre,
                    array(
                        'action' => $this->generateUrl('offre_edit', array('id'=>$offre->getId())),
                        'method' => 'POST'
                    )
                );
            $autorize = $offre->getUser()->getAutorized();
            $OffersForm->handleRequest($request);
            
            if ($OffersForm->isValid()) 
            {   
                $formSubmited=true;
                $offre->getAttachement()->upload();
                $em = $this->getDoctrine()->getManager();
                $em->persist($offre);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', "L'offre a été modifié.");
            }
            return $this->render('OffreBundle:Offre:offre.edit.html.twig', array(
                        'autorize' => $autorize,
                        "form" => $OffersForm->createView(),
                        "offre" => $offre,
                        'formSubmited' => $formSubmited,
                ));
        }
        else
        {
            return $this->redirect($this->generateUrl('offre_show', array('id' => $offre->getId())));
        }
        // Vérification de l'id pour des raisons de sécurités 
    }

    protected function UserOffreCreat()
    {
        $em2 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\UserOffre')->createQueryBuilder('u');
        $userOffre=null;
        $query=$em2->getQuery()->getResult();
        foreach ($query as $emm ) 
        {
            if ($emm->getUserApp()==$this->getUser())
            {
                $userOffre=$emm;
            }
        }
        if ($userOffre==null)
        {
            $userOffre = new UserOffre($this->getUser()->getId());
            $userOffre->setNbpropmax(3);
            $userOffre->setUserApp($this->getUser());
            $em1 = $this->getDoctrine()->getManager();
            $em1->persist($userOffre);
            $em1->flush();
        }
        return $userOffre;
    }

}
