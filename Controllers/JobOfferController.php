<?php

namespace Controllers;

use \Exception as Exception;
use DAO\ApplicantDAO as ApplicantDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\CurriculumDAO as CurriculumDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\ImageDAO as ImageDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\userDAO as UserDAO;
use Models\Alert as Alert;
use Models\CV as CV;
use Models\Applicant as Applicant;
use Models\JobOffer as JobOffer;
use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;

class JobOfferController
{
    private $jobOfferDAO;
    private $companyDAO;
    private $jobPositionDAO;
    private $careerDAO;
    private $applicantDAO;
    private $curriculumDAO;
    private $imageDAO;
    private $userDAO;
    private $studentDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO;
        $this->companyDAO = new CompanyDAO;
        $this->jobPositionDAO = new JobPositionDAO;
        $this->careerDAO = new CareerDao;
        $this->applicantDAO = new ApplicantDAO;
        $this->curriculumDAO = new CurriculumDAO;
        $this->imageDAO = new ImageDAO;
        $this->userDAO = new UserDAO;
        $this->studentDAO = new StudentDAO;
    }

    public function ShowPostView($idJobOffer, $alert = NULL)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        $jobOffer = $this->jobOfferDAO->SearchId($idJobOffer);
        $jobOffer->setApplicants($this->applicantDAO->GetApplicantsFromJobOffer($idJobOffer));
        $company = $this->companyDAO->searchId($jobOffer->getCompany());
        $jobPosition = $this->jobPositionDAO->GetJobPositionById($jobOffer->getJobPosition());
        require_once(VIEWS_PATH . "jobOffer-post.php");
    }

    public function ShowAddView($alert = NULL)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('Create JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            if($_SESSION['loggedUser']->getRole() == "Company"){
                $companyList = $this->companyDAO->searchId($_SESSION['loggedUser']->getIdCompany());
            } else {
                $companyList = $this->companyDAO->GetAll();
            }
            $jobPositionList = $this->jobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();

            require_once(VIEWS_PATH . "jobOffer-add.php");
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function ShowAdminListView($alert = null, $idCareer = null, $idJobPosition = null, $workload = null, $city = null)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('List JobOffers', LoggerController::$permissions[$_SESSION["loggedUser"]->getRole()])) {
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

    public function ShowCompanyListView($idCompany, $alert = null, $idCareer = null, $idJobPosition = null, $workload = null, $city = null)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('List JobOffers', LoggerController::$permissions[$_SESSION["loggedUser"]->getRole()])) {
            $companyList = $this->companyDAO->searchId($idCompany);
            $jobPositionList = $this->jobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();

            $parameters = array();
            $parameters["idCompany"] = $idCompany;
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
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
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

    public function ShowEditView($idJobOffer, $alert = null)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('Edit JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);

            $companyList = $this->companyDAO->GetAll();
            $jobPositionList = $this->jobPositionDAO->GetAll();
            $careerList = $this->careerDAO->GetAll();

            require_once(VIEWS_PATH . "jobOffer-edit.php");
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    ///LISTADO DE POSTULANTES
    public function ShowApplicantListView($idJobOffer){
        $applicantList = $this->applicantDAO->GetApplicantsFromJobOffer($idJobOffer);
        $studentList = $this->studentDAO->GetAll();

        session_start();

        require_once(VIEWS_PATH . "applicants-list.php");
    }

    public function ShowHistoryApplicantsList($idUser){
        $lastApplications = $this->applicantDAO->GetJobOffersFromApplicant($idUser);
        $companyList = $this->companyDAO->GetAll();
        $careerList = $this->careerDAO->GetAll();
        $jobPositionList = $this->jobPositionDAO->GetAll();

        session_start();

        require_once(VIEWS_PATH . "jobOffer-list.php");
    }

    public function Add($title, $idCompany, $idCareer, $city, $idJobPosition, $requirements, $workload, $expireDate, $description, $flyer = NULL)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('Create JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            try {
                $jobOffer = new JobOffer();

                $jobOffer->setTitle($title);
                $jobOffer->setCompany($idCompany);
                $jobOffer->setCareer($idCareer);
                $jobOffer->setCity($city);
                $jobOffer->setJobPosition($idJobPosition);
                $jobOffer->setRequirements($requirements);
                $jobOffer->setPostDate(date("Y-m-d"));
                $jobOffer->setExpireDate($expireDate);
                $jobOffer->setWorkload($workload);
                $jobOffer->setDescription($description);
                $jobOffer->setStatus("Open");

                if ($flyer['size'] > 0) {
                    $image = $this->imageDAO->UploadImage($flyer, 'flyer');
                    if ($image) {
                        $jobOffer->setImgFlyer($image);
                        $this->jobOfferDAO->Add($jobOffer);
                    } else {
                        $alert = new Alert("danger", "Ha ocurrido un error al subir la imagen");
                        $this->ShowAddView($alert);
                    }
                } else {
                    $jobOffer->setImgFlyer("");
                }
                $this->jobOfferDAO->Add($jobOffer);

                $alert = new Alert('success', 'La publicacion se creo con exito');
            } catch (Exception $ex) {
                $alert = new Alert('danger', $ex->getMessage());
            } finally {
                $this->ShowAddView($alert);
            }
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function Edit($idJobOffer, $title, $idCompany, $idCareer, $city, $idJobPosition, $requirements, $expireDate, $workload, $description, $flyer = NULL)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('Edit JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);
            try {
                $jobOffer->setTitle($title);
                $jobOffer->setCompany($idCompany);
                $jobOffer->setCareer($idCareer);
                $jobOffer->setCity($city);
                $jobOffer->setJobPosition($idJobPosition);
                $jobOffer->setCareer($idCareer);
                $jobOffer->setWorkload($workload);
                $jobOffer->setRequirements($requirements);
                $jobOffer->setExpireDate($expireDate);
                $jobOffer->setDescription($description);

                if ($flyer['size'] > 0) {
                    $image = $this->imageDAO->EditImage($jobOffer->getImgFlyer(), $flyer, $jobOffer->getTitle());
                    if ($image) {
                        $jobOffer->setImgFlyer($image);
                        $this->jobOfferDAO->Add($jobOffer);
                    } else {
                        $alert = new Alert("danger", "Ha ocurrido un error al subir la imagen");
                        $this->ShowAddView($alert);
                    }
                    
                }else{
                    $jobOffer->setImgFlyer("");
                }
                $this->jobOfferDAO->Edit($jobOffer);

                $alert = new Alert('success', 'La publicacion fue editada con exito');
            } catch (Exception $ex) {
                $alert = new Alert('danger', $ex->getMessage());
            } finally {
                $this->ShowAdminListView($alert);
            }
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function Remove($idJobOffer)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('Delete JobOffer', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            try {
                $this->jobOfferDAO->Remove($idJobOffer);
                $alert = new Alert("success", "La publicacion a sido dada de baja con existo");
            } catch (Exception $ex) {
                $alert = new Alert("danger", "Hubo un error al dar de baja la publicacion");
            } finally {
                $this->ShowAdminListView($alert);
            }
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function AddApplicant($idJobOffer, $idUser, $description, $fileCV)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
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
                    $applicant->setDate(date("Y-m-d"));

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

    public function SendEmail($idJobOffer)
    {
        try {
            $userList = $this->applicantDAO->GetApplicantsFromJobOffer($idJobOffer);
            $emailList = $this->userDAO->getEmail($userList);
            $jobOfferName = $this->jobOfferDAO->SearchId($idJobOffer);

            $titulo = "Ciere de oferta laboral";
            $message = "\"" . $jobOfferName->getTitle() . " \" ya no acepta más postulantes.";
            $header = "Bcc:eserskyd@outlook.com" . "\r\n";

            mail("eserskyd@outlook.com", $titulo, $message, $header);

            $alert = new Alert("success", "La notificación fue envíada con exito");
        } catch (Exception $ex) {
            $alert = new Alert("danger", "Error: " . $ex->getMessage());
        } finally {
            $this->ShowAdminListView($alert);
        }
    }

    public function CloseJobOffer($idJobOffer)
    {
        try{
            $this->jobOfferDAO->CloseJobOffer($idJobOffer);
            $this->SendEmail($idJobOffer);
        }catch(Exception $ex){
            $alert = new Alert("danger", "Error: " . $ex->getMessage());
            $this->ShowAdminListView($alert);
        }
    }

    public function NotifyApplicant($idUser, $idJobOffer)
    {
        try {
            $emailUser = $this->userDAO->getEmail($idUser);
            $jobOfferName = $this->jobOfferDAO->SearchId($idJobOffer);

            $titulo = "Eliminación de su postulación.";

            $message = "Usted a sido rechazado de la oferta\"" . $jobOfferName->getTitle() . " \". 
            Esto puede ser debido a que no cumple con los requisitos de la misma o por otro motivo. 
            Si cree que esto es un error contactese con el coordinador de su carrera o la oficina de alumnos.";
            $message = wordwrap($message, 70);

            $header = "Bcc:eserskyd@outlook.com" . "\r\n";

            mail("eserskyd@outlook.com", $titulo, $message, $header);

            $alert = new Alert("success", "El postulante a sido dado de baja y fue notificado con exito.");
        } catch (Exception $ex) {
            $alert = new Alert("danger", "Hubo un error al notificar al postulante");
        } finally {
            $this->ShowAdminListView($alert);
        }
    }

    public function RemoveApplicant($idUser, $idUser_Has_JobOffer, $idJobOffer)
    {
        try {
            $this->ApplicantDAO->Remove($idUser, $idUser_Has_JobOffer);
            $this->NotifyApplicant($idUser, $idJobOffer);
        } catch (Exception $ex) {
            $alert = new Alert("danger", "Hubo un error al dar de baja la postulación");
        } finally {
            $this->ShowAdminListView($alert);
        }
    }

    public function DownloadCVsFromJobOffer($idJobOffer)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('Download CV', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {

            $this->curriculumDAO->CreateBundleCV($idJobOffer);

            $filename = UPLOADS_PATH . "cv/CV_$idJobOffer.zip";
            
            if (file_exists($filename)) {
                header("Content-Type: application/zip");
                header("Content-Transfer-Encoding: Binary");
                header("Content-Length: ".filesize($filename));
                header("Content-Disposition: attachment; filename=\"".basename($filename)."\"");
                ob_end_clean();
                readfile($filename);
                unlink($filename);
            }
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }
}
