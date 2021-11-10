<?php
namespace DAO;

use Models\Applicant as Applicant;

interface IApplicantDAO{
    public function Add(Applicant $applicant);
    public function GetApplicantsFromJobOffer($idJobOffer);
    public function GetJobOffersFromApplicant($idStudent);
    public function GetLastJobOffersFromApplicant($idStudent);
    public function Remove($idStudent, $idUser_Has_JobOffer);
}
?>