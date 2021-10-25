<?php

namespace DAO;

use Models\Exception as Exception;
use DAO\ICompanyDAO as ICompanyDAO;
use DAO\Connection as Connection;
use Models\Company as Company;
use Models\City as City;
use Models\Categoty as Category;

class CompanyDAO implements ICompanyDAO
{
    private $connection;

    private $tableName = "Company";

    public function Add(Company $company)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (name, description, street, streetAddress, active, postalCode, idJobPosition) VALUES (:name, :description, :street, :streetAddress, :active, :postalCode, :idJobPosition);";
            $parameters["name"] = $company->getName();
            $parameters["description"] = $company->getDescription();
            $parameters["street"] = $company->getStreet();
            $parameters["streetAddress"] = $company->getStreetAddress();
            $parameters["active"] = $company->getState();
            $parameters["postalCode"] = $company->getPostalCode();
            $parameters["idJobPosition"] = $company->getCategory();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
            
        } catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetAll()
    {

        try{

            $companyList = array();
    
            $query = "SELECT * FROM ".$this->tableName;
    
            $this->connection = Connection::GetInstance();
    
            $resultSet = $this->connection->Execute($query);
    
            foreach($resultSet as $row){
    
                $company = new Company();
                
                $company->setIdCompany($row["idCompany"]);
                $company->setName($row["name"]);
                $company->setDescription($row["description"]);
                $company->setStreet($row["street"]);
                $company->setStreetAddress($row["streetAddress"]);
                $company->setState($row["active"]);
                $company->setPostalCode($row["postalCode"]);
                $company->setCategory($row["idJobPosition"]);


    
                array_push($companyList, $company);
    
            }
    
            return $companyList;
    
           } catch (Exception $ex)
           {
               throw $ex;
           }

    }

    public function Remove($idCompany)
    {
       
        try{

            $query = "UPDATE ".$this->tableName." SET active = FALSE WHERE idCompany = ".$idCompany;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex)
        {
            throw $ex;
        }

    }

    public function Edit($company)
    {
        try{

            $query = "UPDATE ".$this->tableName." SET name =\"". $company->getName() ."\",
            description =\"". $company->getDescription() ."\",
            street =\"". $company->getStreet() ."\",
            streetAddress =". $company->getStreetAddress() .",
            active =". $company->getState() .",
            postalCode =". $company->getPostalCode() .",
            idJobPosition =". $company->getCategory() ." WHERE idCompany = ". $company->getIdCompany();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function searchId($idCompany)
    {
        $foundCompany = new Company;
        try{
            $query = "SELECT * FROM " .$this->tableName. " WHERE `idCompany` = ". $idCompany;

            $this->connection = Connection::GetInstance();

            $foundCompany  = $this->connection->Execute($query);
            
            foreach ($foundCompany as $row)
            {
                $company = new Company();
                
                $company->setIdCompany($row["idCompany"]);
                $company->setName($row["name"]);
                $company->setDescription($row["description"]);
                $company->setStreet($row["street"]);
                $company->setStreetAddress($row["streetAddress"]);
                $company->setState($row["active"]);
                $company->setPostalCode($row["postalCode"]);
                $company->setCategory($row["idJobPosition"]);

            }

            return $company ;

        } catch(Exception $ex)
        {
            throw $ex;
        }
    }
}
