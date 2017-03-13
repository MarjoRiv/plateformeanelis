<?php

namespace Application\CotisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * YearCotisation
 *
 * @ORM\Table(name="YearCotisation")
 * @ORM\Entity(repositoryClass="Application\CotisationBundle\Repository\YearCotisationRepository")
 */
class YearCotisation
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
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date", unique=true)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnabled", type="datetime")
     */
    private $dateEnabled;

    /**
     * @ORM\OneToMany(targetEntity="Application\CotisationBundle\Entity\TypeCotisation", mappedBy="yearCotisation")
     */
    private $typeCotisation;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param \DateTime $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnabled()
    {
        return $this->dateEnabled;
    }

    /**
     * @param \DateTime $dateEnabled
     */
    public function setDateEnabled($dateEnabled)
    {
        $this->dateEnabled = $dateEnabled;
    }

    function __toString()
    {
        return $this->getName();
    }


}

