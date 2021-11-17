<?php 
namespace Models;
use Models\User as User;
class Company extends User{

    private $idCompany;
    private $name;
    private $phoneNumber;
    private $email;
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
 
    public function getState(){ return $this->state; }
    public function setState($state){ $this->state = $state; }
 
    public function getDescription(){ return $this->description; }
    public function setDescription($description){ $this->description = $description; }

    public function getPhoneNumber(){ return $this->phoneNumber; }
    public function setPhoneNumber( $phoneNumber){$this->phoneNumber = $phoneNumber; }
 
    public function getEmail(){ return $this->email; }
    public function setEmail($email){ $this->email = $email; }
}
