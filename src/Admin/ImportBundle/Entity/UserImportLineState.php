<?php

namespace Admin\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


class UserImportLineState
{
    const TODO = 0;
    const ERROR = 1;
    const PRET = 2;

    const MAX_TYPE_NUM = 2;

    public static function getStringFormat($value) {
        $string = "";

        switch ($value) {
            case 0:
                $string = "A faire";
                break;
            case 1:
                $string = "En Erreur";
                break;
            case 2:
                $string = "Pret";
                break;
            default:
                throw new \Exception("Impossible de convertir le type demandé");
                break;
        }

        return $string;
    }

    public static function getLabelsFromValues() {
        $values = array();

        for ($i = -1; $i <= self::MAX_TYPE_NUM; $i++) {
            $values[$i] = self::getStringFormat($i);
        }

        return $values;
    }

    public static function getValuesFromLabel()
    {
        $values = array();

        for ($i = -1; $i <= self::MAX_TYPE_NUM; $i++) {
            $values[self::getStringFormat($i)] = $i;
        }

        return $values;
    }
}

