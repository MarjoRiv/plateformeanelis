<?php

namespace Application\CotisationBundle\Repository;

use Application\MainBundle\Repository\AEntityRepository;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;


class YearCotisationRepository extends AEntityRepository
{
    public function findAllActive()
    {
        $yearCotisationEnabled =  $this->getEntityManager()->createQuery(
            'SELECT yc
                  FROM ApplicationCotisationBundle:YearCotisation yc
                  '
        );

        date_default_timezone_set("Europe/Paris");
        $yearCotisation = array();
        foreach($yearCotisationEnabled->getResult() as $year)
        {
            $year->getDateEnabled()->setTimezone(new \DateTimeZone('Europe/Paris'));
            if($year->getYear() >= intval(date('Y')) && $year->getDateEnabled()->getTimestamp() <= time())
            {
                $yearCotisation[] = $year;
            }
        }

        return $yearCotisation;

    }
}
