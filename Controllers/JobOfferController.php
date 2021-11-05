<?php
namespace Controllers;

use \Exception as Exception;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\CurriculumDAO as CurriculumDAO;
use DAO\ApplicantDAO as ApplicantDAO;
use Models\Alert as Alert;
use Models\JobOffer as JobOffer;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CareerDAO as CareerDao;
use Models\Applicant as Applicant;
use Models\CV as CV;

class JobOfferController
{
    private $jobOfferDAO;
    private $companyDAO;
    private $jobPositionDAO;
    private $careerDAO;
    private $applicantDAO;
    private $curriculumDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
        $this->companyDAO = new CompanyDAO();
        $this->jobPositionDAO = new JobPositionDAO();
        $this->careerDAO = new CareerDao();
        $this->applicantDAO = new ApplicantDAO;
        $this->curriculumDAO = new CurriculumDAO;
    }

    public function ShowPostView($idJobOffer, $alert = NULL)
    {
        $jobOffer = $this->jobOfferDAO->SearchId($idJobOffer);
        $jobOffer->setApplicants($this->applicantDAO->GetApplicantsFromJobOffer($idJobOffer));
        $company = $this->companyDAO->searchId($jobOffer->getCompany());
        $jobPosition = $this->jobPositionDAO->GetJobPositionById($jobOffer->getJobPosition());
        session_start();
        require_once(VIEWS_PATH . "jobOffer-post.php");
    }

    public function ShowAddView()
    {
        session_start();

        $companyList = $this->companyDAO->GetAll();
        $jobPositionList = $this->jobPositionDAO->GetAll();
        $careerList = $this->careerDAO->GetAll();

        require_once(VIEWS_PATH . "jobOffer-add.php");
    }

    public function ShowAdminListView($idCareer = null, $idJobPosition = null, $workload = null, $city = null)
    {
        $jobOfferList = $this->jobOfferDAO->GetAll();
        $jobPositionList = $this->jobPositionDAO->GetAll();
        $careerList = $this->careerDAO->GetAll();

        session_start();

        $parameters = array();
        $parameters["idCareer"] = $idCareer;
        $parameters["idJobPosition"] = $idJobPosition;
        $parameters["workload"] = $workload;
        $parameters["city"] = $city;

        $jobOfferList = $this->jobOfferDAO->filterList($parameters);

        require_once(VIEWS_PATH . "jobOffer-list-admin.php");
    }

    public function ShowStudentListView($idCareer = null, $idJobPosition = null, $workload = null, $city = null)
    {
        session_start();

        $jobOfferList = $this->jobOfferDAO->GetAll();
        $companyList = $this->companyDAO->GetAll();
        $jobPositionList = $this->jobPositionDAO->GetAll();
        $careerList = $this->careerDAO->GetAll();

        $parameters = array();
        $parameters["idCareer"] = $idCareer;
        $parameters["idJobPosition"] = $idJobPosition;
        $parameters["workload"] = $workload;
        $parameters["city"] = $city;

        $jobOfferList = $this->jobOfferDAO->filterList($parameters);
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

    public function Add($title, $idCompany, $idCareer, $city, $idJobPosition, $requirements, $workload, $postDate, $expireDate, $description)
    {
            $jobOffer = new JobOffer();

            $jobOffer->setTitle($title);
            $jobOffer->setCompany($idCompany);
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

    public function Edit($idJobOffer, $title, $idCompany, $idCareer, $city, $idJobPosition, $requirements, $postDate, $expireDate, $workload, $description, $active)
    {
        $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);

        $jobOffer->setTitle($title);
        $jobOffer->setCompany($idCompany);
        $jobOffer->setCareer($idCareer);
        $jobOffer->setCity($city);
        $jobOffer->setJobPosition($idJobPosition);
        $jobOffer->setCareer($idCareer);
        $jobOffer->setWorkload($workload);
        $jobOffer->setRequirements($requirements);
        $jobOffer->setPostDate($postDate);
        $jobOffer->setExpireDate($expireDate);
        $jobOffer->setDescription($description);
        $jobOffer->setActive($active);

        $this->jobOfferDAO->Edit($jobOffer);
        
        $this->ShowAdminListView();
    }

    public function AddApplicant($idJobOffer, $idUser, $description, $fileCV)
    {
        try {
            $cv = $this->curriculumDAO->UploadCV($fileCV, $idJobOffer);

            if ($cv) {
                $applicant = new Applicant;
                $applicant->setCv($cv);
                $applicant->setIdJobOffer($idJobOffer);
                $applicant->setIdUser($idUser);
                $applicant->setDescription($description);
                $applicant->setDate(date("Y/m/d"));

                $this->applicantDAO->Add($applicant);

                $alert = new Alert("success", "Te postulaste correctamente");
            } else {
                $alert = new Alert("danger", "Hubo un error al subir el CV");
            }
        } catch (Exception $ex) {
            $alert = new Alert("danger", $ex->getMessage());
        } finally {
            $this->ShowPostView($idJobOffer, $alert);
        }
    }
}

