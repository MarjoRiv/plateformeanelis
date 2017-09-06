<?php

namespace Application\OffreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OffreVar
 *
 * @ORM\Table(name="offre_var")
 * @ORM\Entity(repositoryClass="Application\OffreBundle\Repository\OffreVarRepository")
 */
class OffreVar
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="variable", type="integer")
     */
    private $variable;


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
     * Set name
     *
     * @param string $name
     *
     * @return OffreVar
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
     * Set variable
     *
     * @param integer $variable
     *
     * @return OffreVar
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * Get variable
     *
     * @return int
     */
    public function getVariable()
    {
        return $this->variable;
    }
}

