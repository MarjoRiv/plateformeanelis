<?php

namespace Application\MainBundle\Controller;

use Admin\UserBundle\Entity\Events;
use Admin\UserBundle\Entity\Parameters;
use Sonata\AdminBundle\SonataAdminBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository('AdminUserBundle:User')->findAll();

        $offers = $this->OffreValid();

        //Searching the static textes on the page... Maybe use the name instead of the Id that can change on the DB.
        $welcomeText = $this->getDoctrine()->getRepository('AdminUserBundle:Parameters')->findOneByName('anelis.accueil.welcomeText');

        $incommingEvents = $this->findIncommingEvents();

        //Sorts array according to static function cmpEvents.
        usort($incommingEvents,array("Admin\\UserBundle\\Entity\\Events", "cmpEvents"));

        return $this->render('ApplicationMainBundle:Default:index.html.twig', array(
            'users' => count($users),
            'welcomeText' => $welcomeText->getValue(),
            'events' => $incommingEvents,
            'offers' => count($offers)
        ));
    }

    public function aideAction()
    {   
        return $this->render('ApplicationMainBundle:Default:aide.html.twig');
    }

    //TODO : Using EventsRepository would be better
    /**
     * Gives all upcomming events
     *
     * @return array
     */
    public function findIncommingEvents()
    {
        $allEvents = $this->getDoctrine()->getRepository('AdminUserBundle:Events')->findAll();
        $incommingEvents = array();
        $now = new \DateTime();

        foreach ($allEvents as $event)
        {
            if($event->getDate() > $now)
            {
                $incommingEvents[] = $event;
            }
        }

        return $incommingEvents;
    }

    //list of valid offers
    protected function OffreValid()
    {
        $query=$this->getDoctrine()->getRepository('OffreBundle:Offers')->createQueryBuilder('u');
        
        $date=new \DateTime('now');
        $query->where('u.dateexpire > :date') //select offers which are before its expiration date
            ->setParameter('date', $date) 
            ->andwhere('u.enabled = true'); //select offers which are enabled by the user
        $query=$query->getQuery()->getResult();
        return $query;
    } 

}
