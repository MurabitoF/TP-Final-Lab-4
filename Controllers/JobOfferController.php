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

    public function ShowHomeView()
    {
        require_once(VIEWS_PATH . "home.php");
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "jobOffer-add.php");
    }

    public function ShowListView()
    {
        $jobOfferList = $this->jobOfferDAO->GetAll();

        require_once(VIEWS_PATH . "jobOffer-list.php");
    }

    public function Add($jobPosition, $company, $income, $city, $category, $workload, $requeriments, $title, $description)
    {
        $jobOffer = new JobOffer();
        $jobOffer->setIdJobOffer(count($this->jobOfferDAO->GetAll())+1);
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
