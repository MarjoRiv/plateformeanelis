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
    //management of user request
    public function viewAction(Request $request)
    {
        
        $offerType = new Offers(); 
        $OffersFormType = $this->get('form.factory') //create filter form
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
        
        $results = $this->OfferSearch(); //list of valid offers
        $formSubmited = false;
        $onglet=1;
        if ($OffersFormType->isValid()){ //if user use the filter form
               $results = $this->OfferFiltre($offerType->getType());
               $formSubmited = true;
        }
        $date=new \DateTime('now');
        $resultsUser=$this->OfferUser();

        return $this->render('OffreBundle:Default:index.html.twig',array(
            'date' => $date,
            'onglet' => $onglet,
            'formtype'=> $OffersFormType->createView(),
            'formSubmited' => $formSubmited,
            'results' => $results,
            'resultsUser' => $resultsUser,
        ));
    }
   //list of valid offers
    protected function QueryOfferSearch()
    {
        $em=$this->getDoctrine()->getManager();
        $query=$em->getRepository('Application\OffreBundle\Entity\Offers')->createQueryBuilder('u');
        
        $date=new \DateTime('now');
        $query->where('u.dateexpire > :date') //select offers which are before its expiration date
            ->setParameter('date', $date)
                ->andwhere('u.enabled = true'); //select offers which are enabled by the user
        
        $query=$query
                ->orderBy('u.datepublished', 'DESC'); 
        return $query;
    }
    //list of offers
    protected function OfferSearch(){
        $query=$this->QueryOfferSearch(); //get valid offers
        $offers=null;
        $offers=$query->getQuery()->getResult();
        return $offers;
    }
    // filter type
    protected function OfferFiltre (string $type){
        $query=$this->QueryOfferSearch(); //get valid offers
        $offers=null;
        if ($type != null){ 
            if ($type != '' ){
                $query->andwhere('u.type = :type') //filter offers with the type of the form
                ->setParameter('type', $type);
            }
        }
        $offers=$query->getQuery()->getResult();
        return $offers;
    }
    //list of offers belong to the user
    protected function OfferUser (){
        $em2 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\UserOffre')->createQueryBuilder('u');
        $userOffre = null;
        $offersUser=null;
        $userOffre = ($em2->where('u.UserApp = :user')->setParameter('user', $this->getUser())->getQuery()->getResult())[0]; //select offers of the usser
        if ($userOffre!=null)
        {
            $em=$this->getDoctrine()->getManager();
            $query=$em->getRepository('Application\OffreBundle\Entity\Offers')->createQueryBuilder('u');
            $query=$query
                ->orderBy('u.datepublished', 'DESC')
                ->where('u.user = :userId')
                    ->setParameter('userId', $userOffre);
            $offersUser=$query->getQuery()->getResult();
        }
        return $offersUser;
    }

}