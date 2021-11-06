<?php
    namespace Models;

    class JobOffer{
        private $idJobOffer;
        private $jobPosition;
        private $company;
        private $city;
        private $career;
        private $applicants;
        private $workload;
        private $requirements;
        private $active;
        private $title;
        private $description;
        private $postDate;
        private $expireDate;
        private $status;
        private $imgFlyer;


        public function __construct() {
            $this->active = true;
        }

        public function getIdJobOffer(){ return $this->idJobOffer; }
        public function setIdJobOffer($idJobOffer){ $this->idJobOffer = $idJobOffer; }

        public function getJobPosition(){ return $this->jobPosition; }
        public function setJobPosition($jobPosition){ $this->jobPosition = $jobPosition; }

        public function getCompany(){ return $this->company; }
        public function setCompany($company){ $this->company = $company; }

        public function getCity(){ return $this->city; }
        public function setCity($city){ $this->city = $city; }

        public function getCareer(){ return $this->career; }
        public function setCareer($career){ $this->career = $career; }

        public function getApplicants(){ return $this->applicants; }
        public function setApplicants($applicants){ $this->applicants = $applicants; }

        public function getWorkload(){ return $this->workload; }
        public function setWorkload($workload){ $this->workload = $workload; }

        public function getRequirements(){ return $this->requirements; }
        public function setRequirements($requirements){ $this->requirements = $requirements; }

        public function getActive(){ return $this->active; }
        public function setActive($active){ $this->active = $active; }

        public function getTitle(){ return $this->title; }
        public function setTitle($title){ $this->title =$title; }

        public function getDescription(){ return $this->description; }
        public function setDescription($description){ $this->description = $description; }

        public function getPostDate(){ return $this->postDate;}
        public function setPostDate($postDate){$this->postDate = $postDate;}

        public function getExpireDate(){return $this->expireDate;}
        public function setExpireDate($expireDate){ $this->expireDate = $expireDate;}

	    public function getStatus(){ return $this->status; }
	    public function setStatus($status){ $this->status = $status; }
        
	    public function getImgFlyer(){ return $this->imgFlyer; }
	    public function setImgFlyer($imgFlyer){ $this->imgFlyer = $imgFlyer; }
    }
