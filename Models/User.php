<?php
    namespace Models;

    class User
    {
        private $idUser;
        private $username;
        private $password;
        private $role;
        private $active;

        public function __construct() 
        {

        }
        
	    public function getIdUser(){ return $this->idUser; }
	    public function setIdUser($idUser){ $this->idUser = $idUser; }
        
        public function getUsername(){ return $this->username; }
        public function setUsername($username){ $this->username = $username; }

        public function getPassword(){ return $this->password; }
        public function setPassword($password){ $this->password = $password; }

        public function getRole(){ return $this->role; }
        public function setRole($role){ $this->role = $role; }

	    public function getActive(){ return $this->active; }
	    public function setActive($active){ $this->active = $active; }

    }
?>