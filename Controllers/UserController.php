<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;
use DAO\UserDAO as UserDAO;
use Models\User as User;

    class UserController
    {
        private $userDAO;
        private $studentDAO;

        public function __construct() {
            $this->userDAO = new UserDAO;
            $this->studentDAO = new StudentDAO;
        }

        public function ShowHomeView()
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function ShowLogInView()
        {
            session_start();
            if(isset($_SESSION['loggedUser']))
            {
                $this->ShowHomeView();
            }else{
                require_once(VIEWS_PATH."login.php");
            }
        }

        public function LogIn($username, $password, $remeberMe = false)
        {
            session_start();
            if($username != "admin@email.com")
            {
                $user = $this->studentDAO->GetByUserName($username);
                if (($user != null)) {
                    $user->setUsername($username);
                    $user->setPassword($password);
                    $loggedUser = $user;
                    

                    $_SESSION["loggedUser"] = $loggedUser;
                    $_SESSION['lastActivity'] = time();
                    $this->ShowHomeView();
                }
            }else{
                $user = new User($username, "");
                $user->setRole('Admin');

                $_SESSION["loggedUser"] = $user;
                $_SESSION['lastActivity'] = time();
                $this->ShowHomeView();
            }
        }

        public function LogOut()
        {
            session_start();
            session_unset();
            session_destroy();
        
            $this->ShowLogInView();
        }

        public function VerifyLogIn()
        {
            if(isset($_SESSION['loggedUser'])){
                if(isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 60*15)){
                       $this->logOut();
                }else{
                    session_regenerate_id(true);
                    $_SESSION['lastActivity'] = time();
                }
            } else {
                $this->ShowLogInView();
            }
        }
    }