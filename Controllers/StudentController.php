<?php

namespace Controllers;

use Controllers\LoggerController as LoggerController;
use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;
class StudentController
{
    private $studentDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO();
    }

    public function ShowDataView($idUser)
    {
        session_start();
        LoggerController::VerifyLogIn();
        if($_SESSION['loggedUser']->getStudentId() == $idUser)
        {
            $user = $_SESSION["loggedUser"];
        } else {
            $user = $this->studentDAO->GetById($idUser);
        }
        require_once(VIEWS_PATH . "student-data.php");
    }

}
