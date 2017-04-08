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
use Symfony\Component\Finder\Comparator\DateComparator;
use Doctrine\ORM\QueryBuilder;

class OffreController extends Controller
{

    public function addAction(Request $request)
    {
        $offer = new Offers(); // creation of new offer
        $userOffre=$this->UserOffreCreat(); // call function of recorvery of userOffre
        $message="";

        $OffersForm = $this->get('form.factory') // creation of the form for user 
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
        $offer->setUser($userOffre); // association the user and the offer
        $formSubmited = false; 
        $autorize= $userOffre->getAutorized(); // recorvery user's autorisation
        if ($autorize==true)
        {
            if ($OffersForm->isValid()) // if form is validated
            {
                $em2=$this->getDoctrine()->getManager();
                $query=$em2->getRepository('Application\OffreBundle\Entity\Offers')->createQueryBuilder('o');
                if ($userOffre!=null) // userOffre exist
                {
                    $query = $query
                        ->where('o.user = :userOffre')
                        ->setParameter('userOffre', $userOffre);
                    $this->whereCurrentYear($query);   // recorvery the offer of the user of this year
                }
                $offersUser=$query->getQuery()->getResult(); // get result
                $prop=count($offersUser);  // count the number of offer on this result
                if ($prop<($userOffre->getNbpropMax())) // if user can make other offer
                {   
                    $em3 = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('Application\OffreBundle\Entity\OffreVar')
                                ->createQueryBuilder('v');
                    $dureemax = ($em3->where('v.name = :name')->setParameter('name', "dureeOffre(jour)")->getQuery()->getResult())[0]; // get the duration configured by the admin of offer
                    $offer->setDateexpire($offer->getDateexpire()->modify((($dureemax->getVariable())-30)." day")); // set that in the offer
                    $userOffre->setNbpropfait(($userOffre->getNbpropfait())+1); // increment the number of offer done by the user
                    if ($offer->getAttachement()!=null) // if attachement exist
                    {
                        $filesize = ($em3->where('v.name = :name')->setParameter('name', "filesize(octets)")->getQuery()->getResult())[0]->getVariable(); // get the larger configured by admin
                        if ($offer->getAttachement()->taillefile()<$filesize) // if the file is not too large
                        {
                            $offer->getAttachement()->preUpload(); // prepare updated
                        }
                        else
                        {
                            $offer->setAttachement(null);
                            $message='Le fichier doit être inférieur à 1Mo'; // else : error messgae
                            return $this->render('OffreBundle:Offre:add.html.twig',array(
                                'message' => $message,
                                'autorize' => $autorize,
                                'form' => $OffersForm->createView(),
                                'formSubmited' => $formSubmited,
                            ));
                        }
                    }
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($userOffre);
                    $em->persist($offer);
                    $em->flush(); // save in bdd to create idattachement and offer and user
                    if ($offer->getAttachement()!=null)
                    {
                        $offer->getAttachement()->upload(); // uplaod the file
                    }
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($offer);
                    $em->flush(); // save in bdd
                    $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                    $formSubmited = true;
                    return $this->render('OffreBundle:Offre:show.html.twig',array(
                        'offre' => $offer,
                        'usercreation' => true,
                    ));
                }
                else
                {
                    $message='Vous n\'avez plus la possibilité de publier d\'annonce cette année'; // error message
                    $request->getSession()
                            ->getFlashBag()
                            ->add('notice', 'Trop d\'annonce publiée, contactez l\'administrateur si vous souhaitez en avoir plus.');
                }
            }
        }
        return $this->render('OffreBundle:Offre:add.html.twig',array(
            'message' => $message,
            'autorize' => $autorize,
            'form' => $OffersForm->createView(),
            'formSubmited' => $formSubmited,
        ));
    }

