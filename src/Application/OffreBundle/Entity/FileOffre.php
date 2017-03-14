<?php

namespace Application\OffreBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FileOffre
 *
 * @ORM\Table(name="file_offre")
 * @ORM\Entity(repositoryClass="Application\OffreBundle\Repository\FileOffreRepository")
 */
class FileOffre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=127, nullable=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @Assert\File(maxSize="1M")
     */
    public $file;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return FileOffre
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return FileOffre
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function __construct() 
    {
        $this->filename="";
        $this->path="";
    }

    public function getWebPath()
    {
        if (!$this->path || empty($this->path))
            return "";
        else
            return './../../' .$this->getUploadDir() . '/' . $this->getId() . '-' . $this->getFilename();
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/offres';
    }

    public function taillefile()
    {
        $size=filesize($this->file);
        return $size;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null === $this->file) {
            return;
        }
        if (null !== $this->file) {
            $this->path = $this->file->guessExtension();
            $this->filename = $this->file->getClientOriginalName();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        
        if (null === $this->file) {
            return;
        }
        if (null != $this->filename) {
            $oldFile = $this->getWebPath();
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        $this->file->move($this->getUploadDir(), $this->getUploadDir() . '/' . $this->id . '-' . $this->getFilename());
    }

     /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        return __DIR__.'/../../../../web/' .$this->getUploadDir() . '/' . $this->getId() . '-' . $this->getFilename();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $location = $this->preRemoveUpload();
        if (file_exists($location)) {
            unlink($location);
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() .'/'. $this->getUploadDir() . '/' . $this->getId() . '-' . $this->getFilename();
    }


}

