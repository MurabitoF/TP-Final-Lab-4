<?php 
namespace Models;

class Company{

    private $idCompany;
    private $name;
    private $city;
    private $category;

    /*public function __construct($idCompany, $name, $city)
    {
        $this->idCompany = $idCompany;
        $this->name = $name;
        $this->city = $city;
    }*/
 
    public function getIdCompany()
    {
        return $this->idCompany;
    }

    public function setIdCompany($idCompany)
    {
        $this->idCompany = $idCompany;

        return $this;
    }
 
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

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

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}

?>