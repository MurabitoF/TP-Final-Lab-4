<?php
namespace Controllers;

use DAO\ApplicantDAO as ApplicantDAO;
use DAO\CurriculumDAO as CurriculumDAO;
use Models\Applicant as Applicant;
use Models\CV as CV;

class ApplicantController{
    private $applicantDAO;
    private $curriculumDAO;

    public function __construct() {
        $this->applicantDAO = new ApplicantDAO;
        $this->curriculumDAO = new CurriculumDAO;
    }

    public function Add($idJobOffer, $idUser, $description, $fileCV)
    {
        $applicant = new Applicant;
        $cv = $this->curriculumDAO->UploadCV($fileCV);
        $applicant->setIdJobOffer($idJobOffer);
        $applicant->setIdUser($idUser);
        $applicant->setDescription($description);
        $applicant->setIdJobOffer($cv->getName());

        $this->applicantDAO->Add($applicant);

    }
}