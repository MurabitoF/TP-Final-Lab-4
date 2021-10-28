<?php 

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\AddressDAO as AddressDAO;
use Exception;
use Models\Company as Company;
use Models\Address as Address;
use Models\Alert as Alert;

class CompanyController
{
    private $companyDAO;
    private $careerDAO;
    private $addressDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO;
        $this->careerDAO = new CareerDAO;
        $this->addressDAO = new AddressDAO;
    }

    public function ShowAddView($alert = null)
    {
        session_start();

        $careerList = $this->careerDAO->GetAll();

        if($alert){
        echo $alert->getType().": ". $alert->getMessage();
        }

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

        $addressList = $this->addressDAO->getAddresses($idCompany);

        require_once (VIEWS_PATH."company-data.php");
    }

    public function ShowListView($name = null, $city = null, $category = null)
    {
        session_start();
        $companyList = $this->companyDAO->getAll();
        
        $careerList = $this->careerDAO->GetAll();

        $addressList = $this->addressDAO->GetAll();

        if($name || $city || $category)
        {
            $companyList = $this->filterList($companyList, $name, $city, $category);
        }

        require_once (VIEWS_PATH."company-list.php");
    }

    public function Add($name, $city, $category, $description, $streetName, $streetAddress)
    {

        $alert = new Alert ("", "");

        try{
            $company = new Company();
            $company->setName($name);
            $company->setCategory($category);
            $company->setDescription($description);

            $address = new Address();
            $address->setCity($city);
            $address->setStreetName($streetName);
            $address->setStreetAddress($streetAddress);

            $this->companyDAO->Add($company);

            $idCompany = $this->companyDAO->getId($name);

            $this->addressDAO->Add($address, $idCompany);

        } catch(Exception $ex){

            $alert->setType("Error");
            if(str_contains($ex->getMessage(),1062))
            {
                $alert->setMessage("La empresa ingresada ya existe");
            } else
            {
                $alert->setMessage($ex->getMessage());
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
