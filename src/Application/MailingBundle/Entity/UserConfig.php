<?php
namespace Application\MailingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Permet de retenir les choix de chaque utilisateur de l'application
 * sur ces abonnements aux ML
 *
 * @ORM\Table(name="mailing_userConfig")
 * @ORM\Entity(repositoryClass="Application\MailingBundle\Entity\UserConfigRepository")
 */
class UserConfig {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer"); 
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Admin\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;
    
    /**
     * Indique si l'utilisateur est abonné à une ML
     * 
     * @ORM\Column(type="boolean")
     */
    private $isChecked = false;
    
    /**
     * Indique à quelles ML l'utilisateur est abonné
     * 
     *  @ORM\ManyToMany(targetEntity="Admin\MailingBundle\Entity\MailingList", inversedBy="abonnes")
     */
    private $choices;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->choices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set isChecked
     *
     * @param boolean $isChecked
     * @return UserConfig
     */
    public function setIsChecked($isChecked)
    {
        $this->isChecked = $isChecked;

        return $this;
    }

    /**
     * Get isChecked
     *
     * @return boolean 
     */
    public function getIsChecked()
    {
        return $this->isChecked;
    }

    /**
     * Set userId
     *
     * @param \Admin\MailingBundle\Entity\Admin/UserBundle/Entity/User $userId
     * @return UserConfig
     */
    public function setUserId(\Admin\UserBundle\Entity\User $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \Admin\MailingBundle\Entity\Admin/UserBundle/Entity/User 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Add choices
     *
     * @param \Admin\MailingBundle\Entity\MailingList $choices
     * @return UserConfig
     */
    public function addChoice(\Admin\MailingBundle\Entity\MailingList $choices)
    {
        $this->choices[] = $choices;

        return $this;
    }

    /**
     * Remove choices
     *
     * @param \Admin\MailingBundle\Entity\MailingList $choices
     */
    public function removeChoice(\Admin\MailingBundle\Entity\MailingList $choices)
    {
        $this->choices->removeElement($choices);
    }

    /**
     * Get choices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return UserConfig
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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

    public function __toString()
    {
        return ("un certain nombre");
    }

}
