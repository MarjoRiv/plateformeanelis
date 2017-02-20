<?php

namespace Application\OffreBundle\Controller;

use Application\OffreBundle\Form\OffersType;
use Application\OffreBundle\Form\Offers2Type;
use Application\OffreBundle\Entity\Offers;
use Application\OffreBundle\Entity\UserOffre;
use Application\OffreBundle\Entity\FileOffre;
use Application\OffreBundle\Entity\OffreVar;
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
                    'action' => $this->generateUrl('offre_add'),
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
                    $em3 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\OffreVar')->createQueryBuilder('v');
                    $dureemax = ($em3->where('v.name = :name')->setParameter('name', "dureeOffre(jour)")->getQuery()->getResult())[0];
                    $offer->setDateexpire($offer->getDateexpire()->modify((($dureemax->getVariable())-30)." day"));
                    $userOffre->setNbpropfait($prop+1);
                    if ($offer->getAttachement()!=null)
                    {
                        $offer->getAttachement()->preUpload();
                    }
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($userOffre);
                    $em->persist($offer);
                    $em->flush();
                    if ($offer->getAttachement()!=null)
                    {
                        $offer->getAttachement()->upload();
                    }
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($offer);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                    $formSubmited = true;
                    return $this->render('OffreBundle:Offre:show.html.twig',array(
                        'offre' => $offer,
                        'usercreation' => true,
                    ));
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
        $userOffre = null;
        $userOffre = ($em2->where('u.UserApp = :user')->setParameter('user', $this->getUser())->getQuery()->getResult());
        if ($userOffre==null)
        {
            $userOffre = new UserOffre($this->getUser()->getId());
            $userOffre->setUserApp($this->getUser());
        }
        else
        {
            $userOffre = $userOffre[0];
        }
        $em3 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\OffreVar')->createQueryBuilder('v');
        if ($userOffre->getUserApp()->isCotisant())
        {
            $name = "nbOffresCotisants";
        }
        else
        {
            $name = "nbOffresNonCotisants";
        }
        $varoffre = ($em3->where('v.name = :name')->setParameter('name', $name)->getQuery()->getResult())[0];
        $nbactuel = $userOffre->getNbpropMax();
        if (($nbactuel == null) or ($nbactuel<($varoffre->getVariable())))
        {
            $userOffre->setNbpropmax($varoffre->getVariable());
        }
        $em1 = $this->getDoctrine()->getManager();
        $em1->persist($userOffre);
        $em1->flush();
        return $userOffre;
    }

}
