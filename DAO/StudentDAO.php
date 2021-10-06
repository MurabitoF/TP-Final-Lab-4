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

        public function GetByUserName($username){ ///FUNCION AGREGADA POR MI
            $ch = curl_init();

            $url = 'https://utn-students-api.herokuapp.com/api/Student';
        
            $header = array(
                'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
            );
        
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        
            $response = curl_exec($ch);
        
            $arrayToDecode = json_decode($response, true);
            $student = null;
        
            for($i = 0; $i < 200; $i++){
                foreach($arrayToDecode[$i] as $arrayKey => $arrayValue){
                    if($arrayToDecode[$i]['email'] == $username){
                        $student = $arrayToDecode[$i];
                    }
                }
            }

            return $student;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->studentList as $student)
            {
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
            $this->studentList = array();

            if(file_exists('Data/students.json'))
            {
                $jsonContent = file_get_contents('Data/students.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $student = new Student();
                    $student->setStudentId($valuesArray["studentId"]); ///MODIFIQUE recordId por studentId (MIRAR BIEN ESTO)
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);
                    /*$student->setCarrerId($valuesArray[]);
                    $student->setDni($valuesArray[]);
                    $student->setFileNumber($valuesArray[]);
                    $student->setGender($valuesArray[]);
                    $student->setBirthDate($valuesArray[]);
                    $student->setEmail($valuesArray[]);
                    $student->setPhoneNumber($valuesArray[]);
                    $student->setPassword($valuesArray[]);*/


                    array_push($this->studentList, $student);
                }
            }
        }
    }
?>