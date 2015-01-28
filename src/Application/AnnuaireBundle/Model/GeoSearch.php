<?php
namespace Application\AnnuaireBundle\Model;
use Symfony\Component\HttpFoundation\Request;

class GeoSearch
{
    protected $postalcode;
    protected $city;
    protected $country;
    
    public function getPostalcode()
    {
        return $this->postalcode;
    }
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }
}