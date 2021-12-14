<?php

namespace Controllers;

use \Exception as Exception;
use DAO\ApplicantDAO as ApplicantDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\ImageDAO as ImageDAO;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\UserDAO as UserDAO;
use Controllers\LoggerController as LoggerController;
use Models\Career as Career;
use Models\Student as Student;
use Models\JobOffer as JobOffer;
use Models\User as User;
use Models\Alert as Alert;

class UserController
{
    private $userDAO;
    private $studentDAO;
    private $careerDAO;
    private $applicantDAO;
    private $jobOfferDAO;
    private $imageDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO;
        $this->studentDAO = new StudentDAO;
        $this->careerDAO = new CareerDAO;
        $this->applicantDAO = new ApplicantDAO;
        $this->jobOfferDAO = new JobOfferDAO;
        $this->imageDAO = new ImageDAO;
    }

    public function ShowHomeView()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        $lastApplications = array();
        if ($_SESSION['loggedUser']->getRole() == "Student") {
            $lastApplications = $this->GetLastApplications($_SESSION["loggedUser"]->getStudentId());
        }
        require_once(VIEWS_PATH . "home.php");
    }

    public function ShowListView($alert = NULL)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('List Users', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            $userList = $this->userDAO->GetAll();
            require_once(VIEWS_PATH . 'user-list.php');
        } else {
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }

    }

    public function ShowAddView($alert = NULL)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('Create User', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            require_once(VIEWS_PATH . 'user-add.php');
        } else {
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function ShowRegisterView($user = NULL, $message = "")
    {
        require_once(VIEWS_PATH . "register.php");
    }

    public function ShowRegisterCompanyView($user, $alert = NULL)
    {
        session_start();
        require_once(VIEWS_PATH . "company-register.php");
    }

    public function ShowEditView($userId, $alert = NULL)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        require_once(VIEWS_PATH . "user-edit.php");
    }

    public function Add($username, $verifiedPassword, $role)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('Create User', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            try {
                $encryptedPass = password_hash($verifiedPassword, PASSWORD_DEFAULT);
                $newUser = new User();
                $newUser->setUsername($username);
                $newUser->setPassword($encryptedPass);
                $newUser->setRole($role);
                $newUser->setActive(true);

                $this->userDAO->Add($newUser);

                $alert = new Alert('success', 'Se ha registrado correctamente');
            } catch (Exception $ex) {
                $alert = new Alert('danger', 'Ha ocurrido un error: ' . $ex->getMessage());
            } finally {
                $this->ShowAddView($alert);
            }
        } else {
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function AddStudent($username, $verifiedPassword, $role)
    {
        try {
            $encryptedPass = password_hash($verifiedPassword, PASSWORD_DEFAULT);
            $newUser = new User();
            $newUser->setUsername($username);
            $newUser->setPassword($encryptedPass);
            $newUser->setRole('Student');
            $newUser->setActive(true);

            $this->userDAO->Add($newUser);

            $alert = new Alert('succes', 'Se ha registrado correctamente');
        } catch (Exception $ex) {
            $alert = new Alert('danger', 'Ha ocurrido un error: ' . $ex->getMessage());
        } finally {
            header("Location: " . FRONT_ROOT . "Logger/ShowLogInView");
        }
    }

    public function EditPass($oldPass, $newPass, $idUser)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        try {
            if (password_verify($oldPass, $_SESSION['loggedUser']->getPassword())) {
                $encryptedPass = password_hash($newPass, PASSWORD_DEFAULT);
                $this->userDAO->UpdatePassword($encryptedPass, $idUser);
                $alert = new Alert('success', 'Contraseña cambiada');
            } else {
                $alert = new Alert('warning', 'La contraseña no es correcta');
            }
        } catch (Exception $ex) {
            $alert = new Alert('danger', 'Ha ocurrido un error: ' . $ex->getMessage());
        } finally {
            $this->ShowEditView($idUser, $alert);
        }
    }

    public function RemoveUser($idUser)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        if (in_array('Delete User', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            try{
                $this->userDAO->Remove($idUser);
                $alert = new Alert('success', 'Usuario eliminado');
            } catch (Exception $ex) {
                $alert = new Alert('danger', 'Ha ocurrido un error: ' . $ex->getMessage());
            } finally {
                $this->ShowListView($alert);
            }
            
        } else {
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function VerifyEmail($email)
    {
        $user = $this->userDAO->GetByUserName($email);
        $message = "";
        if (!$user) {
            $user = $this->studentDAO->GetByUserName($email);
            if ($user) {
                if ($user->getState()) {
                    $career = $this->careerDAO->GetbyId($user->GetCareerId());
                    $user->setCareerId($career->getName());
                    $this->ShowRegisterView($user);
                } else {
                    $message = "Usted no se encuentra activo en el sistema de la UTN";
                    $this->ShowRegisterView(NULL, $message);
                }
            } else {
                $message = "El email ingresado no pertenece a un alumno de la utn!";
                $this->ShowRegisterView(NULL, $message);
            }
        } else {
            $message = "Ya se encuentra registrado en el sistema";
            $this->ShowRegisterView(NULL, $message);
        }
    }

    private function GetLastApplications($idStudent)
    {
        $jobOfferList = $this->applicantDAO->GetLastJobOffersFromApplicant($idStudent);
        $lastApplications = array();
        foreach ($jobOfferList as $idJobOffer) {
            $jobOffer = $this->jobOfferDAO->SearchId($idJobOffer);
            array_push($lastApplications, $jobOffer);
        }
        return $lastApplications;
    }
}
