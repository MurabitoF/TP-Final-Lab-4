<?php

namespace Controllers;

use DAO\JobOfferDAO as JobOfferDAO;
use Models\JobOffer as JobOffer;

class JobOfferController
{
    private $jobOfferDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "jobOffer-add.php");
    }

    public function ShowAdminListView()
    {
        $jobOfferList = $this->jobOfferDAO->GetAll();

        session_start();
        require_once(VIEWS_PATH . "jobOffer-list-admin.php");
    }

    public function ShowStudentListView()
    {
        $jobOfferList = $this->jobOfferDAO->GetAll();
        $jobOffer = new JobOffer();
        $jobOffer->setIdJobOffer(1);
        $jobOffer->setTitle("Se busca Programador");
        $jobOffer->setJobPosition("Front End Developer");
        $jobOffer->setCompany("Accenture");
        $jobOffer->setIncome("50.000");
        $jobOffer->setCity("Mar del Plata");
        $jobOffer->setCategory("University technician in environmental procedures and technologies");
        $jobOffer->setApplicants(array());
        $jobOffer->setWorkload("Full Time");
        $jobOffer->setRequirements("Javascript");
        $jobOffer->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu tincidunt quam. Suspendisse nisl turpis, tincidunt at sodales sit amet, malesuada et magna. Proin vel tellus ut dui consequat pretium. Quisque sed libero leo. Ut ac bibendum magna. Fusce eu tortor in metus molestie sollicitudin a id sem. Maecenas arcu metus, pharetra vel diam vel, ullamcorper venenatis nunc. Nullam semper nisl tortor, vitae viverra leo venenatis ac.

        Quisque lacinia suscipit neque, ac facilisis turpis condimentum quis. Nullam placerat egestas diam, porta accumsan felis fringilla id. Sed pellentesque hendrerit nisi eu eleifend. Donec sed semper libero. Cras ac nisl eu elit cursus cursus. Duis dignissim in urna non fermentum. Ut rutrum augue arcu, in tristique est efficitur vel.");
        array_push($jobOfferList, $jobOffer);
        session_start();
        require_once(VIEWS_PATH . "jobOffer-list-student.php");
    }

    public function Add($jobPosition, $company, $income, $city, $category, $workload, $requeriments, $title, $description)
    {
        $jobOffer = new JobOffer();
        $jobOffer->setIdJobOffer(count($this->jobOfferDAO->GetAll()) + 1);
        $jobOffer->setJobPosition($jobPosition);
        $jobOffer->setCompany($company);
        $jobOffer->setIncome($income);
        $jobOffer->setCity($city);
        $jobOffer->setCategory($category);
        //$jobOffer->setApplicants(); VER DESPUES
        $jobOffer->setWorkload($workload);
        $jobOffer->setRequirements($requeriments);
        $jobOffer->setTitle($title);
        $jobOffer->setDescription($description);

        $this->JobOfferDAO->Add($jobOffer);

        $this->ShowAddView();
    }
}
