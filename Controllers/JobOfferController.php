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
        var_dump($jobOffer->getApplicants());
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
        $jobOffer->setCity("Mar del Plata");
        $jobOffer->setCareer("University technician in environmental procedures and technologies");
        $jobOffer->setApplicants(array());
        $jobOffer->setWorkload("Full Time");
        $jobOffer->setRequirements("Javascript");
        $jobOffer->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu tincidunt quam. Suspendisse nisl turpis, tincidunt at sodales sit amet, malesuada et magna. Proin vel tellus ut dui consequat pretium. Quisque sed libero leo. Ut ac bibendum magna. Fusce eu tortor in metus molestie sollicitudin a id sem. Maecenas arcu metus, pharetra vel diam vel, ullamcorper venenatis nunc. Nullam semper nisl tortor, vitae viverra leo venenatis ac.

        Quisque lacinia suscipit neque, ac facilisis turpis condimentum quis. Nullam placerat egestas diam, porta accumsan felis fringilla id. Sed pellentesque hendrerit nisi eu eleifend. Donec sed semper libero. Cras ac nisl eu elit cursus cursus. Duis dignissim in urna non fermentum. Ut rutrum augue arcu, in tristique est efficitur vel.");
        array_push($jobOfferList, $jobOffer);
        session_start();
        require_once(VIEWS_PATH . "jobOffer-list-student.php");
    }

    public function ShowEditView($idJobOffer)
    {
        session_start();

        $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);
        
        $this->jobOfferDAO->Edit($jobOffer);

        require_once (VIEWS_PATH."jobOffer-edit.php");
    }

    public function Add($title, $idCareer, $city, $idJobPosition, $requeriments, $workload, $postDate, $expireDate, $description)
    {
            $jobOffer = new JobOffer();

            $jobOffer->setTitle($title);
            $jobOffer->setCareer($idCareer);
            //$jobOffer->setCompany($idCompany);
            $jobOffer->setCity($city);
            $jobOffer->setJobPosition($idJobPosition);
            $jobOffer->setRequirements($requeriments);
            $jobOffer->setPostDate($postDate);
            $jobOffer->setExpireDate($expireDate);
            $jobOffer->setWorkload($workload);
            $jobOffer->setDescription($description);

            $this->jobOfferDAO->Add($jobOffer);

            $this->ShowAddView();
    }

    public function Edit($idJobOffer, $title, $idCareer, $city, $idJobPosition, $requeriments, $workload, $postDate, $expireDate, $description)
    {
        $jobOffer = $this->jobOfferDAO->searchId($idJobOffer);

        $jobOffer->setTitle($title);
        $jobOffer->setCareer($idCareer);
        //$jobOffer->setCompany($idCompany);
        $jobOffer->setCity($city);
        $jobOffer->setJobPosition($idJobPosition);
        $jobOffer->setCareer($idCareer);
        $jobOffer->setWorkload($workload);
        $jobOffer->setRequirements($requeriments);
        $jobOffer->setPostDate($postDate);
        $jobOffer->setExpireDate($expireDate);
        $jobOffer->setDescription($description);

        $this->companyDAO->Edit($jobOffer);
        
        $this->ShowAdminListView();
    }

    public function Action($Remove = "", $Edit = "") ///ROBADA DE COMPANYDAO PARA VER SU USO
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
