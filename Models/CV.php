<?php
namespace Models;

class CV{

    private $idApplicant;
    private $name;

    public function __construct($name, $idApplicant = NULL) {
        $this->idApplicant = $idApplicant;
        $this->name = $name;
    }

	public function getIdAplicant(){ return $this->idApplicant; }
	public function setIdAplicant($idApplicant){ $this->idApplicant = $idApplicant; }

	public function getName(){ return $this->name; }
	public function setName($name){ $this->name = $name; }

}
?>