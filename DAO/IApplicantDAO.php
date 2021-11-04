<?php
namespace DAO;

use Models\Applicant as Applicant;

interface IApplicantDAO{
    public function Add(Applicant $applicant);
    public function GetApplicantsFromJobOffer($idJobOffer);
    public function CheckIfApplicant($idUser);
}
?>