<?php
namespace Models;

class CV{

    private $idCV;
    private $name;

    public function __construct($name, $idCV = NULL) {
        $this->idCV = $idCV;
        $this->name = $name;
    }

	public function getIdCV(){ return $this->idCV; }
	public function setIdCV($idCV){ $this->idCV = $idCV; }

	public function getName(){ return $this->name; }
	public function setName($name){ $this->name = $name; }

}
?>