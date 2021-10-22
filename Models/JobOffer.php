<?php
    namespace Models;

    class JobOffer{
        private $idJobOffer;
        private $jobPosition;
        private $company;
        private $income;
        private $city;
        private $category;
        private $applicants;
        private $workload;
        private $requirements;
        private $state;
        ///Agregadas por mi
        private $title;
        private $description;

        public function __construct() { ///vacie el constructor para mas facilidad en JobOfferDAO
            $this->state = true;
        }

        public function getIdJobOffer(){ return $this->idJobOffer; }
        public function setIdJobOffer($idJobOffer){ $this->idJobOffer = $idJobOffer; }

        public function getJobPosition(){ return $this->jobPosition; }
        public function setJobPosition($jobPosition){ $this->jobPosition = $jobPosition; }

        public function getCompany(){ return $this->company; }
        public function setCompany($company){ $this->company = $company; }

        public function getIncome(){ return $this->income; }
        public function setIncome($income){ $this->income = $income; }

        public function getCity(){ return $this->city; }
        public function setCity($city){ $this->city = $city; }

        public function getCategory(){ return $this->category; }
        public function setCategory($category){ $this->category = $category; }

        public function getApplicants(){ return $this->applicants; }
        public function setApplicants($applicants){ $this->applicants = $applicants; }

        public function getWorkload(){ return $this->workload; }
        public function setWorkload($workload){ $this->workload = $workload; }

        public function getRequirements(){ return $this->requirements; }
        public function setRequirements($requirements){ $this->requirements = $requirements; }

        public function getState(){ return $this->state; }
        public function setState($state){ $this->state = $state; }

        ///NUEVOS GETTERS Y SETTER
        public function getTitle(){ return $this->title; }
        public function setTitle($title){ return $this; }

        public function getDescription(){ return $this->description; }
        public function setDescription($description){ return $this; }
    }
