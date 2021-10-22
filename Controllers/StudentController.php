<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;

class StudentController
{
    private $studentDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO();
    }

    public function ShowHomeView()
    {
        require_once(VIEWS_PATH . "home.php");
    }

    public function ShowAddView()
    {
        session_start();
        require_once(VIEWS_PATH . "student-add.php");
    }

    public function ShowDataView()
    {
        session_start();
        $loggedUser = $_SESSION["loggedUser"] ;
        require_once(VIEWS_PATH . "student-data.php");
    }

    public function Add($studentId, $firstName, $lastName)
    {
        $student = new Student();
        $student->setStudentId($studentId);
        $student->setfirstName($firstName);
        $student->setLastName($lastName);

        $this->studentDAO->Add($student);

        $this->ShowAddView();
    }

}
