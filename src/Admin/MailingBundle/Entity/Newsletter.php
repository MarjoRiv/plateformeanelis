<?php

namespace Admin\MailingBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Admin\UserBundle\Entity\User;
use Symfony\Component\Config\Definition\Exception\Exception;
/**
 * newsletter
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity
*/
class Newsletter
{
	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="newsletter", type="string", length=255)
     */
    private $newsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="Frequence", type="string", length=255)
     */
    private $frequence;

    /**
     * @var ArrayCollection Newsletter $users
     * Inverse Side
     *
     * @ORM\ManyToMany(targetEntity="Admin\UserBundle\Entity\User", mappedBy="newsletters", cascade={"persist", "merge"})
     */
    private $users;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mailjet_id", type="string")
     */
    private $mailjet_id = "0";

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Events
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


    /**
     * Set newsletter
     *
     * @param string $newsletter
     *
     * @return Events
     */
    public function setnewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return string
     */
    public function getnewsletter()
    {
        return $this->newsletter;
    }
    public function __toString() {
        return $this->newsletter."\n  ".$this->getcommentaire(). " \n ".$this->getfrequence();
    }
    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Events
     */
    public function setcommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getcommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set frequence
     *
     * @param string $frequence
     *
     * @return Events
     */
    public function setfrequence($frequence)
    {
        $this->frequence = $frequence;

        return $this;
    }

    /**
     * Get frequence
     *
     * @return string
     */
    public function getfrequence()
    {
        return $this->frequence;
    }

    public function setMailjetId($id)
    {
        $this->mailjet_id = $id;

        return $this;
    }

    /**
     * Get mailjet_id
     *
     * @return string 
     */
    public function getMailjetId()
    {
        return $this->mailjet_id;
    }


    /**
     * Add User
     *
     * @param \Admin\UserBundle\Entity\User $user
     */
    public function adduser(\Admin\UserBundle\Entity\User $user)
    {
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->users->contains($user)) {
            if (!$user->getNewsletters()->contains($this)) {
                $user->addNewsletter($this);  
            }
            $this->users->add($user);
        }
    }
 
    public function setUsers($items)
    {
        try{
            if ($items instanceof \Admin\UserBundle\Entity\User) {
                $this->addUser($items);
            }else{
                foreach ($items as $item) {
                    $this->addUser($item);
                }
            }
        }catch(Exception $e){
            throw new Exception("$e must be an instance of User or ArrayCollection");
        }

    }
 
    /**
     * Get ArrayCollection
     *
     * @return ArrayCollection $users
     */
    public function getUsers()
    {
        return $this->users;
    }





    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
}


?>