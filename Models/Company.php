<?php 
namespace Models;

class Company{

    private $idCompany;
    private $name;
    private $CUIT;
    private $city;
    private $category;
    private $description;
    private $street;
    private $streetAddress;
    private $postalCode;
    private $state;

    public function __construct()
    {
        $this->state = true;
    }
 
    public function getIdCompany(){ return $this->idCompany; }
    public function setIdCompany($idCompany){ $this->idCompany = $idCompany; }
 
    public function getName(){ return $this->name; }
    public function setName($name){ $this->name = $name; }

    public function getCUIT(){ return $this->CUIT; }
	public function setCUIT($CUIT){ $this->CUIT = $CUIT; }

    public function getCity(){ return $this->city; }
    public function setCity($city){ $this->city = $city; }

    public function getCategory(){ return $this->category; }
    public function setCategory($category){ $this->category = $category; }
 
    public function getState(){ return $this->state; }
    public function setState($state){ $this->state = $state; }
 
    public function getDescription(){ return $this->description; }
    public function setDescription($description){ $this->description = $description; }

    public function getStreetAddress(){ return $this->streetAddress; }
    public function setStreetAddress($streetAddress){ $this->streetAddress = $streetAddress; }
 
    public function getPostalCode(){ return $this->postalCode; }
    public function setPostalCode($postalCode){ $this->postalCode = $postalCode; }

    public function getStreet(){ return $this->street; }
    public function setStreet($street){ $this->street = $street; }

    public function getHqPostalCode(){ return $this->hqPostalCode; }
    public function setHqPostalCode($hqPostalCode){ $this->hqPostalCode = $hqPostalCode; }
}

?>