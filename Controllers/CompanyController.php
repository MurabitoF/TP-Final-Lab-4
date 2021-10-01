<?php 

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;

class CompanyController
{
    private $companyDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO;
    }

    public function ShowAddView()
    {
        require_once (VIEWS_PATH."company-add.php");
    }

    public function ShowListView()
    {
        $companyList = $this->companyDAO->getAll();

        require_once(VIEWS_PATH."company-list.php");
    }

    public function Add($idCompany, $name, $city)
    {
        $company = new Company();
        $company->setIdCompany($idCompany);
        $company->setName($name);
        $company->setCity($city);

        $this->companyDAO->Add($company);

        $this->ShowAddView();
    }
}

?>