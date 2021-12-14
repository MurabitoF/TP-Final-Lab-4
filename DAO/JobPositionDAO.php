<?php
namespace DAO;

use DAO\IJobPositionDAO as IJobPositionDAO;
use Models\JobPosition as JobPosition;

class JobPositionDAO implements IJobPositionDAO{
    private $jobPositionList = array();

    public function GetJobPositionById($id)
    {
        $this->RetreveData();

        foreach($this->jobPositionList as $jobPosition)
        {
            if($jobPosition->getIdJobPosition() == $id){
                return $jobPosition;
            }
        }
        return NULL;
    }

    public function GetAll()
    {
        $this->RetreveData();

        return $this->jobPositionList;
    }

    private function RetreveData()
    {
        $ch = curl_init();

        $url = "https://utn-students-api2.herokuapp.com/api/JobPosition";

        $header = array(
            'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);

        $arrayToDecode = ($response) ? json_decode($response, true) : array();

        foreach($arrayToDecode as $jsonItem)
        {
            $jobPosition = new JobPosition;
            $jobPosition->setIdJobPosition($jsonItem['jobPositionId']);
            $jobPosition->setCareerId($jsonItem['careerId']);
            $jobPosition->setName($jsonItem['description']);

            array_push($this->jobPositionList, $jobPosition);
        }
    }
}
?>