<?php

namespace Controllers;

use \Exception as Exception;
use DAO\UserDAO as UserDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\CareerDAO as CareerDAO;
use Models\Alert as Alert;
use Models\Company as Company;
use Models\Student as Student;
use Models\User;

class LoggerController
{
    public static $permissions = [
        'Admin' => [
            'Create Company',
            'Create JobOffer',
            'Create User',
            'Delete Applicant',
            'Delete Company',
            'Delete JobOffer',
            'Delete User',
            'Download CV',
            'Edit Company',
            'Edit JobOffer',
            'List Applicants',
            'List JobOffers',
            'List Users',
        ],
        'Company' => [
            'Create Company',
            'Create JobOffer',
            'Delete JobOffer',
            'Download CV',
            'Edit JobOffer',
            'Edit Company',
            'List Applicants',
            'List JobOffers',
        ],
        'Student' => [
            'Add Applicant',
            'View Records',
        ]
    ];

    private $userDAO;
    private $studentDAO;
    private $companyDAO;
    private $careerDAO;

    public function __construct()
    {
        $this->careerDAO = new CareerDAO;
        $this->companyDAO = new CompanyDAO;
        $this->studentDAO = new StudentDAO;
        $this->userDAO = new UserDAO;
    }

    public function ShowLogInView($alert = NULL)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['loggedUser'])) {
            header("Location: " . FRONT_ROOT . "User/ShowHomeView");
        } else {
            require_once(VIEWS_PATH . "login.php");
        }
    }

    public function LogIn($username, $password)
    {
        
        $user = $this->userDAO->GetByUserName($username);
        if ($user) {
            if ($user->getActive()) {
                if (password_verify($password, $user->getPassword())) {
                    if ($user->getRole() === "Student") {
                        $user = $this->loadStudentData($user);
                    } elseif ($user->getRole() === "Company") {
                        $user = $this->loadCompanyData($user);
                    }
                    session_start();
                    $_SESSION['loggedUser'] = $user;
                    $_SESSION['lastActivity'] = time();
                    header("Location: " . FRONT_ROOT . "User/ShowHomeView");
                } else {
                    $alert = new Alert('danger', 'Contraseña Incorrecta');
                    $this->ShowLogInView($alert);
                }
            } else {
                $alert = new Alert('danger', 'Usuario Incorrecto');
                $this->ShowLogInView($alert);
            }
        } else {
            $alert = new Alert('danger', 'Usuario Incorrecto');
            $this->ShowLogInView($alert);
        }
    }

    public function LogOut()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_unset();
        session_destroy();

        $this->ShowLogInView();
    }

    public static function VerifyLogIn()
    {
        if (isset($_SESSION['loggedUser'])) {
            if (isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 60 * 15)) {
                session_unset();
                session_destroy();
                header("Location: " . FRONT_ROOT . "Logger/ShowLogInView");
            } else {
                session_regenerate_id(true);
                $_SESSION['lastActivity'] = time();
            }
        } else {
            header("Location: " . FRONT_ROOT . "Logger/ShowLogInView");
        }
    }

    public function loadStudentData(User $user)
    {
        $studentUser = $this->studentDAO->GetByUserName($user->getUsername());
        $studentUser->setIdUser($user->getIdUser());
        $studentUser->setUsername($user->getUsername());
        $studentUser->setPassword($user->getPassword());
        $studentUser->setRole($user->getRole());
        $studentUser->setActive($user->getActive());
        $career = $this->careerDAO->GetbyId($studentUser->getCareerId());
        $studentUser->setCareerId($career);

        return $studentUser;
    }

    private function loadCompanyData(User $user)
    {
        $companyUser = $this->companyDAO->getCompanyByEmail($user->getUsername());
        if($companyUser) {
            $companyUser->setIdUser($user->getIdUser());
            $companyUser->setUsername($user->getUsername());
            $companyUser->setPassword($user->getPassword());
            $companyUser->setRole($user->getRole());
            $companyUser->setActive($user->getActive());
            
            return $companyUser;
        } else {
            
        }
    }
}
