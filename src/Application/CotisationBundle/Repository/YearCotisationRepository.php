<?php

namespace Application\CotisationBundle\Repository;

use Application\MainBundle\Repository\AEntityRepository;


class YearCotisationRepository extends AEntityRepository
{
    public function findAllActive()
    {
        $yearCotisationEnabled =  $this->getEntityManager()->createQuery(
            'SELECT yc
                  FROM ApplicationCotisationBundle:YearCotisation yc
                  WHERE CURRENT_DATE() > yc.dateEnabled
                  '
        );


        $yearCotisation = array();
        foreach($yearCotisationEnabled->getResult() as $year)
        {
            if($year->getYear() >= intval(date('Y')))
            {
                $yearCotisation[] = $year;
            }
        }

        return $yearCotisation;

    }
}
