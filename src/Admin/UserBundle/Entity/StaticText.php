<?php


namespace Admin\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StaticText
 * With this object, Admin can easily change several texts on the website like homepage text, agenda text, etc.
 * He can include HTML code in the staticText field, Twig will do the job !
 *
 * Id used on twig :
 * 1 - Homepage, welcome text
 * 2 - Events, beside homepage welcome text
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class StaticText
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
    private $name; //Head Title if there is one, else it's just there to describe (ex : "Bienvenue" "Texte d'acceuil"

    /**
     * @var string
     *
     * @ORM\Column(name="static_text", type="text")
     */
    private $staticText; //The text/html you want to display


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
     * @return StaticText
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
     * @param string $staticText
     *
     * @return StaticText
     */
    public function setStaticText($staticText)
    {
        $this->staticText = $staticText;

        return $this;
    }

    /**
     * Get staticText
     *
     * @return string
     */
    public function getStaticText()
    {
        return $this->staticText;
    }
}

