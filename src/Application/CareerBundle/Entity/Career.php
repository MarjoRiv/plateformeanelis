<?php

namespace Application\CareerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Career
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Career
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Application\CareerBundle\Entity\TypeCareer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeCareer;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\UserBundle\Entity\User", inversedBy="careers")
     */
    private $user;


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
     * Set title
     *
     * @param string $title
     * @return Career
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
     * Set description
     *
     * @param string $description
     * @return Career
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
     * Set date
     *
     * @param \DateTime $date
     * @return Career
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set user
     *
     * @param \Admin\UserBundle\Entity\User $user
     * @return Career
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
     * Set typeCareer
     *
     * @param \Application\CareerBundle\Entity\TypeCareer $typeCareer
     * @return Career
     */
    public function setTypeCareer(\Application\CareerBundle\Entity\TypeCareer $typeCareer)
    {
        $this->typeCareer = $typeCareer;

        return $this;
    }

    /**
     * Get typeCareer
     *
     * @return \Application\CareerBundle\Entity\TypeCareer 
     */
    public function getTypeCareer()
    {
        return $this->typeCareer;
    }
}
