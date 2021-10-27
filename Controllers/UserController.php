<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;
use DAO\UserDAO as UserDAO;
use Models\User as User;
use DAO\CareerDAO as CareerDAO;
use Models\Career as Career;
use Models\Alert as Alert;

    class UserController
    {
        private $userDAO;
        private $studentDAO;
        private $careerDAO;

        public function __construct() {
            $this->userDAO = new UserDAO;
            $this->studentDAO = new StudentDAO;
            $this->careerDAO = new CareerDAO;
        }

        public function ShowHomeView()
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function ShowLogInView($alert = NULL)
        {
            if(session_status() != PHP_SESSION_ACTIVE)
            {
                session_start();
            }
            if(isset($_SESSION['loggedUser']))
            {
                $this->ShowHomeView();
            }else{
                require_once(VIEWS_PATH."login.php");
            }
        }

        public function Add($username, $verifiedPassword)
        {
            $encryptedPass = password_hash($verifiedPassword, PASSWORD_DEFAULT);
            $newUser = new User();
            $newUser->setUsername($username);
            $newUser->setPassword($encryptedPass);
            $newUser->setRole('Student');
            $newUser->setActive(true);

            $this->userDAO->Add($newUser);
            
            $this->ShowLogInView();
        }

        public function ShowRegisterView($user = NULL, $message = "")
        {
            require_once(VIEWS_PATH."register.php");
        }

        public function LogIn($username, $password, $remeberMe = false)
        {
            session_start();

            $user = $this->userDAO->GetByUserName($username);

            if($user){
                if($user->getActive()){
                    if(password_verify($password, $user->getPassword())){
                        if($user->getRole() === "Student"){
                            $studentUser = $this->studentDAO->GetByUserName($username);
                            $studentUser->setUsername($user->getUsername());
                            $studentUser->setPassword($user->getPassword());
                            $studentUser->setRole($user->getRole());
                            $studentUser->setActive($user->getActive());

                            $_SESSION['loggedUser'] = $studentUser;
                            $_SESSION['lastActivity'] = time();
                        }else{
                            $_SESSION['loggedUser'] = $user;
                            $_SESSION['lastActivity'] = time();
                        }
                        $this->ShowHomeView();
                    }else{
                        $alert = new Alert('danger', 'Contraseña Incorrecta');
                        $this->ShowLogInView($alert);
                    }
                }else{
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
            if(session_status() != PHP_SESSION_ACTIVE)
            {
                session_start();
            }
            session_unset();
            session_destroy();
        
            $this->ShowLogInView();
        }

        public function VerifyEmail($email)
        {
            $user = $this->userDAO->GetByUserName($email);
            $message = "";
            if(!$user){
                $user = $this->studentDAO->GetByUserName($email);
                if($user)
                {
                    if($user->getState())
                    {
                        $career = $this->careerDAO->GetbyId($user->GetCareerId());
                        $user->setCareerId($career->getName());
                        $this->ShowRegisterView($user);          
                    } else {
                        $message = "Usted no se encuentra activo en el sistema de la UTN";
                        $this->ShowRegisterView(NULL ,$message);
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