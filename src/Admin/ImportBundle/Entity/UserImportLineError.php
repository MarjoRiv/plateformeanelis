<?php

namespace Admin\ImportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserImportLineError
 *
 * @ORM\Table(name="user_import_line_error")
 * @ORM\Entity(repositoryClass="Admin\ImportBundle\Repository\UserImportLineErrorRepository")
 */
class UserImportLineError
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
     * @var bool
     *
     * @ORM\Column(name="email_ko", type="boolean")
     */
    private $emailKo;

    /**
     * @var bool
     *
     * @ORM\Column(name="login_ko", type="boolean")
     * Dans un CREATE/UPDATE lorsque le login renseigné ne correspond pas au formalisme.
     * Peut survenir lorsque la promo est incorrecte et que le login est généré
     */
    private $loginKo;

    /**
     * @var bool
     *
     * @ORM\Column(name="login_not_found", type="boolean")
     * Dans un UPDATE lorsque le login n'est pas trouvé en base
     */
    private $loginNotFound;

    /**
     * @var bool
     * @ORM\Column(name="prenom_not_found", type="boolean")
     */
    private $prenomNotFound;

/**
     * @var bool
     * @ORM\Column(name="nom_not_found", type="boolean")
     */
    private $nomNotFound;

    /**
     * @var bool
     * @ORM\Column(name="login_already_exists", type="boolean")
     */
    private $loginAlreadyExists;

    /**
     * @var bool
     * @ORM\Column(name="promo_format_ko", type="boolean")
     */
    private $promoFormatKo;

    /**
     * @var bool
     * @ORM\Column(name="password_ko", type="boolean")
     */
    private $passwordKo;

    /**
     * @ORM\OneToOne(targetEntity="Admin\ImportBundle\Entity\UserImportLine")
     */
    private $line;

    public function __construct()
    {
        $this->emailKo = false;
        $this->loginKo = false;
        $this->loginNotFound = false;
        $this->prenomNotFound = false;
        $this->nomNotFound = false;
        $this->loginAlreadyExists = false;
        $this->promoFormatKo = false;
        $this->passwordKo = false;
    }


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
     * Set emailKo
     *
     * @param boolean $emailKo
     *
     * @return UserImportLineError
     */
    public function setEmailKo($emailKo)
    {
        $this->emailKo = $emailKo;

        return $this;
    }

    /**
     * Get emailKo
     *
     * @return bool
     */
    public function getEmailKo()
    {
        return $this->emailKo;
    }

    /**
     * Set loginKo
     *
     * @param boolean $loginKo
     *
     * @return UserImportLineError
     */
    public function setLoginKo($loginKo)
    {
        $this->loginKo = $loginKo;

        return $this;
    }

    /**
     * Get loginKo
     *
     * @return bool
     */
    public function getLoginKo()
    {
        return $this->loginKo;
    }

    /**
     * Set loginNotFound
     *
     * @param boolean $loginNotFound
     *
     * @return UserImportLineError
     */
    public function setLoginNotFound($loginNotFound)
    {
        $this->loginNotFound = $loginNotFound;

        return $this;
    }

    /**
     * Get loginNotFound
     *
     * @return bool
     */
    public function getLoginNotFound()
    {
        return $this->loginNotFound;
    }

    /**
     * @return bool
     */
    public function isPrenomNotFound(): bool
    {
        return $this->prenomNotFound;
    }

    /**
     * @param bool $prenomNotFound
     */
    public function setPrenomNotFound(bool $prenomNotFound): void
    {
        $this->prenomNotFound = $prenomNotFound;
    }

    /**
     * @return bool
     */
    public function isNomNotFound(): bool
    {
        return $this->nomNotFound;
    }

    /**
     * @param bool $nomNotFound
     */
    public function setNomNotFound(bool $nomNotFound): void
    {
        $this->nomNotFound = $nomNotFound;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param mixed $line
     */
    public function setLine($line): void
    {
        $this->line = $line;
    }

    /**
     * @return bool
     */
    public function isLoginAlreadyExists(): bool
    {
        return $this->loginAlreadyExists;
    }

    /**
     * @param bool $loginAlreadyExists
     */
    public function setLoginAlreadyExists(bool $loginAlreadyExists): void
    {
        $this->loginAlreadyExists = $loginAlreadyExists;
    }

    /**
     * @return bool
     */
    public function isPromoFormatKo(): bool
    {
        return $this->promoFormatKo;
    }

    /**
     * @param bool $promoFormatKo
     */
    public function setPromoFormatKo(bool $promoFormatKo): void
    {
        $this->promoFormatKo = $promoFormatKo;
    }

    /**
     * @return bool
     */
    public function isPasswordKo(): bool
    {
        return $this->passwordKo;
    }

    /**
     * @param bool $passwordKo
     */
    public function setPasswordKo(bool $passwordKo): void
    {
        $this->passwordKo = $passwordKo;
    }




    public function isLineErrorCreate()
    {
        return $this->emailKo ||
            $this->loginKo ||
            $this->loginNotFound ||
            $this->nomNotFound ||
            $this->prenomNotFound ||
            $this->loginAlreadyExists ||
            $this->promoFormatKo ||
            $this->passwordKo;
    }

    public function isLineErrorUpdate()
    {
        return $this->emailKo ||
            $this->loginKo ||
            $this->loginNotFound ||
            $this->promoFormatKo;
    }


}

