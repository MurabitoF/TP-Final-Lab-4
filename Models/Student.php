<?php
    namespace Models;
    class Student
    {
        private $studentId; ///CAMBIE RECORDID POR STUDENTID
        private $careerId;
        private $dni;
        private $firstName;
        private $lastName;
        private $fileNumber;
        private $gender;
        private $birthDate;
        private $email;
        private $phoneNumber;
        private $state;
        private $password; ///LA AGREGUE YO, DESPUES VEREMOS SI LA USAMOS

        function __construct()
        {
                
        }

        public function getFirstName()
        {
            return $this->firstName;
        }

        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

        public function getLastName()
        {
            return $this->lastName;
        }

        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
        }

        public function getStudentId()
        {
                return $this->studentId;
        }

        public function setStudentId($studentId)
        {
                $this->studentId = $studentId;
        }

        public function getCareerId()
        {
                return $this->careerId;
        }

        public function setCareerId($careerId)
        {
                $this->careerId = $careerId;
        }

        public function getDni()
        {
                return $this->dni;
        }

        public function setDni($dni)
        {
                $this->dni = $dni;
        }

        public function getFileNumber()
        {
                return $this->fileNumber;
        }

        public function setFileNumber($fileNumber)
        {
                $this->fileNumber = $fileNumber;
        }

        public function getGender()
        {
                return $this->gender;
        }

        public function setGender($gender)
        {
                $this->gender = $gender;
        }

        public function getBirthDate()
        {
                return $this->birthDate;
        }

        public function setBirthDate($birthDate)
        {
                $this->birthDate = $birthDate;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;
        }

        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;
        }
        
        public function getState()
        {
                return $this->state;
        }

        public function setState($state)
        {
                $this->state = $state;
        }

        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                $this->password = $password;
        }

    }
?>

