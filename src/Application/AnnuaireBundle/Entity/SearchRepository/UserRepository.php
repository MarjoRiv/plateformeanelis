<?php
namespace Application\AnnuaireBundle\Entity\SearchRepository;

use FOS\ElasticaBundle\Repository;
use Application\AnnuaireBundle\Model\UserSearch;
/**
 * This class contains all the elastica queries
 */
class UserRepository extends Repository
{
    public function getQueryForSearch(UserSearch $userSearch)
    {
        $boolQuery = new \Elastica\Query\Bool();
        if ($userSearch != '') {
            $queryName = new \Elastica\Query\Match();
            if ($userSearch->getName() != null) {
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
            $query = new \Elastica\Query\MatchAll();
        }
          
            
        return $boolQuery;
    }

    public function searchUsers(UserSearch $articleSearch)
    {
        $query = $this->getQueryForSearch($articleSearch);
        return $this->find($query);
    }

    public function searchActiveCategories()
    {
        $query = new \Elastica\Query(new \Elastica\Query\MatchAll());
        $publishedQuery = new \Elastica\Query(new \Elastica\Query\Term(array('published'=>true)));
        $hasChildQuery = new \Elastica\Query\HasChild($publishedQuery);
        $hasChildQuery->setType('article');
        $query->setQuery($hasChildQuery);
        return $this->find($query);
    }
}