<?php
/**
 * Created by PhpStorm.
 * User: Kevin Bourgeix
 * Date: 17/04/2017
 * Time: 15:37
 */

namespace Application\CotisationBundle\Entity;


abstract class EnumTypePaiement {
    const INCONNU  = -1; //Par défaut quand la cotisation n'est pas payé ou pour l'ancien modèle.
    const CHEQUE   = 0;
    const CASH     = 1;
    const VIREMENT = 2;
    const PAYPAL   = 3;
    const STRIPE   = 4;
    const SMILEPAY = 5;

    /**
     * @param $value EnumValue
     *
     * Returns the value of the enum for display purpose
     */
    public static function getStringFormat($value) {
        $string = "";

        switch ($value) {
            case -1:
                $string = "Inconnu / Non payé";
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

}