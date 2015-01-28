<?php

namespace Application\AnnuaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Application\AnnuaireBundle\Model\UserSearch;
use Application\AnnuaireBundle\Form\Type\UserSearchType;

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
        $results = null;
        $formSubmited = false;
        if ($userSearchForm->isValid()) {
            $userSearch = $userSearchForm->getData();
            $results = $this->getSearchRepository()->searchUsers($userSearch); 
            $formSubmited = true;
        }

        return $this->render('ApplicationAnnuaireBundle:Default:index.html.twig', array(
            'results' => $results,
            'form' => $userSearchForm->createView(),
            'formSubmited' => $formSubmited,
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