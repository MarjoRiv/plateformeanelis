<?php

namespace Application\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Assert;
use Symfony\Component\Validator\ExecutionContextInterface;


/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Application\MainBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    public static $FILTER_USER_AVATAR = "user_avatar";
    
    public static $DEFAULT_USER_AVATAR = "img/user.png";
    public static $DEFAULT = "img/image-unavailable.jpg";
    
    public static function getDefaultWebPathByFilter($filter) {
        $link = "";
        
        switch ($filter) {
            case Image::$FILTER_USER_AVATAR:
                $link = Image::$DEFAULT_USER_AVATAR;
                break;
            default:
                $link = Image::$DEFAULT;
                break;
        }
        
        return $link;
    }
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="updated", type="boolean")
     */
    private $updated;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="filter", type="string", length=255)
     */
    private $filter;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation", type="datetime")
     */
    private $creation;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mandatory", type="boolean")
     */
    private $mandatory;
    
    /**
     * @Constraints\Image(maxSize="1M")
     * @var UploadedFile
     */
    private $input;
    
    /**
     * @var $tempFileName
     */
    private $tempFilename;


    /**
     * Construct
     */
    public function __construct() {
        $this->mandatory = true;
        $this->input = null;
        $this->filter = "user_avatar";
        $this->creation = new \DateTime();
        $this->description = "";
        $this->extension = "";
        $this->name = "";
        $this->updated = false;
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
     * @return Image
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
     * Set extension
     *
     * @param string $extension
     * @return Image
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string 
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Image
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
     * Set creation
     *
     * @param \DateTime $creation
     * @return Image
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;

        return $this;
    }

    /**
     * Get creation
     *
     * @return \DateTime 
     */
    public function getCreation()
    {
        return $this->creation;
    }
    
    /**
     * 
     * @param UploadedFile $image
     */
    public function setInput(UploadedFile $input) {
        $this->input = $input;
        
        if ($this->input != null) {
            $this->updated = !$this->updated;
        }
        
        if (null !== $this->extension) {
            $this->tempFilename = $this->extension;
            $this->name = "";
        }
    }
    
    /**
     * @return UploadedFile
     */
    public function getInput() {
        return $this->input;
    }

    /**
     * Set mandatory
     *
     * @param boolean $mandatory
     * @return Image
     */
    public function setMandatory($mandatory)
    {
        $this->mandatory = $mandatory;

        return $this;
    }

    /**
     * Get mandatory
     *
     * @return boolean 
     */
    public function getMandatory()
    {
        return $this->mandatory;
    }
    
    /**
     * Check if an image is correct
     *
     * @Callback
     */
    public function imageValid(\Symfony\Component\Validator\Context\ExecutionContextInterface $context, $payload) {
        if ($this->mandatory && empty($this->extension) && $this->input == null)
            $context->buildViolation('Il faut obligatoirement une image')->atPath('input')->addViolation();
            //$context->addViolationAt('input', 'Il faut obligatoirement une image.', array(), null);
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null != $this->input) {
            $this->extension = $this->input->guessExtension();
            $this->name = $this->input->getClientOriginalName();
        }
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null != $this->input) {
            if (null != $this->tempFilename) {
                $oldFile = $this->getUploadDir() . '/' . $this->id . '.' . $this->tempFilename;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
        
            $this->input->move($this->getUploadDir(), $this->id . '.' . $this->extension);
        }
    }
    
    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFilename = $this->getUploadDir() . '/' . $this->id . '.' . $this->extension;
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFilename)) {
            unlink($this->tempFilename);
        }
    }
    
    public function getUploadDir()
    {
        return 'uploads/img';
    }
    
    public function getWebPath()
    {
        if (!$this->extension || empty($this->extension))
            return "";
        else
            return $this->getUploadDir() . '/' . $this->id . '.' . $this->extension;
    }
    
    public function getDefaultWebPath()
    {
        return Image::getDefaultWebPathByFilter($this->filter);
    }

    /**
     * Set updated
     *
     * @param boolean $updated
     * @return Image
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return boolean 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set filter
     *
     * @param string $filter
     * @return Image
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return string 
     */
    public function getFilter()
    {
        return $this->filter;
    }
}
