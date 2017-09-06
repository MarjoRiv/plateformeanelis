<?php

namespace Application\OffreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Offers
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Application\OffreBundle\Entity\OffersRepository")
 */
class Offers
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
     * @ORM\ManyToOne(targetEntity="Application\OffreBundle\Entity\UserOffre", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=40)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datepublished", type="date")
     */
    private $datepublished;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @ORM\OneToOne(targetEntity="Application\OffreBundle\Entity\FileOffre", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $attachement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateexpire", type="date")
     */
    private $dateexpire;

    /**
     * @var integer
     *
     * @ORM\Column(name="reading", type="integer")
     */
    private $reading;


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
     * Set idUser
     *
     * @param \Application\OffreBundle\Entity\UserOffre $id
     * @return Offers
     */
    public function setUser(\Application\OffreBundle\Entity\UserOffre $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get IdUser
     *
     * @return \Application\OffreBundle\Entity\UserOffre 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Offers
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set datepublished
     *
     * @param \DateTime $datepublished
     *
     * @return Offers
     */
    public function setDatepublished($datepublished)
    {
        $this->datepublished = $datepublished;

        return $this;
    }

    /**
     * Get datepublished
     *
     * @return \DateTime
     */
    public function getDatepublished()
    {
        return $this->datepublished;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Offers
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Offers
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Offers
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set attachement
     *
     * @param string $attachement
     *
     * @return Offers
     */
    public function setAttachement($attachement)
    {
        $this->attachement = $attachement;

        return $this;
    }

    /**
     * Get attachement
     *
     * @return string
     */
    public function getAttachement()
    {
        return $this->attachement;
    }

    /**
     * Set dateexpire
     *
     * @param \DateTime $dateexpire
     *
     * @return Offers
     */
    public function setDateexpire($dateexpire)
    {
        $this->dateexpire = $dateexpire;

        return $this;
    }

    /**
     * Get dateexpire
     *
     * @return \DateTime
     */
    public function getDateexpire()
    {
        return $this->dateexpire;
    }

    /**
     * Set reading
     *
     * @param integer $reading
     *
     * @return Offers
     */
    public function setReading($reading)
    {
        $this->reading = $reading;

        return $this;
    }

    /**
     * Get reading
     *
     * @return integer
     */
    public function getReading()
    {
        return $this->reading;
    }

    public function getName()
    {
        return $this->user->getUserApp()->getUsername();
    }

    public function getIdAttachement()
    {
        $id=null;
        if ($this->attachement!=null)
        {
            $id=$this->attachement->getId();
        }
        return $id;
    }

    public function removeAttachement()
    {
        $this->attachement->removeUpload();
    }

    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->datepublished = new \Datetime('NOW');
        $this->dateexpire= new \Datetime('NOW');
        $this->dateexpire->modify("30 day");
        // Par défaut, la date d'expiration est 30 jour plus tard
        $this->attachement=null;
        $this->reading=0;
    }
}

