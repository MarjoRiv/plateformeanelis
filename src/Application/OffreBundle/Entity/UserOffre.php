<?php

namespace Application\OffreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserOffre
 *
 * @ORM\Table(name="user_offre")
 * @ORM\Entity(repositoryClass="Application\OffreBundle\Repository\UserOffreRepository")
 */
class UserOffre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\JoinColumn(name="user_link", referencedColumnName="id")
     * @ORM\OneToOne(targetEntity="Admin\UserBundle\Entity\User", mappedBy="id", cascade={"remove", "persist"}))
     */
    private $iDUserApp;

    /**
     * @var int
     *
     * @ORM\Column(name="Nbpropfait", type="integer")
     */
    private $nbpropfait;

    /**
     * @var int
     *
     * @ORM\Column(name="Nbpropmax", type="integer")
     */
    private $nbpropmax;

    /**
     * @var bool
     *
     * @ORM\Column(name="autorized", type="boolean")
     */
    private $autorized;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set iDUserApp
     *
     * @param integer $iDUserApp
     *
     * @return OffreUser
     */
    public function setIDUserApp($iDUserApp)
    {
        $this->iDUserApp = $iDUserApp;

        return $this;
    }

    /**
     * Get iDUserApp
     *
     * @return int
     */
    public function getIDUserApp()
    {
        return $this->iDUserApp;
    }

    /**
     * Set nbpropfait
     *
     * @param integer $nbpropfait
     *
     * @return OffreUser
     */
    public function setNbpropfait($nbpropfait)
    {
        $this->nbpropfait = $nbpropfait;

        return $this;
    }

    /**
     * Get nbpropfait
     *
     * @return int
     */
    public function getNbpropfait()
    {
        return $this->nbpropfait;
    }

    /**
     * Set nbpropmax
     *
     * @param integer $nbpropmax
     *
     * @return OffreUser
     */
    public function setNbpropmax($nbpropmax)
    {
        $this->nbpropmax = $nbpropmax;

        return $this;
    }

    /**
     * Get nbpropmax
     *
     * @return int
     */
    public function getNbpropmax()
    {
        return $this->nbpropmax;
    }

    /**
     * Set autorized
     *
     * @param boolean $autorized
     *
     * @return OffreUser
     */
    public function setAutorized($autorized)
    {
        $this->autorized = $autorized;

        return $this;
    }

    /**
     * Get autorized
     *
     * @return bool
     */
    public function getAutorized()
    {
        return $this->autorized;
    }

    public function __construct()
    {
        $this->nbpropfait=0;
        $this->nbpropmax=3;
        $this->autorized=true;
    }
}
