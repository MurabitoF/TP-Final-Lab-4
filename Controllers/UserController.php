<?php

namespace Controllers;

use \Exception as Exception;
use DAO\ApplicantDAO as ApplicantDAO;
use DAO\CareerDAO as CareerDAO;
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

    public function __construct()
    {
        $this->userDAO = new UserDAO;
        $this->studentDAO = new StudentDAO;
        $this->careerDAO = new CareerDAO;
        $this->applicantDAO = new ApplicantDAO;
        $this->jobOfferDAO = new JobOfferDAO;
    }

    public function ShowHomeView()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        LoggerController::VerifyLogIn();
        $lastApplications = array();
        if ($_SESSION['loggedUser']->getRole() == "Student") {
            $lastApplications = $this->applicantDAO->GetJobOffersFromApplicant($_SESSION['loggedUser']->getIdUser());
        }
        require_once(VIEWS_PATH . "home.php");
    }

    public function ShowAddView($alert = NULL)
    {
        session_start();
        LoggerController::VerifyLogIn();
        if (in_array('Create User', LoggerController::$permissions[$_SESSION['loggedUser']->getRole()])) {
            require_once(VIEWS_PATH . 'user-add.php');
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        }
    }

    public function ShowRegisterView($user = NULL, $message = "")
    {
        require_once(VIEWS_PATH . "register.php");
    }

    public function Add($username, $verifiedPassword, $role)
    {
        session_start();
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
                if (session_status() != PHP_SESSION_ACTIVE) {
                    header("Location: " . FRONT_ROOT . "Logger/ShowLogInView");
                } else {
                    $this->ShowAddView($alert);
                }
            }
        } else {
            echo "<script> alert('No tenes permisos para entrar a esta pagina'); </script>";
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

            $alert = new Alert('success', 'Se ha registrado correctamente');
        } catch (Exception $ex) {
            $alert = new Alert('danger', 'Ha ocurrido un error: ' . $ex->getMessage());
        } finally {
            header("Location: " . FRONT_ROOT . "Logger/ShowLogInView");


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
}
