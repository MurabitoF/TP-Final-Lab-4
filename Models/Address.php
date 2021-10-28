<?php
    namespace Models;

    class Address{

        private $idAddress;
        private $city;
        private $streetName;
        private $streetAddress;
        private $latitude;
        private $longitude;
        private $idCompany;
        private $active;
        
        public function getIdAddress()
        {
                return $this->idAddress;
        }

        public function setIdAddress($idAddress)
        {
                $this->idAddress = $idAddress;

                return $this;
        }

        public function getCity()
        {
                return $this->city;
        }

        public function setCity($city)
        {
                $this->city = $city;

                return $this;
        }

        public function getLatitude()
        {
                return $this->latitude;
        }

        public function setLatitude($latitude)
        {
                $this->latitude = $latitude;

                return $this;
        }

        public function getLongitude()
        {
                return $this->longitude;
        }

        public function setLongitude($longitude)
        {
                $this->longitude = $longitude;

                return $this;
        }

        public function getIdCompany()
        {
                return $this->idCompany;
        }

        public function setIdCompany($idCompany)
        {
                $this->idCompany = $idCompany;

                return $this;
        }

        public function getActive()
        {
                return $this->active;
        }

        public function setActive($active)
        {
                $this->active = $active;

                return $this;
        }
 
        public function getStreetName()
        {
                return $this->streetName;
        }

        public function setStreetName($streetName)
        {
                $this->streetName = $streetName;

                return $this;
        }

        public function getStreetAddress()
        {
                return $this->streetAddress;
        }

        public function setStreetAddress($streetAddress)
        {
                $this->streetAddress = $streetAddress;

                return $this;
        }
    }
