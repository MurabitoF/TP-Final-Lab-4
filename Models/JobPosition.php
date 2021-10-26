<?php
namespace Models;

class JobPosition
{
    private $idJobPosition;
	private $careerId;
    private $name;

	public function getIdJobPosition(){ return $this->idJobPosition; }
	public function setIdJobPosition($idJobPosition){ $this->idJobPosition = $idJobPosition; }
	
	public function getCareerId(){ return $this->careerId; }
	public function setCareerId($careerId){ $this->careerId = $careerId; }
	
	public function getName(){ return $this->name; }
	public function setName($name){ $this->name = $name; }

}