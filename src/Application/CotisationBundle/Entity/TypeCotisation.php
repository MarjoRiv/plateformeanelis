<?php

namespace Application\CotisationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeCotisation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TypeCotisation
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Application\CotisationBundle\Entity\YearCotisation", inversedBy="typeCotisation")
     */
    private $yearCotisation;

    /**
     * @ORM\OneToMany(targetEntity="Application\CotisationBundle\Entity\Cotisation", mappedBy="typeCotisation")
     */
    private $cotisation;

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
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return \Application\CotisationBundle\Entity\YearCotisation
     */
    public function getYearCotisation()
    {
        return $this->yearCotisation;
    }

    /**
     * @param mixed $yearCotisation
     */
    public function setYearCotisation($yearCotisation)
    {
        $this->yearCotisation = $yearCotisation;
    }



    function __toString()
    {
        return $this->getName();
    }


}
