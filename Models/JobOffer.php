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

        public function __construct($idJobOffer, $jobPosition, $company, $income = 0, $city = "Remoto", $category, $workload, $requirements, $state = "abierta") {
            $this->idJobOffer = $idJobOffer;
            $this->jobPosition = $jobPosition;
            $this->company = $company;
            $this->income = $income;
            $this->city = $city;
            $this->category = $category;
            $this->applicants = array();
            $this->workload = $workload;
            $this->requirements = $requirements;
            $this->state = $state;
        }

        public function getIdJobOffer(){ return $this->idJobOffer; }

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
    }
