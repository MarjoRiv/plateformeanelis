<?php

namespace Admin\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


class UserImportAction
{
    const CREATE = 0;
    const UPDATE = 1;
    const DELETE = 2;

    const MAX_TYPE_NUM = 2;

    public static function getStringFormat($value) {
        $string = "";

        switch ($value) {
            case 0:
                $string = "CREATE";
                break;
            case 1:
                $string = "UPDATE";
                break;
            case 2:
                $string = "DELETE";
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

