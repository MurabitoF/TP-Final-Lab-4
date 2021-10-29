<?php 
namespace Models;

class Company{

    private $idCompany;
    private $name;
    private $CUIT;
    private $description;
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
 
    public function getState(){ return $this->state; }
    public function setState($state){ $this->state = $state; }
 
    public function getDescription(){ return $this->description; }
    public function setDescription($description){ $this->description = $description; }
}

?>