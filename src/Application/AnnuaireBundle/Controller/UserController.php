<?php

namespace Application\AnnuaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Application\AnnuaireBundle\Model\UserSearch;
use Application\AnnuaireBundle\Form\Type\UserSearchType;
use Application\AnnuaireBundle\Model\GeoSearch;
use Application\AnnuaireBundle\Form\Type\GeoSearchType;

class UserController extends Controller
{
    public function statsAction(Request $request)
    {
        $userSearch = new UserSearch();
        // we create an "anonym" form to pass parameters in GET and have a nice url
        $userSearchForm = $this->get('form.factory')
            ->createNamed(
                '',
                new UserSearchType(),
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
                new GeoSearchType(),
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
            $results = $this->getSearchRepository()->searchUsers($userSearch); 
            $formSubmited = true;
        }

        if ($geoSearchForm->isValid()) {
            $geoSearch = $geoSearchForm->getData();
            $results = $this->getSearchRepository()->searchGeoUsers($geoSearch);
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

    protected function getSearchRepository()
    {
        return $this->container
            ->get('fos_elastica.manager')
            ->getRepository('AdminUserBundle:User')
        ;
    }
}