    public function showAction(Offers $offre)
    {
        $usercreation= false;
        if ($this->getUser()==$offre->getUser()->getUserApp()) // if user is the offer creator
        {
            $date=new \DateTime('now'); 
            if ($offre->getDateexpire()>$date) // if user can modify the offer yet
            {
                $usercreation = true;
            }
        }
        else
        {
            $offre->setReading($offre->getReading()+1); 
            $em = $this->getDoctrine()->getManager();   //save in data base
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
        $message="";
        if (($offre->getUser()->getUserApp()==$this->getUser())&&($offre->getDateexpire()>new \DateTime('now')))  // if user can modify the offer
        {
            $OffersForm = $this->get('form.factory') // create the form for user
                ->createNamed(
                    '',
                    Offers2Type::class,
                    $offre,
                    array(
                        'action' => $this->generateUrl('offre_edit', array('id'=>$offre->getId())),
                        'method' => 'POST'
                    )
                );
            $autorize = $offre->getUser()->getAutorized(); //user autorization
            $OffersForm->handleRequest($request); 
            
            if ($OffersForm->isValid()) //if form is valid
            {   
                $formSubmited=true;
                if ($offre->getAttachement()!=null) //if offer has attachement
                {  
                    if ($OffersForm->get('deleteAttachement')->isClicked()) //if user want delete attachement
                    {
                        $this->deleteAttachement($offre);  //delete attachement
                        $message="Pièce jointe supprimée";  //message for user
                        $em = $this->getDoctrine()->getManager();
                        $em->remove($offre->getAttachement());
                        $offre->setAttachement(null); 
                        $em->flush(); // save in data base
                        return $this->render('OffreBundle:Offre:offre.edit.html.twig',array(
                            'message' => $message,
                            'autorize' => $autorize,
                            'offre' => $offre,
                            'form' => $OffersForm->createView(),
                            'formSubmited' => $formSubmited,
                        ));
                    }
                    $em3 = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('Application\OffreBundle\Entity\OffreVar')
                                ->createQueryBuilder('v');
                    $filesize = ($em3->where('v.name = :name')->setParameter('name', "filesize(octets)")->getQuery()->getResult())[0]->getVariable(); // variable filesize(octets) configured by admin 
                    if ($offre->getAttachement()->taillefile()<$filesize) // if file is not too large
                    {
                        $offre->getAttachement()->preUpload();  // prepare uplaod
                    }
                    else
                    {
                        $offre->setAttachement(null);  // delete file because too large
                        $message='Le fichier doit être inférieur à 1Mo';  
                        return $this->render('OffreBundle:Offre:offre.edit.html.twig',array(
                            'message' => $message,
                            'autorize' => $autorize,
                            'offre' => $offre,
                            'form' => $OffersForm->createView(),
                            'formSubmited' => $formSubmited,
                        ));
                    }
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($offre);
                    $em->flush();  // save in data base to create an id for file
                }
                if ($offre->getAttachement()!=null)
                {
                    $offre->getAttachement()->upload(); // downlaod file
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($offre);
                $em->flush(); // save in data base
                $message="Modification enregistrée"; // user message
                $request->getSession()->getFlashBag()->add('success', "L'offre a été modifié.");
                return $this->redirect($this->generateUrl('offre_show', array('id' => $offre->getId())));  // redirection in show the offer 
            }
            return $this->render('OffreBundle:Offre:offre.edit.html.twig', array(
                        'message' => $message,
                        'autorize' => $autorize,
                        "form" => $OffersForm->createView(),
                        "offre" => $offre,
                        'formSubmited' => $formSubmited,
                ));
        }
        else
        {
            return $this->redirect($this->generateUrl('offre_show', array('id' => $offre->getId())));  // redirection in show the offer because th user cannot modify this
        } 
    }

    protected function deleteAttachement(Offers $offre)
    {
        $offre->removeAttachement(); // delete attachement
        $em = $this->getDoctrine()->getManager();
        $em->persist($offre);
        $em->flush(); //save in data base
    }

    protected function UserOffreCreat()
    {
        $em2 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\UserOffre')->createQueryBuilder('u');
        $userOffre = null;
        $userOffre = ($em2->where('u.UserApp = :user')->setParameter('user', $this->getUser())->getQuery()->getResult()); // search useroffre with current user
        if ($userOffre==null) // if he doesn't exist
        {
            $userOffre = new UserOffre($this->getUser()->getId()); // creation
            $userOffre->setUserApp($this->getUser()); //link with general user
        }
        else
        {
            $userOffre = $userOffre[0]; //if he exists, recorvery
        }
        $em3 = $this->getDoctrine()->getManager()->getRepository('Application\OffreBundle\Entity\OffreVar')->createQueryBuilder('v'); 
        if ($userOffre->getUserApp()->isCotisant()) // show if he is cotisant or not
        {
            $name = "nbOffresCotisants";
        }
        else
        {
            $name = "nbOffresNonCotisants";
        }
        $varoffre = ($em3->where('v.name = :name')->setParameter('name', $name)->getQuery()->getResult())[0]; // take the number of offer possible, admin configuration
        $nbactuel = $userOffre->getNbpropMax(); // get his actual number
        if (($nbactuel == null) or ($nbactuel<($varoffre->getVariable()))) // if is not initialised yet or the number is lesser than the real possibility propose by admin
        {
            $userOffre->setNbpropmax($varoffre->getVariable()); // update
        }
        $em1 = $this->getDoctrine()->getManager();
        $em1->persist($userOffre);
        $em1->flush(); // save in data base
        return $userOffre;
    }

    public function whereCurrentYear(QueryBuilder $qb) // function which select offer of the year
    {
    $qb
      ->andWhere('o.datepublished BETWEEN :start AND :end')
      ->setParameter('start', new \Datetime(date('Y').'-01-01'))  // Date entre le 1er janvier de cette année
      ->setParameter('end',   new \Datetime(date('Y').'-12-31'))  // Et le 31 décembre de cette année
    ;
    }

}
