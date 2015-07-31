<?php

namespace Application\YearbookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Yearbook
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Yearbook
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
     * @var integer
     *
     * @ORM\Column(name="promotion", type="integer")
     */
    private $promotion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activated", type="boolean")
     */
    private $activated;

    /**
     * @ORM\OneToMany(targetEntity="Application\YearbookBundle\Entity\YearbookMessages", mappedBy="yearbook", cascade={"remove", "persist"})
     * @ORM\OrderBy({"id" = "DESC"})
     *
     */
    private $messages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->activated = false;  
    }

    public function __toString() {
        return (string)$this->getPromotion();
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
     * Set promotion
     *
     * @param integer $promotion
     * @return Yearbook
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return integer 
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set activated
     *
     * @param boolean $activated
     * @return Yearbook
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * Get activated
     *
     * @return boolean 
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * Add messages
     *
     * @param \Application\YearbookBundle\Entity\YearbookMessages $messages
     * @return Yearbook
     */
    public function addMessage(\Application\YearbookBundle\Entity\YearbookMessages $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \Application\YearbookBundle\Entity\YearbookMessages $messages
     */
    public function removeMessage(\Application\YearbookBundle\Entity\YearbookMessages $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
