<?php
    namespace Models;

    use Models\Person as Person;

    class Student extends Person
    {
        private $studentId; ///CAMBIE RECORDID POR STUDENTID
        private $carrerId;
        private $dni;
        private $fileNumber;
        private $gender;
        private $birthDate;
        private $email;
        private $phoneNumber;
        private $password; ///LA AGREGUE YO, DESPUES VEREMOS SI LA USAMOS

        function __construct()
        {
                
        }

        public function getStudentId()
        {
                return $this->studentId;
        }

        public function setStudentId($studentId)
        {
                $this->studentId = $studentId;
        }

        public function getCarrerId()
        {
                return $this->carrerId;
        }

        public function setCarrerId($carrerId)
        {
                $this->carrerId = $carrerId;
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

