<?php

namespace Admin\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserImport
 *
 * @ORM\Table(name="user_import")
 * @ORM\Entity(repositoryClass="Admin\ImportBundle\Repository\UserImportRepository")
 */
class UserImport
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
     * @ORM\Column(name="createdDate", type="date")
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastRunDate", type="date", nullable=true)
     */
    private $lastRunDate;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer")
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="Admin\ImportBundle\Entity\UserImportLine", mappedBy="import", cascade={"remove", "persist"}))
     */
    private $lines;


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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return UserImport
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set lastRunDate
     *
     * @param \DateTime $lastRunDate
     *
     * @return UserImport
     */
    public function setLastRunDate($lastRunDate)
    {
        $this->lastRunDate = $lastRunDate;

        return $this;
    }

    /**
     * Get lastRunDate
     *
     * @return \DateTime
     */
    public function getLastRunDate()
    {
        return $this->lastRunDate;
    }


    public function getState()
    {
        return $this->state;
    }


    public function setState(int $state): void
    {
        $this->state = $state;
    }

    public function getLines()
    {
        return $this->lines;
    }

    public function addLine(UserImportLine $line)
    {
        $this->lines[] = $line;
    }
}

