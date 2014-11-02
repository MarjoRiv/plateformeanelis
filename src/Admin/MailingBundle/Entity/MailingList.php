<?php

namespace Admin\MailingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Table(name="mailing_mailinglist")
 * @ORM\Entity(repositoryClass="Admin\MailingBundle\Entity\MailingListRepository")
 */
class MailingList {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * Nom de la Mailing List
     * @ORM\Column(type="string", length=200)
     */
    private $name = "inconnu";
    
    /**
     * @ORM\Column(type="boolean")      
     */
    private $checked = false;
    
    /**
     * Utilisateurs de la plateforme abonnés à cette ML
     * 
     * @ORM\ManyToMany(targetEntity="Application\MailingBundle\Entity\UserConfig", mappedBy="choices")
     */
    private $abonnes;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->abonnes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return MailingList
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set checked
     *
     * @param boolean $checked
     * @return MailingList
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return boolean 
     */
    public function getChecked()
    {
        return $this->checked;
    }

   
    /**
     * Add abonnes
     *
     * @param \Application\MailingBundle\Entity\UserConfig $abonnes
     * @return MailingList
     */
    public function addAbonnes( \Application\MailingBundle\Entity\UserConfig $abonnes)
    {
        $this->abonnes[] = $abonnes;

        return $this;
    }

    /**
     * Remove abonnes
     *
     * @param \Application\MailingBundle\Entity\UserConfig $abonnes
     */
    public function removeAbonnes( \Application\MailingBundle\Entity\UserConfig $abonnes)
    {
        $this->abonnes->removeElement($abonnes);
    }

    /**
     * Get abonnesd
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAbonnes()
    {
        return $this->abonnes;
    }

}
