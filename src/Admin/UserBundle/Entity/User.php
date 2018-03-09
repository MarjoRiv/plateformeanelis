<?php

namespace Admin\UserBundle\Entity;

use Application\CotisationBundle\Entity\Cotisation;
use Admin\MailingBundle\Entity\Newsletter;
use Application\MainBundle\Entity\Image;
use Doctrine\ORM\Mapping as ORM; // To check
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotNull(
     *     message = "Le nom est obligatoire."
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="maritalName", type="string", length=255, nullable=true)
     */
    private $maritalName;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     * @Assert\NotNull(
     *     message = "Le prénom est obligatoire"
     * )
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=60, nullable=true)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="promotion", type="string", length=255)
     */
    private $promotion;

    /**
     * @var string
     *
     * @ORM\Column(name="filiere", type="string", length=255)
     */
    private $filiere;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text",nullable=true )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=255, nullable=true)
     */
    private $postalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\ManyToOne(targetEntity="Application\MainBundle\Entity\Image", cascade={"persist"})
     * @Constraints\Valid()
     */
    private $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="socialFacebook", type="string", length=255, nullable=true)
     */
    private $socialFacebook;

    /**
     * @var string
     *
     * @ORM\Column(name="socialTwitter", type="string", length=255, nullable=true)
     */
    private $socialTwitter;

    /**
     * @var string
     *
     * @ORM\Column(name="socialLinkedin", type="string", length=255, nullable=true)
     */
    private $socialLinkedin;

    /**
     * @var string
     *
     * @ORM\Column(name="socialGoogle", type="string", length=255, nullable=true)
     */
    private $socialGoogle;

    /**
     * @var string
     *
     * @ORM\Column(name="socialYoutube", type="string", length=255, nullable=true)
     */
    private $socialYoutube;

    /**
     * @var string
     *
     * @ORM\Column(name="socialInstagram", type="string", length=255, nullable=true)
     */
    private $socialInstagram;

    /**
     * @var string
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     */
    private $biography;

    /**
     * @var date $birthday
     *
     * @ORM\Column(name="birthday", type="date", length=255)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="maritalStatus", type="string", length=255, nullable=true)
     */
    private $maritalStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="childrenNumber", type="integer", length=255, nullable=true)
     */
    private $childrenNumber;

    /**
     * @ORM\OneToMany(targetEntity="Application\CotisationBundle\Entity\Cotisation", mappedBy="user")
     */
    private $cotisations;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity="Application\CareerBundle\Entity\Career", mappedBy="user")
     */
    private $careers;

    /**
     * @var string
     * @Assert\Email(
     *     message = "Adresse email invalide"
     * )
     */
    protected $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEmailValid", type="boolean", nullable=true)
     */
    protected $isEmailValid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAlive", type="boolean", nullable=true)
     */
    protected $isAlive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isGraduated", type="boolean", nullable=true)
     */
    protected $isGraduated;

    /**
     * @var ArrayCollection Admin\MailingBundle\Entity\Newsletter $newsletters
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Admin\MailingBundle\Entity\Newsletter", inversedBy="users", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="subscriber",
     *   joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="newsletter_id", referencedColumnName="id")}
     * )
     */
    private $newsletters;

    public function __construct()
    {
        parent::__construct();
        $this->email                = "";
        $this->name                 = "";
        $this->maritalName          = "";
        $this->surname              = "";
        $this->nickname             = "";
        $this->address              = "";
        $this->isEmailValid         = true;
        $this->isAlive              = true;
        $this->isGraduated          = true;
        $this->telephone            = "";
        $this->website              = "";
        $this->promotion            = "";
        $this->filiere              = "";
        $this->socialFacebook       = "";
        $this->socialTwitter        = "";
        $this->socialLinkedin       = "";
        $this->socialGoogle         = "";
        $this->socialYoutube        = "";
        $this->socialInstagram      = "";
        $this->biography            = "";
        $this->birthday             = new \DateTime();
        $this->maritalStatus        = "";
        $this->childrenNumber       = 0;
        $this->postalcode           = "";
        $this->city                 = "";
        $this->country              = "";
        $this->genre                = "";
        $this->enabled              = true;
        $this->expired              = false;
        $this->locked               = false;

        $this->avatar               = new Image();
        $this->avatar->setMandatory(false);
        $this->avatar->setFilter(Image::$FILTER_USER_AVATAR);
        $this->newsletters          = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cotisations          = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return User
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
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
	
	/**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isEmailValid
     *
     * @param boolean $isEmailValid
     * @return User
     */
    public function setIsEmailValid($isEmailValid)
    {
        $this->isEmailValid = $isEmailValid;

        return $this;
    }

    /**
     * Get isEmailValid
     *
     * @return boolean 
     */
    public function getIsEmailValid()
    {
        return $this->isEmailValid;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set avatar
     *
     * @param \Application\MainBundle\Entity\Image $avatar
     * @return User
     */
    public function setAvatar(\Application\MainBundle\Entity\Image $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \Application\MainBundle\Entity\Image 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set biography
     *
     * @param string $biography
     * @return User
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string 
     */
    public function getBiography()
    {
        return $this->biography;
    }



    /**
     * Set socialFacebook
     *
     * @param string $socialFacebook
     * @return User
     */
    public function setSocialFacebook($socialFacebook)
    {
        $this->socialFacebook = $socialFacebook;

        return $this;
    }

    /**
     * Get socialFacebook
     *
     * @return string 
     */
    public function getSocialFacebook()
    {
        return $this->socialFacebook;
    }

    /**
     * Set socialTwitter
     *
     * @param string $socialTwitter
     * @return User
     */
    public function setSocialTwitter($socialTwitter)
    {
        $this->socialTwitter = $socialTwitter;

        return $this;
    }

    /**
     * Get socialTwitter
     *
     * @return string 
     */
    public function getSocialTwitter()
    {
        return $this->socialTwitter;
    }

    /**
     * Set socialLinkedin
     *
     * @param string $socialLinkedin
     * @return User
     */
    public function setSocialLinkedin($socialLinkedin)
    {
        $this->socialLinkedin = $socialLinkedin;

        return $this;
    }

    /**
     * Get socialLinkedin
     *
     * @return string 
     */
    public function getSocialLinkedin()
    {
        return $this->socialLinkedin;
    }

    /**
     * Set promotion
     *
     * @param string $promotion
     * @return User
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return string 
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    public function getIntPromotion()
    {
        return intval($this->promotion);
    }

    /**
     * Set filiere
     *
     * @param string $filiere
     * @return User
     */
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere
     *
     * @return string 
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Set maritalName
     *
     * @param string $maritalName
     * @return User
     */
    public function setMaritalName($maritalName)
    {
        $this->maritalName = $maritalName;

        return $this;
    }

    /**
     * Get maritalName
     *
     * @return string 
     */
    public function getMaritalName()
    {
        return $this->maritalName;
    }

    /**
     * Set maritalStatus
     *
     * @param string $maritalStatus
     * @return User
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return string 
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * Set childrenNumber
     *
     * @param string $childrenNumber
     * @return User
     */
    public function setChildrenNumber($childrenNumber)
    {
        $this->childrenNumber = $childrenNumber;

        return $this;
    }

    /**
     * Get childrenNumber
     *
     * @return string 
     */
    public function getChildrenNumber()
    {
        return $this->childrenNumber;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Add cotisations
     *
     * @param \Application\CotisationBundle\Entity\Cotisation $cotisations
     * @return User
     */
    public function addCotisation(\Application\CotisationBundle\Entity\Cotisation $cotisations)
    {
        $this->cotisations[] = $cotisations;

        return $this;
    }

    /**
     * Remove cotisations
     *
     * @param \Application\CotisationBundle\Entity\Cotisation $cotisations
     */
    public function removeCotisation(\Application\CotisationBundle\Entity\Cotisation $cotisations)
    {
        $this->cotisations->removeElement($cotisations);
    }

    /**
     * Get cotisations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCotisations()
    {
        return $this->cotisations;
    }

    /**
     * Set postalcode
     *
     * @param string $postalcode
     * @return User
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode
     *
     * @return string 
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return bool
     */
    public function isCotisant()
    {
        $cotisations = array_reverse($this->getCotisations()->toArray());
        foreach ($cotisations as $value) {
            if ($value->isPayed() && $value->getYearCotisation()->getYear() == date('Y'))
                return true;
        }
        return false;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return User
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Add careers
     *
     * @param \Application\CareerBundle\Entity\Career $careers
     * @return User
     */
    public function addCareer(\Application\CareerBundle\Entity\Career $careers)
    {
        $this->careers[] = $careers;

        return $this;
    }

    /**
     * Remove careers
     *
     * @param \Application\CareerBundle\Entity\Career $careers
     */
    public function removeCareer(\Application\CareerBundle\Entity\Career $careers)
    {
        $this->careers->removeElement($careers);
    }

    /**
     * Get careers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCareers()
    {
        return $this->careers;
    }


    public function getLastCareer()
    {
        $careers = $this->getCareers()->toArray();

        usort($careers, function ($a, $b) {
            return strcmp($a->getTypeCareer()->getId(), $b->getTypeCareer()->getId());
        });

        if (count($careers) > 0) {
            $lastCareer = $careers[0];
            $lastCareerTypeId = $careers[0]->getTypeCareer()->getId();
            foreach($careers as $career) {
                if ($career->getTypeCareer()->getId() != $lastCareerTypeId) {
                    break;
                }
                if ($career->getDate() > $lastCareer->getDate()) {
                    $lastCareer = $career;
                }
            }
            return "". $lastCareer->getPosition() . ", <strong>" . $lastCareer->getInstitution() . "</strong>";

        }
        

        return "";
    }

    /**
     * Set socialGoogle
     *
     * @param string $socialGoogle
     * @return User
     */
    public function setSocialGoogle($socialGoogle)
    {
        $this->socialGoogle = $socialGoogle;

        return $this;
    }

    /**
     * Get socialGoogle
     *
     * @return string 
     */
    public function getSocialGoogle()
    {
        return $this->socialGoogle;
    }

    /**
     * Set socialYoutube
     *
     * @param string $socialYoutube
     * @return User
     */
    public function setSocialYoutube($socialYoutube)
    {
        $this->socialYoutube = $socialYoutube;

        return $this;
    }

    /**
     * Get socialYoutube
     *
     * @return string 
     */
    public function getSocialYoutube()
    {
        return $this->socialYoutube;
    }

    /**
     * Set socialInstagram
     *
     * @param string $socialInstagram
     * @return User
     */
    public function setSocialInstagram($socialInstagram)
    {
        $this->socialInstagram = $socialInstagram;

        return $this;
    }

    /**
     * Get socialInstagram
     *
     * @return string 
     */
    public function getSocialInstagram()
    {
        return $this->socialInstagram;
    }


    /**
     * Get expiresAt
     *
     * @return \DateTime 
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentials_expire_at
     *
     * @return \DateTime 
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }



    /**
     * Set isAlive
     *
     * @param boolean $isAlive
     * @return User
     */
    public function setIsAlive($isAlive)
    {
        $this->isAlive = $isAlive;

        return $this;
    }

    /**
     * Get isAlive
     *
     * @return boolean 
     */
    public function getIsAlive()
    {
        return $this->isAlive;
    }

    /**
     * Set isGraduated
     *
     * @param boolean $isGraduated
     * @return User
     */
    public function setIsGraduated($isGraduated)
    {
        $this->isGraduated = $isGraduated;

        return $this;
    }

    /**
     * Get isGraduated
     *
     * @return boolean 
     */
    public function getIsGraduated()
    {
        return $this->isGraduated;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    function __toString()
    {
        return $this->getName().' '.$this->getSurname(). ' - '.$this->getPromotion();
    }

    /**
     * @param int $year
     * @return Cotisation
     */
    function getCotisationByYear($year)
    {
        foreach($this->getCotisations() as $cotisation )
        {
            if($cotisation->getYearCotisation()->getYear() == $year)
            {
                return $cotisation;
            }
        }

        return null;
    }


    /**
    * Add Newsletter
    *
    * @param \Admin\MailingBundle\Entity\Newsletter $newsletter
    */
    public function addNewsletter(\Admin\MailingBundle\Entity\Newsletter $newsletter)
    {
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->newsletters->contains($newsletter)) {
            $this->newsletters->add($newsletter);
        }
    }
 
    public function setNewsletters($items)
    {
        if ($items instanceof ArrayCollection || is_array($items)) {
            foreach ($items as $item) {
                $this->addNewsletter($item);
            }
        } elseif ($items instanceof Admin\MailingBundle\Entity\Newsletter) {
            $this->addNewsletter($items);
        } else {
            throw new Exception("$items must be an instance of newsletters or ArrayCollection");
        }
    }
 
    /**
     * Get ArrayCollection
     *
     * @return ArrayCollection $newsletters
     */
    public function getNewsletters()
    {
        return $this->newsletters;
    }
}
