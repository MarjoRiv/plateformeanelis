<?php
/**
 * Created by PhpStorm.
 * User: Kevin Bourgeix
 * Date: 17/04/2017
 * Time: 15:37
 */

namespace Application\CotisationBundle\Entity;

/**
 * Class EnumTypePaiement
 * @package Application\CotisationBundle\Entity
 *
 *
 * Enumeration représentant les types de paiements et leur libellés.
 * Dans la BD, c'est simplement représenté par un int sur la cotisation. On récupère ensuite la valeur ici et on
 * récupère ce qu'il faut.
 */
abstract class EnumTypePaiement {
    const NON_RENSEIGNE  = -1; //Par défaut quand la cotisation n'est pas payé ou pour l'ancien modèle.
    const CHEQUE   = 0;
    const CASH     = 1;
    const VIREMENT = 2;
    const PAYPAL   = 3;
    const STRIPE   = 4;
    const SMILEPAY = 5;

    const MAX_TYPE_NUM = 5; //A changer quand on crée un nouveau type de paiement

    /**
     * @param $value int
     *
     * @return string
     *
     * @throws \Exception
     *
     * Retourne le libellé de la valeure correspondante de l'enul
     */
    public static function getStringFormat($value) {
        $string = "";

        switch ($value) {
            case -1:
                $string = "Non Renseigné";
                break;
            case 0:
                $string = "Chèque";
                break;
            case 1:
                $string = "Liquide";
                break;
            case 2:
                $string = "Virement Bancaire";
                break;
            case 3:
                $string = "Paypal";
                break;
            case 4:
                $string = "Stripe";
                break;
            case 5:
                $string = "SmilePay";
                break;
            default:
                throw new \Exception("Impossible de convertir le type demandé");
                break;
        }

        return $string;
    }

    /**
     * @return array
     *
     * Retourne l'ensemble des valeurs disponibles dans l'enum. Pour des raisons d'affichage
     */
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