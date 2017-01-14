<?php

namespace Application\CareerBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Career
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Career
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
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255, nullable=true)
     */
    private $localisation;

    /**
     * @var string
     *
     * @ORM\Column(name="institution", type="string", length=255)
     * @Assert\NotNull(
     *     message = "Etablissement obligatoire."
     * )
     */
    private $institution;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255)
     * @Assert\NotNull(
     *     message = "Poste obligatoire."
     * )
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\NotNull(
     *     message = "Date obligatoire."
     * )
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Application\CareerBundle\Entity\TypeCareer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeCareer;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\UserBundle\Entity\User", inversedBy="careers")
     */
    private $user;

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
     * Set description
     *
     * @param string $description
     * @return Career
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
     * Set date
     *
     * @param \DateTime $date
     * @return Career
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set user
     *
     * @param \Admin\UserBundle\Entity\User $user
     * @return Career
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
     * Set typeCareer
     *
     * @param \Application\CareerBundle\Entity\TypeCareer $typeCareer
     * @return Career
     */
    public function setTypeCareer(\Application\CareerBundle\Entity\TypeCareer $typeCareer)
    {
        $this->typeCareer = $typeCareer;

        return $this;
    }

    /**
     * Get typeCareer
     *
     * @return \Application\CareerBundle\Entity\TypeCareer 
     */
    public function getTypeCareer()
    {
        return $this->typeCareer;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return Career
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set localisation
     *
     * @param string $localisation
     * @return Career
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string 
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set institution
     *
     * @param string $institution
     * @return Career
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution
     *
     * @return string 
     */
    public function getInstitution()
    {
        return $this->institution;
    }
}
