<?php

namespace DAO;

use DAO\ICareerDAO as ICareerDAO;
use DAO\Connection as Connection;
use Models\Career as Career;
use Models\Exception as Exception;

class CareerDAO implements ICareerDAO{

    private $careerList = array();

    public function GetAll(){

        $this->RetrieveData();

        return $this->careerList;
    }

    public function GetbyId($idCareer){

        $this->RetrieveData();

        foreach($this->careerList as $career)
        {
            if($career->getIdCareer() == $idCareer)
            {
                return $career;
            }
        }
    }

    private function RetrieveData()
    {
        $ch = curl_init();

        $url = 'https://utn-students-api.herokuapp.com/api/Career';

        $header = array(
            'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);

        $arrayToDecode = ($response) ? json_decode($response, true) : array();
            foreach ($arrayToDecode as $valuesArray)
            {
                $career = new Career;
                
                $career->setIdCareer($valuesArray["careerId"]);
                $career->setName($valuesArray["description"]);
                $career->setActive($valuesArray["active"]);

                array_push($this->careerList, $career);
                
            }
    }
}
