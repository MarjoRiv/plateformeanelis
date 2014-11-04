<?php

namespace Application\SocialBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="userSocial")
 */
class UserSocial
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
     *@ORM\ManyToOne(targetEntity="Admin\UserBundle\Entity\User", inversedBy="userSocials")
     */
    private $user;

    /**
     *@ORM\ManyToOne(targetEntity="Admin\SocialBundle\Entity\Social")
     */
    private $social;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

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
     * Set user
     *
     * @param  \Admin\UserBundle\Entity\User $user
     * @return UserSocial
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
     * Set social
     *
     * @param  \Admin\SocialBundle\Entity\Social $social
     * @return UserSocial
     */
    public function setSocial(\Admin\SocialBundle\Entity\Social $social = null)
    {
        $this->social = $social;

        return $this;
    }

    /**
     * Get social
     *
     * @return \Admin\SocialBundle\Entity\Social
     */
    public function getSocial()
    {
        return $this->social;
    }

    /**
     * Set value
     *
     * @param  string  $value
     * @return UserSocial
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

}

?>