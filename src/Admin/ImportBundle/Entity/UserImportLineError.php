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
     * @ORM\Column(name="login_cant_generate", type="boolean")
     */
    private $loginCantGenerate;

    /**
     * @var bool
     *
     * @ORM\Column(name="login_ko", type="boolean")
     */
    private $loginKo;

    /**
     * @var bool
     *
     * @ORM\Column(name="login_not_found", type="boolean")
     */
    private $loginNotFound;

    /**
     * @ORM\OneToOne(targetEntity="Admin\ImportBundle\Entity\UserImportLine")
     */
    private $line;


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
     * Set loginCantGenerate
     *
     * @param boolean $loginCantGenerate
     *
     * @return UserImportLineError
     */
    public function setLoginCantGenerate($loginCantGenerate)
    {
        $this->loginCantGenerate = $loginCantGenerate;

        return $this;
    }

    /**
     * Get loginCantGenerate
     *
     * @return bool
     */
    public function getLoginCantGenerate()
    {
        return $this->loginCantGenerate;
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
}

