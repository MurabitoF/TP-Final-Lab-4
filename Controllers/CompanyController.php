<?php 

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use DAO\CareerDAO as CareerDAO;
use Exception;
use Models\Company as Company;
use Models\Alert as Alert;

class CompanyController
{
    private $companyDAO;
    private $careerDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO;
        $this->careerDAO = new CareerDAO;
    }

    public function ShowAddView($alert)
    {
        session_start();

        $careerList = $this->careerDAO->GetAll();

        echo $alert->getType().": ". $alert->getMessage();

        require_once (VIEWS_PATH."company-add.php");
    }

    public function ShowEditView($Edit)
    {
        session_start();

        $company = $this->companyDAO->searchId($Edit);
        
        $this->companyDAO->Edit($company);
        $careerList = $this->careerDAO->GetAll();
        $career = $this->careerDAO->GetbyId($company->getCategory());

        require_once (VIEWS_PATH."company-edit.php");
    }

    public function ShowDataView($idCompany)
    {
        session_start();

        $company = $this->companyDAO->searchId($idCompany);

        $career = $this->careerDAO->GetbyId($company->getCategory());

        require_once (VIEWS_PATH."company-data.php");
    }

    public function ShowListView($name = null, $city = null, $category = null)
    {
        session_start();
        $companyList = $this->companyDAO->getAll();
        
        $careerList = $this->careerDAO->GetAll();

        if($name || $city || $category)
        {
            $companyList = $this->filterList($companyList, $name, $city, $category);
        }

        require_once (VIEWS_PATH."company-list.php");
    }

    public function Add($name, $city, $category, $description, $street, $streetAddress, $postalCode)
    {

        $alert = new Alert ("", "");

        try{
            $company = new Company();
            $company->setIdCompany(count($this->companyDAO->GetAll())+1);
            $company->setName($name);
            $company->setCity($city);
            $company->setCategory($category);
            $company->setDescription($description);
            $company->setStreet($street);
            $company->setStreetAddress($streetAddress);
            $company->setPostalCode($postalCode);

            $this->companyDAO->Add($company);

        } catch(Exception $ex){

            $alert->setType("Error");
            if(str_contains($ex->getMessage(),1062))
            {
                $alert->setMessage("La empresa ingresada ya existe");
            }

        }finally{
            $this->ShowAddView($alert);
        }
    }

    public function Edit ($idCompany, $name, $city, $category, $state, $description, $street, $streetAddress, $postalCode)
    {
        $company = $this->companyDAO->searchId($idCompany);

        $company->setName($name);
        $company->setCity($city);
        $company->setCategory($category);
        $company->setDescription($description);
        $company->setStreet($street);
        $company->setStreetAddress($streetAddress);
        $company->setPostalCode($postalCode);
        $company->setState($state);

        $this->companyDAO->Edit($company);
        
        $this->ShowListView();
    }

    public function Action($Remove = "", $Edit = "", $getData = "")
    {
        if ($Edit != "")
        {
            $this->ShowEditView($Edit);
        } else if($Remove != "")
        {
            $this->companyDAO->Remove($Remove);
            $this->ShowListView();
        } else if($getData != "")
        {
            $this->ShowDataView($getData);
        } else
        {
            echo "Ha ocurrido un error";
        }
    }

    private function filterList($companyList, $name, $city, $category)
    {
    if($name)
        {
            $filteredList = array();
            foreach($companyList as $company)
            {
                if(str_contains(strtolower($company->getName()), strtolower($name)))
                {
                    array_push($filteredList, $company);
                }
            }
            $companyList = $filteredList;
        }
        if($city)
        {
            $filteredList = array();
            foreach($companyList as $company)
            {
                if(str_contains(strtolower($company->getCity()), strtolower($city)))
                {
                    array_push($filteredList, $company);
                }
            }
            $companyList = $filteredList;
        }
        if($category)
        {
            $filteredList = array();
            foreach($companyList as $company)
            {
                if(str_contains($company->getCategory(), $category))
                {
                    array_push($filteredList, $company);
                }
            }
            $companyList = $filteredList;
        }
        return $companyList;
    }
}
