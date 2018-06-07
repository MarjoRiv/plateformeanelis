<?php

namespace Admin\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


class UserImportState
{
    const TODO = 0;
    const KO = 1;
    const OK = 2;
    const TERMINE = 3;

    const MAX_TYPE_NUM = 3;

    public static function getStringFormat($value) {
        $string = "";

        switch ($value) {
            case 0:
                $string = "A faire";
                break;
            case 1:
                $string = "KO";
                break;
            case 2:
                $string = "OK";
                break;
            case 3:
                $string = "Terminé";
                break;
            default:
                throw new \Exception("Impossible de convertir le type demandé");
                break;
        }

        return $string;
    }

    public static function getLabelsFromValues() {
        $values = array();

        for ($i = 0; $i <= self::MAX_TYPE_NUM; $i++) {
            $values[$i] = self::getStringFormat($i);
        }

        return $values;
    }

    public static function getValuesFromLabel()
    {
        $values = array();

        for ($i = 0; $i <= self::MAX_TYPE_NUM; $i++) {
            $values[self::getStringFormat($i)] = $i;
        }

        return $values;
    }
}

