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

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "student-add.php");
    }

    public function ShowDataView()
    {
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

    public function LogIn($username, $password)
    {
        $user = $this->studentDAO->GetByUserName($username); ///FUNCION AGREGADA POR MI EN StudentDAO.php

        if (($user != null)) {
            session_start();

            $loggedUser = $user;

            $_SESSION["loggedUser"] = $loggedUser;

            $this->ShowDataView();
        }
    }
}
