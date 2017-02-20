<?php

namespace Application\OffreBundle\Controller;


use Application\OffreBundle\Form\FiltreViewType;
use Application\OffreBundle\Entity\Offers;
use Application\OffreBundle\Entity\UserOffre;
use Admin\UserBundle\Entity\User;
use Application\OffreBundle\Manager\OffersManager;
use Application\OffreBundle\Manager\UserOffreManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;
use Symfony\Component\Finder\Comparator\DateComparator;



class OffresController extends Controller
{	

    public function viewAction(Request $request)
    {
        
        $offerType = new Offers(); 
        $OffersFormType = $this->get('form.factory')
            ->createNamed(
                '',
                FiltreViewType::class,
                $offerType,
                array(
                    'action' => $this->generateUrl('offre_homepage'),
                    'method' => 'POST'
                )
            );
        $OffersFormType->handleRequest($request);
        
        $results = $this->OfferSearch();
        $formSubmited = false;
        $onglet=1;
        if ($OffersFormType->isValid()){
               $results = $this->OfferFiltre($offerType->getType());
               $formSubmited = true;
        }

        $resultsUser=$this->OfferUser();

        return $this->render('OffreBundle:Default:index.html.twig',array(
            'onglet' => $onglet,
            'formtype'=> $OffersFormType->createView(),
            'formSubmited' => $formSubmited,
            'results' => $results,
            'resultsUser' => $resultsUser,
        ));
    }
   
    protected function QueryOfferSearch()
    {
        $em=$this->getDoctrine()->getManager();
        $query=$em->getRepository('Application\OffreBundle\Entity\Offers')->createQueryBuilder('u');
        
        $date=new \DateTime('now');
        $query->where('u.dateexpire > :date')
            ->setParameter('date', $date);
        
        $query=$query
                ->orderBy('u.datepublished', 'DESC');
        return $query;
    }

    protected function OfferSearch(){
        $query=$this->QueryOfferSearch();
        $offers=null;
        $offers=$query->getQuery()->getResult();
        return $offers;
    }

    protected function OfferFiltre (string $type){
        $query=$this->QueryOfferSearch();
        $offers=null;
        if ($type != null){
            if ($type != '' ){
                $query->andwhere('u.type = :type')
                ->setParameter('type', $type);
            }
        }
        $offers=$query->getQuery()->getResult();
        return $offers;
    }

    protected function OfferUser (){ 
        $userId=$this->getUser(); 
        $query=$this->QueryOfferSearch(); 
        $query=$query->andwhere('u.user = :userId') 
            ->setParameter('userId', $userId); 
        $offersUser=$query->getQuery()->getResult(); 
        return $offersUser; 
    }

}