<?php
    namespace Models;

    abstract class User{
        private $username;
        private $password;
        private $type;

        public function __construct($username, $password) {
            $this->username = $username;
            $this->password = $password;
            $this->type = 'Student';
        }
        
        public function getUsername(){ return $this->username; }
        public function setUsername($username){ $this->username = $username; }

        public function getPassword(){ return $this->password; }
        public function setPassword($password){ $this->password = $password; }

        public function getType(){ return $this->type; }
        public function setType($type){ $this->type = $type; }

    }
?>