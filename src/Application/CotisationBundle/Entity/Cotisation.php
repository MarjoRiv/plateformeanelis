<?php

namespace Application\CotisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cotisation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cotisation {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var YearCotisation
     *
     * @ORM\ManyToOne(targetEntity="Application\CotisationBundle\Entity\YearCotisation", inversedBy="cotisations")
     * @ORM\JoinColumn(nullable=true)
     */
    private $yearCotisation;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\UserBundle\Entity\User", inversedBy="cotisations")
     */
    private $user;


    /**
     * @var boolean
     *
     * @ORM\Column(name="payed", type="boolean")
     */
    private $payed;

    /**
     * @var integer
     *
     * @ORM\Column(name="pricecotisation", type="integer")
     */
    private $pricecotisation;


    /**
     * @var int
     *
     * @ORM\Column(name="paymentType", type="integer", nullable=true)
     */
    private $paymentType;

    /**
     * @var int
     * Champ utilisé pour le montant de cotisation libre dans le formulaire.
     * Non référencé en base
     */
    private $cotisationLibre;

    /** @ORM\OneToOne(targetEntity="JMS\Payment\CoreBundle\Entity\PaymentInstruction") */
    private $paymentInstruction;

    /**
     * @ORM\Column(name="datePaiement", type="date", nullable=true)
     */
    private $datePaiement;

    public function __construct() {
        $this->paymentType = -1;
        $this->payed = false;
    }


    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }


    /**
     * @return bool
     */
    public function isPayed() {
        return $this->payed;
    }

    /**
     * @param bool $payed
     */
    public function setPayed($payed) {
        $this->payed = $payed;
    }

    /**
     * Set user
     *
     * @param \Admin\UserBundle\Entity\User $user
     * @return Cotisation
     */
    public function setUser(\Admin\UserBundle\Entity\User $user = null) {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \Admin\UserBundle\Entity\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getYearCotisation() {
        return $this->yearCotisation;
    }

    /**
     * @param mixed $yearCotisation
     */
    public function setYearCotisation($yearCotisation) {
        $this->yearCotisation = $yearCotisation;
    }

    /**
     * @return int
     */
    public function getPricecotisation() {
        return $this->pricecotisation;
    }

    /**
     * @param int $pricecotisation
     */
    public function setPricecotisation($pricecotisation) {
        $this->pricecotisation = $pricecotisation;
    }



    /**
     * @return int
     */
    public function getPaymentType() {
        return $this->paymentType;
    }

    /**
     * @return string
     *
     * Retourne le libellé associé au type de paiement
     */
    public function getPaymentTypeLabel() {
        return EnumTypePaiement::getStringFormat($this->paymentType);
    }

    /**
     * @param int $paymentType
     */
    public function setPaymentType($paymentType) {
        $this->paymentType = $paymentType;
    }

    /**
     * @return int
     */
    public function getCotisationLibre() {
        return $this->cotisationLibre;
    }

    /**
     * @param int $cotisationLibre
     */
    public function setCotisationLibre($cotisationLibre) {
        $this->cotisationLibre = $cotisationLibre;
    }

    /**
     * @return mixed
     */
    public function getPaymentInstruction() {
        return $this->paymentInstruction;
    }

    /**
     * @param mixed $paymentInstruction
     */
    public function setPaymentInstruction($paymentInstruction) {
        $this->paymentInstruction = $paymentInstruction;
    }

    /**
     * @return mixed
     */
    public function getDatePaiement() {
        return $this->datePaiement;
    }

    /**
     * @param mixed $datePaiement
     */
    public function setDatePaiement($datePaiement) {
        $this->datePaiement = $datePaiement;
    }



}
