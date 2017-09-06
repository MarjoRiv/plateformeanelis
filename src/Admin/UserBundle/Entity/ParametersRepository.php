<?php
/**
 * Created by PhpStorm.
 * User: Kevin Bourgeix
 * Date: 06/09/2017
 * Time: 15:31
 */

namespace Admin\UserBundle\Entity;



use Application\MainBundle\Repository\AEntityRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\MonologBundle\MonologBundle;

class ParametersRepository extends AEntityRepository {
    public function findOneByName($paramName)
    {
        return $this->getEntityManager()->createQuery(
            'SELECT p.value FROM UserBundle:Parameters p WHERE p.name = '.$paramName
        );
    }
}