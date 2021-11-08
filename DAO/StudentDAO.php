<?php

namespace DAO;

use DAO\IStudentDAO as IStudentDAO;
use Models\Student as Student;

class StudentDAO implements IStudentDAO
{
    private $studentList = array();

    public function Add(Student $student)
    {
        $this->RetrieveData();

        array_push($this->studentList, $student);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->studentList;
    }

    public function GetByUserName($username)
    {
        $this->RetrieveData();

        foreach ($this->studentList as $arrayValue) {
            if ($arrayValue->getEmail() == $username) {
                return $arrayValue;
            }
        }

        return NULL;
    }

    public function GetById($id)
    {
        $this->RetrieveData();

        foreach ($this->studentList as $arrayValue) {
            if ($arrayValue->getIdStudent() == $id) { ///MODIFICADA
                return $arrayValue;
            }
        }

        return NULL;
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->studentList as $student) {
            $valuesArray["recordId"] = $student->getRecordId();
            $valuesArray["firstName"] = $student->getFirstName();
            $valuesArray["lastName"] = $student->getLastName();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents('Data/students.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $ch = curl_init();

        $url = 'https://utn-students-api.herokuapp.com/api/Student';

        $header = array(
            'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);

        $arrayToDecode = ($response) ? json_decode($response, true) : array();

        foreach ($arrayToDecode as $valuesArray) {
            $student = new Student();
            $student->setStudentId($valuesArray["studentId"]);
            $student->setFirstName($valuesArray["firstName"]);
            $student->setLastName($valuesArray["lastName"]);
            $student->setCareerId($valuesArray["careerId"]);
            $student->setDni($valuesArray["dni"]);
            $student->setFileNumber($valuesArray["fileNumber"]);
            $student->setGender($valuesArray["gender"]);
            $student->setBirthDate($valuesArray["birthDate"]);
            $student->setEmail($valuesArray["email"]);
            $student->setPhoneNumber($valuesArray["phoneNumber"]);
            $student->setState($valuesArray['active']);

            array_push($this->studentList, $student);
        }
    }
}
