<?php
namespace Application\AnnuaireBundle\Entity\SearchRepository;

use FOS\ElasticaBundle\Repository;
use Application\AnnuaireBundle\Model\UserSearch;
use Application\AnnuaireBundle\Model\GeoSearch;
/**
 * This class contains all the elastica queries
 */
class UserRepository extends Repository
{
    public function getQueryForSearch(UserSearch $userSearch)
    {
        $boolQuery = new \Elastica\Query\Bool();
        if ($userSearch != '' && ($userSearch->getName() != '' || $userSearch->getSurname() != null || $userSearch->getPromotion() != null || $userSearch->getFiliere() != null)) {
            if ($userSearch->getName() != null) {
                $queryName = new \Elastica\Query\Match();
                $queryName->setFieldQuery('name', $userSearch->getName());
                $queryName->setFieldFuzziness('name', 0.7);
                $queryName->setFieldMinimumShouldMatch('name', '80%');
                $boolQuery->addMust($queryName);
            }
            if ($userSearch->getSurname() != null) {
                $querySurname = new \Elastica\Query\Match();
                $querySurname->setFieldQuery('surname', $userSearch->getSurname());
                $boolQuery->addShould($querySurname);
            }
            if ($userSearch->getPromotion() != null) {
                $querySurname = new \Elastica\Query\Match();
                $querySurname->setFieldQuery('promotion', $userSearch->getPromotion());
                $boolQuery->addMust($querySurname);
            }
            if ($userSearch->getFiliere() != null) {
                $querySurname = new \Elastica\Query\Match();
                $querySurname->setFieldQuery('filiere', $userSearch->getFiliere());
                $boolQuery->addMust($querySurname);
            }
        } else {
            $queryVide = new \Elastica\Query\Match();
            $queryVide->setFieldQuery('name', 'Vide');
            $boolQuery->addMust($queryVide);
        }
          
        $query = new \Elastica\Query();
        $query->addSort(array('filiere' => array('order' => 'asc')));
        $query->addSort(array('name' => array('order' => 'asc')));
        $query->addSort(array('surname' => array('order' => 'asc')));
        $query->setQuery($boolQuery);

        return $query;
    }

    public function getQueryForGeoSearch(GeoSearch $geoSearch)
    {
        $boolQuery = new \Elastica\Query\Bool();
        if ($geoSearch != '' && ($geoSearch->getPostalcode() != '' || $geoSearch->getCity() != null || $geoSearch->getCountry() != null)) {
            if ($geoSearch->getPostalcode() != null) {
                $queryPostalCode = new \Elastica\Query\Match();
                $queryPostalCode->setFieldQuery('postalcode', $geoSearch->getPostalcode());
                $boolQuery->addMust($queryPostalCode);
            }
            if ($geoSearch->getCity() != null) {
                $queryCity = new \Elastica\Query\Match();
                $queryCity->setFieldQuery('city', $geoSearch->getCity());
                $boolQuery->addMust($queryCity);
            }
            if ($geoSearch->getCountry() != null) {
                $queryCountry = new \Elastica\Query\Match();
                $queryCountry->setFieldQuery('country', $geoSearch->getCountry());
                $boolQuery->addMust($queryCountry);
            }
        } else {
            $queryVide = new \Elastica\Query\Match();
            $queryVide->setFieldQuery('name', 'Vide');
            $boolQuery->addMust($queryVide);
        }
        
        $query = new \Elastica\Query();
        $query->addSort(array('filiere' => array('order' => 'asc')));
        $query->addSort(array('name' => array('order' => 'asc')));
        $query->addSort(array('surname' => array('order' => 'asc')));
        $query->setQuery($boolQuery);

        return $query;
    }

    public function searchUsers(UserSearch $articleSearch)
    {
        $query = $this->getQueryForSearch($articleSearch);
        return $this->find($query, 200);
    }

    public function searchGeoUsers(GeoSearch $geoSearch)
    {
        $query = $this->getQueryForGeoSearch($geoSearch);
        return $this->find($query, 200);
    }

}