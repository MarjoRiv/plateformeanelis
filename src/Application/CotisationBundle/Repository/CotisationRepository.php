<?php

namespace Application\CotisationBundle\Repository;

use Application\MainBundle\Repository\AEntityRepository;


class CotisationRepository extends AEntityRepository
{
    public function findByUser($user)
    {
        $cotisation =  $this->getEntityManager()->createQuery(
            'SELECT c
                  FROM ApplicationCotisationBundle:Cotisation c
                  WHERE c.user = '.$user->getId()
        );

        return $cotisation->getResult();
    }
}
