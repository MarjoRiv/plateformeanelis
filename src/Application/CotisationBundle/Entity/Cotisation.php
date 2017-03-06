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

    /**
     * @ORM\ManyToOne(targetEntity="Application\CotisationBundle\Entity\YearCotisation", inversedBy="cotisation", cascade={"remove", "persist"})
     */
    private $yearCotisation;



    public function __construct()
    {
        $this->payed = false;
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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param mixed $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * @return bool
     */
    public function isPayed()
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
     * @return mixed
     */
    public function getYearCotisation()
    {
        return $this->yearCotisation;
    }

    /**
     * @param mixed $yearCotisation
     */
    public function setYearCotisation($yearCotisation)
    {
        $this->yearCotisation = $yearCotisation;
    }



}
