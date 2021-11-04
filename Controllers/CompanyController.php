<?php 

namespace Controllers;

use Exception;
use DAO\CompanyDAO as CompanyDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\AddressDAO as AddressDAO;
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


    public function ShowAddView($alert = NULL)
    {
        session_start();

        $careerList = $this->careerDAO->GetAll();

        require_once (VIEWS_PATH."company-add.php");
    }

    public function ShowEditView($idCompany, $alert = NULL)
    {
        session_start();

        $company = $this->companyDAO->searchId($idCompany);
        
        $this->companyDAO->Edit($company);

        $address= $this->addressDAO->getAddresses($idCompany);

        require_once (VIEWS_PATH."company-edit.php");
    }

    public function ShowDataView($idCompany)
    {
        session_start();

        $company = $this->companyDAO->searchId($idCompany);

        $address= $this->addressDAO->getAddresses($idCompany);

        require_once (VIEWS_PATH."company-data.php");
    }

    public function ShowListView($alert = NULL, $name = null, $city = null)
    {
        session_start();

        $parameters = array();
        $parameters ["companyName"] = $name;
        $parameters ["city"] = $city;
        
        $companyList = $this->companyDAO->filterList($parameters);


        $addressList = $this->addressDAO->GetAll();

        
        require_once (VIEWS_PATH."company-list.php");
    }

    public function Add($name, $cuit, $phoneNumber, $email, $city, $description, $streetName, $streetAddress)
    {

        $alert = new Alert ("", "");

        try{
            $company = new Company();
            $company->setName($name);
            $company->setCUIT($cuit);
            $company->setPhoneNumber($phoneNumber);
            $company->setEmail($email);
            $company->setDescription($description);

            $address = new Address();
            $address->setCity($city);
            $address->setStreetName($streetName);
            $address->setStreetAddress($streetAddress);

            $this->companyDAO->Add($company);

            $idCompany = $this->companyDAO->getId($name);

            $this->addressDAO->Add($address, $idCompany);

            $alert->setType("success");
            $alert->setMessage("La empresa a sido ingresada con existo");

        } catch(Exception $ex){

            if(str_contains($ex->getMessage(),1062))
            {
                $alert->setType("warning");
                $alert->setMessage("La empresa ingresada ya existe");
            } else
            {
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }

        }finally{
            $this->ShowAddView($alert);
        }
    }

    public function Edit ($idCompany, $name, $cuit, $phoneNumber, $email, $city, $state, $description, $streetName, $streetAddress)
    {
        try{
        $company = $this->companyDAO->searchId($idCompany);

        $address = $this->addressDAO->getAddresses($idCompany);

        $company->setName($name);
        $company->setCUIT($cuit);
        $company->setPhoneNumber($phoneNumber);
        $company->setEmail($email);
        $company->setDescription($description);
        $company->setState($state);

        $this->companyDAO->Edit($company);

        $address->setCity($city);
        $address->setStreetName($streetName);
        $address->setStreetAddress($streetAddress);

        $this->addressDAO->Edit($address);

        $alert = new Alert("success", $name." fue editada con exito.");

        $this->ShowListView($alert);

        }catch(Exception $ex){
            $alert = new Alert("danger", $ex->getMessage());
            $this->ShowEditView($idCompany, $alert);
        }
        
    }

    public function Remove($idCompany)
    {
            $this->companyDAO->Remove($idCompany);
            $this->addressDAO->Remove($idCompany);
            $this->ShowListView();
    }
}
