<?php 
namespace Models;

class Admin {

    private $idAdmin;
    private $firstName;
    private $lastName;

    public function __construct($idAdmin, $firstName, $lastName)
    {
        $this->idAdmin = $idAdmin;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }
}


?>