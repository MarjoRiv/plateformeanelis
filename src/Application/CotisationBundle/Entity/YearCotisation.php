<?php

namespace Application\CotisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * YearCotisation
 *
 * @ORM\Table(name="year_cotisation")
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
     * @ORM\Column(name="year", type="date")
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
     *
     * @return YearCotisation
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return YearCotisation
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
     * Set dateEnabled
     *
     * @param \DateTime $dateEnabled
     *
     * @return YearCotisation
     */
    public function setDateEnabled($dateEnabled)
    {
        $this->dateEnabled = $dateEnabled;

        return $this;
    }

    /**
     * Get dateEnabled
     *
     * @return \DateTime
     */
    public function getDateEnabled()
    {
        return $this->dateEnabled;
    }
}

