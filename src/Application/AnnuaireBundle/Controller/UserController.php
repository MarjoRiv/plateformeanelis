<?php

namespace Application\AnnuaireBundle\Controller;

use Application\AnnuaireBundle\Form\Type\GeoSearchType;
use Application\AnnuaireBundle\Form\Type\UserSearchType;
use Application\AnnuaireBundle\Model\GeoSearch;
use Application\AnnuaireBundle\Model\UserSearch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function statsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('Admin\UserBundle\Entity\User');

        $userSearch = new UserSearch();
        // we create an "anonym" form to pass parameters in GET and have a nice url
        $userSearchForm = $this->get('form.factory')
            ->createNamed(
                '',
                UserSearchType::class,
                $userSearch,
                array(
                    'action' => $this->generateUrl('application_annuaire_homepage'),
                    'method' => 'GET'
                )
            );
        $userSearchForm->handleRequest($request);

        $geoSearch = new GeoSearch();
        $geoSearchForm = $this->get('form.factory')
            ->createNamed(
                '',
                GeoSearchType::class,
                $geoSearch,
                array(
                    'action' => $this->generateUrl('application_annuaire_homepage'),
                    'method' => 'GET'
                    )
            );
        $geoSearchForm->handleRequest($request);

        $results = null;
        $formSubmited = false;
        $geoform = false;
        if ($userSearchForm->isValid()) {
            $userSearch = $userSearchForm->getData();
            $results = $this->UserDQLSearch($userSearch);
            $formSubmited = true;
        }

        if ($geoSearchForm->isValid()) {
            $geoSearch = $geoSearchForm->getData();
            $results = $this->GeoDQLSearch($geoSearch);
            $formSubmited = true;
            $geoform = true;
        }

        return $this->render('ApplicationAnnuaireBundle:Default:index.html.twig', array(
            'results' => $results,
            'form' => $userSearchForm->createView(),
            'formm' => $geoSearchForm->createView(),
            'formSubmited' => $formSubmited,
            'geoform' => $geoform,
        ));
    }

    //Should be better to put this in a Repository ?
    protected function UserDQLSearch(UserSearch $userSearch)
    {

        $users = null;

        if ($userSearch != '' && ($userSearch->getName() != '' || $userSearch->getSurname() != null || $userSearch->getPromotion() != null || $userSearch->getFiliere() != null)) {
            $em = $this->getDoctrine()->getManager();
            $query = $em->getRepository('Admin\UserBundle\Entity\User')->createQueryBuilder('u');
            $parameters = array();
            if ($userSearch->getName() != null) {
                $query->andWhere('u.name LIKE :name');
                $parameters['name'] = '%'.$userSearch->getName().'%';
            }

            if($userSearch->getSurname() != null)
            {
                $query->andWhere('u.surname LIKE :surname');
                $parameters['surname'] = '%'.$userSearch->getSurname().'%';
            }

            if($userSearch->getPromotion() != null)
            {
                $query->andWhere('u.promotion = :promotion');
                $parameters['promotion'] = $userSearch->getPromotion();
            }

            if($userSearch->getFiliere() != null)
            {
                $query->andWhere('u.filiere = :filiere');
                $parameters['filiere'] = $userSearch->getFiliere();
            }

            if(count($parameters)) $query->setParameters($parameters);

            $DQLQuery = $query
                ->orderBy('u.filiere', 'ASC')
                ->orderBy('u.name', 'ASC')
                ->orderBy('u.surname', 'ASC')
                ->orderBy('u.promotion', 'ASC')
                ->getQuery();

            $users = $DQLQuery->getResult();
        }

        return $users;
    }

    protected function GeoDQLSearch(GeoSearch $geoSearch)
    {
        $users = null;

        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('Admin\UserBundle\Entity\User')->createQueryBuilder('u');
        $parameters = array();

        if ($geoSearch != '' && ($geoSearch->getPostalcode() != '' || $geoSearch->getCity() != null || $geoSearch->getCountry() != null)) {
            if ($geoSearch->getPostalcode() != null && $geoSearch->getPostalcode() > 1000) {
                $query->andWhere('u.postalcode-:postalcode < 1000 AND u.postalcode-:postalcode > -1000' )
                      ->andWhere('u.postalcode IS NOT NULL');
                $parameters['postalcode'] =  $geoSearch->getPostalcode();
            }

            if($geoSearch->getPostalcode() != null)
            {
                if($geoSearch->getPostalcode() <= 95)
                {
                    $query->andWhere('u.postalcode-:postalcode < 1000 AND u.postalcode-:postalcode > -1000' )
                          ->andWhere('u.postalcode IS NOT NULL');
                    $parameters['postalcode'] =  $geoSearch->getPostalcode()*1000;
                }
                else if($geoSearch->getPostalcode() >= 971 && $geoSearch->getPostalcode() <= 976)
                {
                    $query->andWhere('u.postalcode-:postalcode < 1000 AND u.postalcode-:postalcode > -1000' )
                        ->andWhere('u.postalcode IS NOT NULL');
                    $parameters['postalcode'] =  $geoSearch->getPostalcode()*100;
                }
                else
                {
                    $query->andWhere('u.postalcode = :postalcode');
                    $parameters['postalcode'] =  $geoSearch->getPostalcode();
                }
            }

            if ($geoSearch->getCity() != null) {
                $query->andWhere('u.city LIKE :city');
                $parameters['city'] = '%'.$geoSearch->getCity().'%';
            }

            if($geoSearch->getCountry() != null)
            {
                $query->andWhere('u.country = :country');
                $parameters['country'] = $geoSearch->getCountry();
            }

            if(count($parameters)) $query->setParameters($parameters);

            $DQLQuery = $query
                ->orderBy('u.filiere', 'ASC')
                ->orderBy('u.name', 'ASC')
                ->orderBy('u.surname', 'ASC')
                ->orderBy('u.promotion', 'ASC')
                ->getQuery();

            $users = $DQLQuery->getResult();
        }

        return $users;
    }
}