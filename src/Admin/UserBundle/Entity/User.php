<?php

namespace Admin\UserBundle\Entity;

use Symfony\Component\Validator\Constraints; // To check
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Application\MainBundle\Entity\Image;
use FOS\ElasticaBundle\Configuration\Search;

/**
 * User
 *
 * @ORM\Table()
 * @Search(repositoryClass="Application\AnnuaireBundle\Entity\SearchRepository\UserRepository")
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
     * @ORM\Column(name="maritalName", type="string", length=255)
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
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=255)
     */
    private $postalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
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
     * @ORM\Column(name="website", type="string", length=255)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="socialFacebook", type="string", length=255)
     */
    private $socialFacebook;

    /**
     * @var string
     *
     * @ORM\Column(name="socialTwitter", type="string", length=255)
     */
    private $socialTwitter;

    /**
     * @var string
     *
     * @ORM\Column(name="socialLinkedin", type="string", length=255)
     */
    private $socialLinkedin;

    /**
     * @var string
     *
     * @ORM\Column(name="biography", type="text")
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
     * @ORM\Column(name="maritalStatus", type="string", length=255)
     */
    private $maritalStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="childrenNumber", type="integer", length=255)
     */
    private $childrenNumber;

    /**
     * @ORM\ManyToMany(targetEntity="Admin\UserBundle\Entity\Newsletters", inversedBy="users")
     * @ORM\JoinTable(name="newsletters_user", joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}, inverseJoinColumns={@ORM\JoinColumn(name="newsletters_id", referencedColumnName="id")})
     */
    protected $newsletters;

    /**
     * @ORM\OneToMany(targetEntity="Application\CotisationBundle\Entity\Cotisation", mappedBy="user")
     */
    private $cotisations;


    public function __construct()
    {
        parent::__construct();

        $this->name                 = "";
        $this->maritalName          = "";
        $this->surname              = "";
        $this->address              = "";
        $this->checked              = true;
        $this->telephone            = "";
        $this->website              = "";
        $this->promotion            = "";
        $this->filiere              = "";
        $this->socialFacebook       = "";
        $this->socialTwitter        = "";
        $this->socialLinkedin       = "";
        $this->biography            = "";
        $this->birthday             = "";
        $this->maritalStatus        = "";
        $this->childrenNumber       = 0;

        $this->enabled = true;
        $this->expired = false;
        $this->locked = false;

        $this->avatar = new Image();
        $this->avatar->setMandatory(false);
        $this->avatar->setFilter(Image::$FILTER_USER_AVATAR);

        $this->newsletters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cotisations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set checked
     *
     * @param boolean $checked
     * @return User
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
     * Set Newsletters
     *
     * @param \Doctrine\Common\Collections\Collection $newsletters
     * @return User
     */
    public function setNewsletters(\Doctrine\Common\Collections\Collection $newsletters = null)
    {
        $this->newsletters = $newsletters;
    
        return $this;
    }

    /**
     * Add Newsletters
     *
     * @param \Admin\UserBundle\Entity\Newsletters $newsletters
     * @return User
     */
    public function addNewsletters(\Admin\UserBundle\Entity\Newsletters $newsletters)
    {
        $this->newsletters[] = $newsletters;

        return $this;
    }

    /**
     * Remove Newsletters
     *
     * @param \Admin\UserBundle\Entity\Newsletters $newsletters
     */
    public function removeNewsletters(\Admin\UserBundle\Entity\Newsletters $newsletters)
    {
        $this->newsletters->removeElement($newsletters);
    }

    /**
     * Get Newsletters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNewsletters()
    {
        return $this->newsletters;
    }


    /**
     * Add newsletters
     *
     * @param \Admin\UserBundle\Entity\Newsletters $newsletters
     * @return User
     */
    public function addNewsletter(\Admin\UserBundle\Entity\Newsletters $newsletters)
    {
        $this->newsletters[] = $newsletters;

        return $this;
    }

    /**
     * Remove newsletters
     *
     * @param \Admin\UserBundle\Entity\Newsletters $newsletters
     */
    public function removeNewsletter(\Admin\UserBundle\Entity\Newsletters $newsletters)
    {
        $this->newsletters->removeElement($newsletters);
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
}
