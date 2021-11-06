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
use DAO\userDAO as UserDAO;
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
    private $userDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
        $this->companyDAO = new CompanyDAO();
        $this->jobPositionDAO = new JobPositionDAO();
        $this->careerDAO = new CareerDao();
        $this->applicantDAO = new ApplicantDAO;
        $this->curriculumDAO = new CurriculumDAO;
        $this->userDAO = new UserDAO;
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

    public function ShowAddView($alert = null)
    {
        session_start();

        $companyList = $this->companyDAO->GetAll();
        $jobPositionList = $this->jobPositionDAO->GetAll();
        $careerList = $this->careerDAO->GetAll();

        require_once(VIEWS_PATH . "jobOffer-add.php");
    }

    public function ShowAdminListView($alert = null, $idCareer = null, $idJobPosition = null, $workload = null, $city = null)
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

    public function ShowEditView($idJobOffer, $alert=null)
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
        try{
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

            $alert = new Alert ("success", "La postulación a sido cargada con existo");
        }catch(Exception $ex){
            $alert = new Alert("danger", "Error: ". $ex->getMessage());
        }finally{
            $this->ShowAddView($alert);
        }
    }

    public function Remove($idJobOffer)
    {
        try{
            $this->jobOfferDAO->Remove($idJobOffer);
            $alert = new Alert ("success", "La postulación a sido dada de baja con existo");
        }catch(Exception $ex){
            $alert = new Alert("danger", "Hubo un error al dar de baja la postulación");
        }finally{
            $this->ShowAdminListView($alert);
        }
        
    }

    public function Edit($idJobOffer, $title, $idCompany, $idCareer, $city, $idJobPosition, $requirements, $postDate, $expireDate, $workload, $description, $active)
    {
        try{
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
        
        $alert = new Alert("success", "La postulación fue editada correctamente");
        
        $this->ShowAdminListView($alert);

        }catch(Exception $ex){
        $alert = new Alert("danger", "Error: ".$ex->getMessage());
        $this->ShowEditView($idJobOffer, $alert);
        }        
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

    public function SendEmail($idJobOffer)
    {
        try{
            $userList = $this->applicantDAO->GetApplicantsFromJobOffer($idJobOffer);
            $emailList = $this->userDAO->getEmail($userList);
            $jobOfferName = $this->jobOfferDAO->SearchId($idJobOffer);
            
            $titulo = "Ciere de oferta laboral";
            $message = "\"".$jobOfferName->getTitle()." \" ya no acepta más postulantes.";
            $header="Bcc:eserskyd@outlook.com" . "\r\n";

            mail($emailList, $titulo, $message, $header);

            $alert = new Alert("success", "La notificación fue envíada con exito");
            
        }catch(Exception $ex)
        {
            $alert = new Alert("danger", "Error: ".$ex->getMessage());
        }finally{
            $this->ShowAdminListView($alert);
        }
        
    }

    public function NotifyApplicant($idUser, $idJobOffer)
    {
        try{
            $emailUser = $this->userDAO->getEmail($idUser);
            $jobOfferName = $this->jobOfferDAO->SearchId($idJobOffer);

            $titulo = "Eliminación de su postulación.";

            $message = "Usted a sido rechazado de la oferta\"".$jobOfferName->getTitle()." \". 
            Esto puede ser debido a que no cumple con los requisitos de la misma o por otro motivo. 
            Si cree que esto es un error contactese con el coordinador de su carrera o la oficina de alumnos.";
            $message = wordwrap($message, 70);

            $header="Bcc:eserskyd@outlook.com" . "\r\n";

            mail($emailUser, $titulo, $message, $header);

            $alert = new Alert("success", "El postulante fue notificado con exito.");

        }catch(Exception $ex)
        {
            $alert = new Alert("danger", "Hubo un error al notificar al postulante");
        }finally{
            $this->ShowAdminListView($alert);
        }
    }
}

