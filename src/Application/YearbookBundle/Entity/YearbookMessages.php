<?php
/**
 * Created by PhpStorm.
 * User: Marjorie
 * Date: 04/01/2019
 * Time: 11:41
 */

namespace Application\YearbookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * YearbookMessages
 *
 * @ORM\Table()
 * @ORM\Entity
 */

class YearbookMessages
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
     * @var $userFrom
     *
     * @ORM\ManyToOne(targetEntity="Admin\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userFrom;

    /**
     * @var $userTo
     *
     * @ORM\ManyToOne(targetEntity="Admin\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userTo;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     * @Assert\NotNull(
     *     message = "Message obligatoire."
     * )
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="Application\YearbookBundle\Entity\Yearbook", inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $yearbook;
    /**
     * @var \DateTime
     * @ORM\Column(name="createDate", type="datetime")
     */
    private  $createDate;

    /**
     * YearbookMessage constructor
     */

    public function __construct() {
        $this->createDate=new \DateTime();
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
     * Set message
     *
     * @param string $message
     * @return YearbookMessages
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set userFrom
     *
     * @param \Admin\UserBundle\Entity\User $userFrom
     * @return YearbookMessages
     */
    public function setUserFrom(\Admin\UserBundle\Entity\User $userFrom)
    {
        $this->userFrom = $userFrom;

        return $this;
    }

    /**
     * Get userFrom
     *
     * @return \Admin\UserBundle\Entity\User
     */
    public function getUserFrom()
    {
        return $this->userFrom;
    }

    /**
     * Set userTo
     *
     * @param \Admin\UserBundle\Entity\User $userTo
     * @return YearbookMessages
     */
    public function setUserTo(\Admin\UserBundle\Entity\User $userTo)
    {
        $this->userTo = $userTo;

        return $this;
    }

    /**
     * Get userTo
     *
     * @return \Admin\UserBundle\Entity\User
     */
    public function getUserTo()
    {
        return $this->userTo;
    }

    /**
     * Set yearbook
     *
     * @param \Application\YearbookBundle\Entity\Yearbook $yearbook
     * @return YearbookMessages
     */
    public function setYearbook(\Application\YearbookBundle\Entity\Yearbook $yearbook)
    {
        $this->yearbook = $yearbook;

        return $this;
    }

    /**
     * Get yearbook
     *
     * @return \Application\YearbookBundle\Entity\Yearbook
     */
    public function getYearbook()
    {
        return $this->yearbook;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

}