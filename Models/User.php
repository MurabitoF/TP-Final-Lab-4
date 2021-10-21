<?php
    namespace Models;

    class User{
        private $username;
        private $password;
        private $role;

        public function __construct($username, $password) {
            $this->username = $username;
            $this->password = $password;
            $this->role = 'Student';
        }
        
        public function getUsername(){ return $this->username; }
        public function setUsername($username){ $this->username = $username; }

        public function getPassword(){ return $this->password; }
        public function setPassword($password){ $this->password = $password; }

        public function getRole(){ return $this->role; }
        public function setRole($role){ $this->role = $role; }

    }
?>