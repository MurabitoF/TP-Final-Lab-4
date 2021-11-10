<?php
namespace Models;

class Applicant{
    private $idApplicant;
    private $idUser;
    private $idJobOffer;
    private $date;
    private $cv;
    private $description;
	private $active; ///active agregado

    public function __construct() {
		$this->active = true;
    }
    
	public function getIdApplicant(){ return $this->idApplicant; }
	public function setIdApplicant($idApplicant){ $this->idApplicant = $idApplicant; }

	public function getIdUser(){ return $this->idUser; }
	public function setIdUser($idUser){ $this->idUser = $idUser; }

	public function getIdJobOffer(){ return $this->idJobOffer; }
	public function setIdJobOffer($idJobOffer){ $this->idJobOffer = $idJobOffer; }

	public function getDate(){ return $this->date; }
	public function setDate($date){ $this->date = $date; }

	public function getCv(){ return $this->cv; }
	public function setCv($cv){ $this->cv = $cv; }

	public function getDescription(){ return $this->description; }
	public function setDescription($description){ $this->description = $description; }

	public function getActive(){ return $this->active;}
	public function setActive($active){$this->active = $active;}
}