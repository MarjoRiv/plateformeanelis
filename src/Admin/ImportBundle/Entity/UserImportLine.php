<?php

namespace Admin\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserImportLine
 *
 * @ORM\Table(name="user_import_line")
 * @ORM\Entity(repositoryClass="Admin\ImportBundle\Repository\UserImportLineRepository")
 */
class UserImportLine
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
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="promo", type="string", length=255)
     */
    private $promo;

    /**
     * @var string
     *
     * @ORM\Column(name="filliere", type="string", length=255)
     */
    private $filliere;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\ImportBundle\Entity\UserImport", inversedBy="lines")
     */
    private $import;

    /**
     * @ORM\OneToOne(targetEntity="Admin\ImportBundle\Entity\UserImportLineError")
     */
    private $errors;

    /**
     * @var int
     * @ORM\Column(name="action", type="integer")
     */
    private $action;



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
     * Set login
     *
     * @param string $login
     *
     * @return UserImportLine
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return UserImportLine
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return UserImportLine
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return UserImportLine
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set promo
     *
     * @param string $promo
     *
     * @return UserImportLine
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return string
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * Set filliere
     *
     * @param string $filliere
     *
     * @return UserImportLine
     */
    public function setFilliere($filliere)
    {
        $this->filliere = $filliere;

        return $this;
    }

    /**
     * Get filliere
     *
     * @return string
     */
    public function getFilliere()
    {
        return $this->filliere;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return UserImportLine
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return UserImportLine
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}

