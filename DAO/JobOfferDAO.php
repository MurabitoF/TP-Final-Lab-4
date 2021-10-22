<?php

namespace DAO;

use DAO\IJobOfferDAO as IJobOfferDAO;
use Models\JobOffer as JobOffer;

class JobOfferDAO implements IJobOfferDAO
{

    private $jobOfferList = array();

    public function Add(JobOffer $jobOffer)
    {
        $this->retriveData();

        array_push($this->jobOfferList, $jobOffer);

        $this->saveData();
    }

    public function GetAll()
    {
        $this->retriveData();

        return $this->jobOfferList;
    }

    public function Remove($idJobOffer)
    {
        $this->retriveData();

        foreach ($this->jobOfferList as $key => $value) {
            if ($value->getIdJobOffer == $idJobOffer) {
                $this->jobOfferList[$key]->setState(false);
            }
        }
        $this->saveData();
    }

    private function saveData()
    {
        $arrayToEncode = array();
        foreach ($this->jobOfferList as $jobOffer) {
            $valuesArray["idJobOffer"] = $jobOffer->getIdJobOffer();
            $valuesArray["jobPosition"] = $jobOffer->getJobPosition();
            $valuesArray["company"] = $jobOffer->getCompany();
            $valuesArray["income"] = $jobOffer->getIncome();
            $valuesArray["city"] = $jobOffer->getCity();
            $valuesArray["category"] = $jobOffer->getCategory();
            $valuesArray["applicants"] = $jobOffer->getApplicants();
            $valuesArray["workload"] = $jobOffer->getWorkload();
            $valuesArray["requirements"] = $jobOffer->getRequirements();
            $valuesArray["state"] = $jobOffer->getState();
            $valuesArray["title"] = $jobOffer->getTitle();
            $valuesArray["description"] = $jobOffer->getDescription();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/jobOffers.json', $jsonContent);
    }

    private function retriveData()
    {
        $this->jobOfferList = array();
        if (file_exists('Data/jobOffers.json')) {
            $jsonContent = file_get_contents('Data/jobOffers.json');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {
                if ($valuesArray["state"]) {
                    $jobOffer = new JobOffer();
                    $jobOffer->setIdJobOffer($valuesArray["idJobOffer"]);
                    $jobOffer->setJobPosition(($valuesArray["jobPosition"]));
                    $jobOffer->setIncome($valuesArray["income"]);
                    $jobOffer->setCity($valuesArray["city"]);
                    $jobOffer->setCategory($valuesArray["category"]);
                    $jobOffer->setApplicants($valuesArray["applicants"]);
                    $jobOffer->setWorkload($valuesArray["workload"]);
                    $jobOffer->setRequirements($valuesArray["requeriments"]);
                    $jobOffer->setState($valuesArray["state"]);
                    $jobOffer->setTitle($valuesArray["title"]);
                    $jobOffer->setDescription($valuesArray["description"]);

                    array_push($this->jobOfferList, $jobOffer);
                }
            }
        }
    }
}
