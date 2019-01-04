<?php
/**
 * Created by PhpStorm.
 * User: Marjorie
 * Date: 04/01/2019
 * Time: 11:30
 */

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
     * @ORM\Column (name="promotion",type="integer")
     */
    private $promotion;

    /**
     * @var boolean
     * @ORM\Column (name="activated", type="boolean")
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


    /**
     * ToString
     * @return string
     */
    public function __toString() {
        return (string)$this->getPromotion();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * @param int $promotion
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * @return bool
     */
    public function isActivated()
    {
        return $this->activated;
    }

    /**
     * @param bool $activated
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add messages
     *
     * @param \Application\YearbookBundle\Entity\YearbookMessages $messages
     */
    public function addMessage(\Application\YearbookBundle\Entity\YearbookMessages $messages)
    {
        $this->messages->add($messages);
    }

    /**
     * Remove message
     * @param \Application\YearbookBundle\Entity\YearbookMessages $messages
     */
    public function removeMessage(\Application\YearbookBundle\Entity\YearbookMessages $messages)
    {
        $this->messages->removeElement($messages);
    }

}