<?php


namespace Admin\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parameters
 * With this object, Admin can easily change several texts on the website like homepage text, agenda text, etc.
 * He can include HTML code in the staticText field, Twig will do the job !
 *
 * Id used on twig :
 * 1 - Homepage, welcome text
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Parameters
{
    /**
     * @var integer Id du paramètre
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string Nom du paramètre pour le retrouver plus facilement
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string Type à titre informatif
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string valeure
     *
     * @ORM\Column(name="value", type="text")
     */
    private $value;


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
     *
     * @return Parameters
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
     * Set staticText
     *
     * @param string $value
     *
     * @return Parameters
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get staticText
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
    }


}

