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
        LoggerController::VerifyLogIn();
        if (in_array('Create JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            $companyList = $this->companyDAO->GetAll();
            $jobPositionList = $this->jobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();

            require_once(VIEWS_PATH . "jobOffer-add.php");
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function ShowAdminListView($idCareer = null, $idJobPosition = null, $workload = null, $city = null)
    {
        session_start();
        LoggerController::VerifyLogIn();
        if (in_array('List JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            $companyList = $this->companyDAO->GetAll();
            $jobOfferList = $this->jobOfferDAO->GetAll();
            $jobPositionList = $this->jobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();

            $parameters = array();
            $parameters["idCareer"] = $idCareer;
            $parameters["idJobPosition"] = $idJobPosition;
            $parameters["workload"] = $workload;
            $parameters["city"] = $city;

            $jobOfferList = $this->jobOfferDAO->filterList($parameters);

            require_once(VIEWS_PATH . "jobOffer-list-admin.php");
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
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
        LoggerController::VerifyLogIn();
        if (in_array('Edit JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);

            $this->jobOfferDAO->Edit($jobOffer);

            $companyList = $this->companyDAO->GetAll();
            $jobPositionList = $this->jobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();

            require_once(VIEWS_PATH . "jobOffer-edit.php");
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function ShowDataView($idJobOffer)
    {
        session_start();
        LoggerController::VerifyLogIn();
        $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);

        require_once(VIEWS_PATH . "jobOffer-data.php");
    }

    public function Add($title, $idCompany, $idCareer, $city, $idJobPosition, $requirements, $workload, $postDate, $expireDate, $description)
    {
        session_start();
        LoggerController::VerifyLogIn();
        if (in_array('Create JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
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
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function Edit($idJobOffer, $title, $idCompany, $idCareer, $city, $idJobPosition, $requirements, $postDate, $expireDate, $workload, $description, $active)
    {
        session_start();
        LoggerController::VerifyLogIn();
        if (in_array('Edit JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
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
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function AddApplicant($idJobOffer, $idUser, $description, $fileCV)
    {
        session_start();
        LoggerController::VerifyLogIn();
        if (in_array('Add Applicant', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
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
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }
}
