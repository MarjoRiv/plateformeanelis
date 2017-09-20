<?php

namespace Application\CotisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * YearCotisation
 *
 * @ORM\Table(name="YearCotisation")
 * @ORM\Entity(repositoryClass="Application\CotisationBundle\Repository\YearCotisationRepository")
 */
class YearCotisation {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \integer
     *
     * @ORM\Column(name="year", type="integer", unique=true)
     */
    private $year;

    /**
     * @var integer
     *
     * @ORM\Column(name="promoReduiteMax", type="integer")
     */
    private $promoReduiteMax;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnabled", type="datetime")
     */
    private $dateEnabled;

    /**
     * @ORM\OneToMany(targetEntity="Application\CotisationBundle\Entity\Cotisation", mappedBy="yearCotisation",cascade={"remove", "persist"})
     */
    private $cotisations;

    /**
     * @ORM\Column(name="reducedFeeAmount", type="integer")
     */
    private $reducedFeeAmount;

    /**
     * @ORM\Column(name="minAmount", type="integer")
     */
    private $minAmount;

    /**
     * @ORM\Column(name="proposedAmount1", type="integer")
     */
    private $proposedAmount1;

    /**
     * @ORM\Column(name="proposedAmount2", type="integer")
     */
    private $proposedAmount2;

    /**
     * @ORM\Column(name="proposedAmount3", type="integer")
     */
    private $proposedAmount3;

    /**
     * @ORM\Column(name="proposedAmount4", type="integer")
     */
    private $proposedAmount4;


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
     * @return \DateTime
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * @param \DateTime $year
     */
    public function setYear($year) {
        $this->year = $year;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnabled() {
        return $this->dateEnabled;
    }

    /**
     * @param \DateTime $dateEnabled
     */
    public function setDateEnabled($dateEnabled) {
        $this->dateEnabled = $dateEnabled;
    }

    function __toString() {
        return $this->year."";
    }

    /**
     * @return mixed
     */
    public function getCotisations() {
        return $this->cotisations;
    }

    /**
     * @param mixed $cotisation
     */
    public function setCotisations($cotisation) {
        $this->cotisations = $cotisation;
    }

    /**
     * @return mixed
     */
    public function getMinAmount() {
        return $this->minAmount;
    }

    /**
     * @param mixed $minAmount
     */
    public function setMinAmount($minAmount) {
        $this->minAmount = $minAmount;
    }

    /**
     * @return mixed
     */
    public function getProposedAmount1() {
        return $this->proposedAmount1;
    }

    /**
     * @param mixed $proposedAmount1
     */
    public function setProposedAmount1($proposedAmount1) {
        $this->proposedAmount1 = $proposedAmount1;
    }

    /**
     * @return mixed
     */
    public function getProposedAmount2() {
        return $this->proposedAmount2;
    }

    /**
     * @param mixed $proposedAmount2
     */
    public function setProposedAmount2($proposedAmount2) {
        $this->proposedAmount2 = $proposedAmount2;
    }

    /**
     * @return mixed
     */
    public function getProposedAmount3() {
        return $this->proposedAmount3;
    }

    /**
     * @param mixed $proposedAmount3
     */
    public function setProposedAmount3($proposedAmount3) {
        $this->proposedAmount3 = $proposedAmount3;
    }

    /**
     * @return mixed
     */
    public function getProposedAmount4() {
        return $this->proposedAmount4;
    }

    /**
     * @param mixed $proposedAmount4
     */
    public function setProposedAmount4($proposedAmount4) {
        $this->proposedAmount4 = $proposedAmount4;
    }

    /**
     * @return mixed
     */
    public function getReducedFeeAmount() {
        return $this->reducedFeeAmount;
    }

    /**
     * @param mixed $reducedFeeAmount
     */
    public function setReducedFeeAmount($reducedFeeAmount) {
        $this->reducedFeeAmount = $reducedFeeAmount;
    }

    /**
     * @return mixed
     */
    public function getPromoReduiteMax() {
        return $this->promoReduiteMax;
    }

    /**
     * @param mixed $promoReduiteMax
     */
    public function setPromoReduiteMax($promoReduiteMax) {
        $this->promoReduiteMax = $promoReduiteMax;
    }


}

