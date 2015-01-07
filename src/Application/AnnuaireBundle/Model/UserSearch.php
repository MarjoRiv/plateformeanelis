<?php
namespace Application\AnnuaireBundle\Model;
use Symfony\Component\HttpFoundation\Request;

class UserSearch
{
    protected $name;
    protected $surname;
    protected $filiere;
    protected $promotion;
    
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    public function getFiliere()
    {
        return $this->filiere;
    }
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;
        return $this;
    }

    public function getPromotion()
    {
        return $this->promotion;
    }
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
        return $this;
    }
}