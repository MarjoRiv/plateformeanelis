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
     * @ORM\ManyToOne(targetEntity="Application\CotisationBundle\Entity\TypeCotisation", inversedBy="cotisation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeCotisation;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date", nullable=false)
     */
    private $year;


    /**
     * @ORM\ManyToOne(targetEntity="Admin\UserBundle\Entity\User", inversedBy="cotisations")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Application\CotisationBundle\Entity\Invoice", mappedBy="cotisation", cascade={"remove", "persist"})
     */
    protected $invoice;

    /**
     * @var boolean
     *
     * @ORM\Column(name="payed", type="boolean")
     */
    private $payed;







    public function __construct()
    {
        $this->payed = false;
        $this->typeCotisation = NULL;
        $this->nameCotisation = "";
        $this->priceCotisation = 0;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }




    /**
     * @return bool
     */
    public function getPayed()
    {
        return $this->payed;
    }

    /**
     * @param bool $payed
     */
    public function setPayed($payed)
    {
        $this->payed = $payed;
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
     * Set invoice
     *
     * @param \Application\CotisationBundle\Entity\Invoice $invoice
     * @return Cotisation
     */
    public function setInvoice(\Application\CotisationBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;
        return $this;
    }

    /**
     * Get invoice
     *
     * @return \Application\CotisationBundle\Entity\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }


}
