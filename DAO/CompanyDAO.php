<?php 

namespace DAO;

use DAO\ICompanyDAO as ICompanyDAO;
use Models\Company as Company;

class CompanyDAO implements ICompanyDAO{
    
    private $companyList = array();

    public function Add(Company $company){
       
        $this->retriveData();

        array_push($this->companyList, $company);

        $this->saveData();
    }

    public function GetAll(){

        $this->retriveData();
        
        return $this->companyList;
    }

    private function saveData(){
        $arrayToEncode = array();
        foreach ($this->companyList as $company)
        {
            $valuesArray["idCompany"] = $company->getIdCompany();
            $valuesArray["name"] = $company->getName();
            $valuesArray["city"] = $company->getCity();

            array_push($arrayToEncode, $valuesArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/companies.json',$jsonContent);
    }

    private function retriveData(){
        $this->companyList = array();
        if(file_exists('Data/companies.json'))
        {
            $jsonContent = file_get_contents('Data/companies.json');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $company = new Company();
                $company->setIdCompany($valuesArray["idCompany"]);
                $company->setName(($valuesArray["name"]));
                $company->setCity($valuesArray["city"]);

                array_push($this->companyList, $company);
            }
        }
    }

}

?>