<?php

namespace Application\OffreBundle\Controller;

use Application\OffreBundle\Form\OffersType;
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
        $offer->setUser($userOffre);

        $autorize= $userOffre->getAutorized();
        $results = null;
        
        $formSubmited = false;
        $onglet=1;
        if ($autorize==true)
        {
	        if ($OffersForm->isValid()) 
	        {
                $results = $this->OfferDQLSearch();
	        	$prop=$userOffre->getNbpropfait();
	        	if ($prop<($userOffre->getNbpropMax()))
	        	{
		        	$userOffre->setNbpropfait($prop+1);
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
            if ($OffersFormType->isValid()){
                $onglet=2;
                $results = $this->OfferDQLSearch($offerType);
                $formSubmited = true;
            }
	    }


        return $this->render('OffreBundle:Default:index.html.twig',array(
        	'autorize' => $autorize,
            'onglet' => $onglet,
            'form' => $OffersForm->createView(),
            'formtype'=> $OffersFormType->createView(),
            'formSubmited' => $formSubmited,
            'results' => $results,
        ));
    }
   
    protected function OfferDQLSearch(Offers $offersSearch)
    {

        $offers = null;

        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('Application\OffreBundle\Entity\Offers')->createQueryBuilder('u');
        $parameters = array();

        if ($offersSearch->getType() != ''){
            $query->where('u.type = :type');
            $parameters['type'] =  $offersSearch->getType();
        }
        $date = new \DateTime('now');
        $query->where('u.dateexpire > :date')
            ->setParameter('date', $date);
        
            $DQLQuery = $query
                ->orderBy('u.datepublished', 'DESC')
                ->getQuery();

            $offers = $DQLQuery->getResult();

        return $offers;
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