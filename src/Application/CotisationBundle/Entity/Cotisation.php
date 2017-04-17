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
     * @var integer
     *
     * @ORM\Column(name="paymentType", type="integer", nullable=true)
     */
    private $paymentType;

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
    public function getPayed() {
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
    public function getPrice() {
        return $this->pricecotisation;
    }

    /**
     * @param int $price
     */
    public function setPrice($price) {
        $this->pricecotisation = $price;
    }

    /**
     * @return int
     */
    public function getPaymentType() {
        return $this->paymentType;
    }

    /**
     * @param int $paymentType
     */
    public function setPaymentType($paymentType) {
        $this->paymentType = $paymentType;
    }


}
