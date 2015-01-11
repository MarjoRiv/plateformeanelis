<?php

namespace Application\CotisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cotisation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cotisation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date", nullable=false)
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="Application\CotisationBundle\Entity\TypeCotisation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeCotisation;

    /**
     * @var string
     *
     * @ORM\Column(name="namecotisation", type="string", length=255)
     */
    private $nameCotisation;

    /**
     * @var integer
     *
     * @ORM\Column(name="pricecotisation", type="integer")
     */
    private $priceCotisation;

    
    /**
     * @var boolean
     *
     * @ORM\Column(name="payed", type="boolean")
     */
    private $payed;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\UserBundle\Entity\User", inversedBy="cotisations")
     */
    private $user;


    public function __construct()
    {
        $this->payed = false;
        $this->machin = "";
        $this->typeCotisation = NULL;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set payed
     *
     * @param boolean $payed
     * @return Cotisation
     */
    public function setPayed($payed)
    {
        $this->payed = $payed;

        return $this;
    }

    /**
     * Get payed
     *
     * @return boolean 
     */
    public function getPayed()
    {
        return $this->payed;
    }

    /**
     * Set typeCotisation
     *
     * @param \Application\CotisationBundle\Entity\TypeCotisation $typeCotisation
     * @return Cotisation
     */
    public function setTypeCotisation(\Application\CotisationBundle\Entity\TypeCotisation $typeCotisation)
    {
        $this->typeCotisation = $typeCotisation;

        return $this;
    }

    /**
     * Get typeCotisation
     *
     * @return \Application\CotisationBundle\Entity\TypeCotisation 
     */
    public function getTypeCotisation()
    {
        return $this->typeCotisation;
    }

    public function getTypeCotisationName()
    {
        return $this->typeCotisation->name;
    }


    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Cotisation
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Cotisation
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set user
     *
     * @param \Admin\UserBundle\Entity\User $user
     * @return Cotisation
     */
    public function setUser(\Admin\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Admin\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
     * @return Cotisation
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set nameCotisation
     *
     * @param string $nameCotisation
     * @return Cotisation
     */
    public function setNameCotisation($nameCotisation)
    {
        $this->nameCotisation = $nameCotisation;

        return $this;
    }

    /**
     * Get nameCotisation
     *
     * @return string 
     */
    public function getNameCotisation()
    {
        return $this->nameCotisation;
    }

    /**
     * Set priceCotisation
     *
     * @param integer $priceCotisation
     * @return Cotisation
     */
    public function setPriceCotisation($priceCotisation)
    {
        $this->priceCotisation = $priceCotisation;

        return $this;
    }

    /**
     * Get priceCotisation
     *
     * @return integer 
     */
    public function getPriceCotisation()
    {
        return $this->priceCotisation;
    }
}
