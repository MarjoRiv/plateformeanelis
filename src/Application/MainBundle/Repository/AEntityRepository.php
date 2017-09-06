<?php
namespace Application\MainBundle\Repository;
use Monolog\Logger;

abstract class AEntityRepository extends \Doctrine\ORM\EntityRepository {


    /**
     * @param string $query
     *
     * Crée la requête de sélection et l'exécute
     */
    public function createQuery($query)
    {
        $logger = new Logger('RepoLogger');
        $logger->warn('Communication avec la base de données (Date : '.date('dd/mm/yy hh24:mi').') - Requete : '
                      .$query);

        $this->_em->createQuery($query);
    }
}