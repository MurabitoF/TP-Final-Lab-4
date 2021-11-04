<?php
namespace Controllers;

use Exception;
use DAO\JobOfferDAO as JobOfferDAO;
use Models\JobOffer as JobOffer;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CareerDAO as CareerDao;

class JobOfferController
{
    private $jobOfferDAO;
    private $companyDAO;
    private $jobPositionDAO;
    private $careerDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
        $this->companyDAO = new CompanyDAO();
        $this->jobPositionDAO = new JobPositionDAO();
        $this->careerDAO = new CareerDao();
    }

    public function ShowAddView()
    {
        session_start();

        //$companyList = $this->companyDAO->GetAll();
        $jobPositionList = $this->jobPositionDAO->GetAll();
        $careerList = $this->careerDAO->GetAll();

        require_once(VIEWS_PATH . "jobOffer-add.php");
    }

    public function ShowAdminListView()
    {
        $jobOfferList = $this->jobOfferDAO->GetAll();
        $jobPositionList = $this->jobPositionDAO->GetAll();
        $careerList = $this->careerDAO->GetAll();

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
        $jobOffer->setCity("Mar del Plata");
        $jobOffer->setCareer("University technician in environmental procedures and technologies");
        $jobOffer->setApplicants(array());
        $jobOffer->setWorkload("Full Time");
        $jobOffer->setRequirements("Javascript");
        $jobOffer->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu tincidunt quam. Suspendisse nisl turpis, tincidunt at sodales sit amet, malesuada et magna. Proin vel tellus ut dui consequat pretium. Quisque sed libero leo. Ut ac bibendum magna. Fusce eu tortor in metus molestie sollicitudin a id sem. Maecenas arcu metus, pharetra vel diam vel, ullamcorper venenatis nunc. Nullam semper nisl tortor, vitae viverra leo venenatis ac.
        Quisque lacinia suscipit neque, ac facilisis turpis condimentum quis. Nullam placerat egestas diam, porta accumsan felis fringilla id. Sed pellentesque hendrerit nisi eu eleifend. Donec sed semper libero. Cras ac nisl eu elit cursus cursus. Duis dignissim in urna non fermentum. Ut rutrum augue arcu, in tristique est efficitur vel.");
        array_push($jobOfferList, $jobOffer);
        session_start();

        $jobPositionList = $this->jobPositionDAO->GetAll();
        $careerList = $this->careerDAO->GetAll();
        require_once(VIEWS_PATH . "jobOffer-list-student.php");
    }

    public function ShowEditView($idJobOffer)
    {
        session_start();

        $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);
  
        $this->jobOfferDAO->Edit($jobOffer);

        $companyList = $this->companyDAO->GetAll();
        $jobPositionList = $this->jobPositionDAO->GetAll();
        $careerList = $this->careerDAO->GetAll();

        require_once (VIEWS_PATH."jobOffer-edit.php");
    }

    public function ShowDataView($idJobOffer)
    {
        session_start();

        $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);

        require_once (VIEWS_PATH."jobOffer-data.php"); ///A FUTURO MOSTRAR TARJETA DE FRANCO
    }

    public function Add($title, $idCareer, $city, $idJobPosition, $requirements, $workload, $postDate, $expireDate, $description)
    {
            $jobOffer = new JobOffer();

            $jobOffer->setTitle($title);
            $jobOffer->setCareer($idCareer);
            $jobOffer->setCity($city);
            $jobOffer->setJobPosition($idJobPosition);
            $jobOffer->setRequirements($requirements);
            $jobOffer->setPostDate($postDate);
            $jobOffer->setExpireDate($expireDate);
            $jobOffer->setWorkload($workload);
            $jobOffer->setDescription($description);

            $this->jobOfferDAO->Add($jobOffer);

            $this->ShowAddView();
    }

    public function Edit($idJobOffer, $title, $idCareer, $city, $idJobPosition, $requirements, $postDate, $expireDate, $workload, $description, $active)
    {
        $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);

        $jobOffer->setTitle($title);
        $jobOffer->setCareer($idCareer);
        $jobOffer->setCity($city);
        $jobOffer->setJobPosition($idJobPosition);
        $jobOffer->setRequirements($requirements);
        $jobOffer->setPostDate($postDate);
        $jobOffer->setExpireDate($expireDate);
        $jobOffer->setWorkload($workload);
        $jobOffer->setDescription($description);
        $jobOffer->setActive($active);

        $this->jobOfferDAO->Edit($jobOffer);
        
        $this->ShowAdminListView();
    }

    public function Action($Remove = "", $Edit = "") 
    {
        if ($Edit != "")
        {
            $this->ShowEditView($Edit);
        } else if($Remove != "")
        {
            $this->jobOfferDAO->Remove($Remove);
            $this->ShowAdminListView();
        }else
        {
            echo "Ha ocurrido un error";
        }
    }
}

