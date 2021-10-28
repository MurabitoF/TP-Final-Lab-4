<?php

namespace DAO;

use \Exception as Exception;
use DAO\ICompanyDAO as ICompanyDAO;
use DAO\Connection as Connection;
use Models\Company as Company;
use Models\Categoty as Category;

class CompanyDAO implements ICompanyDAO
{
    private $connection;

    private $tableName = "Company";

    public function Add(Company $company)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (companyName, description, active, idJobPosition) VALUES (:companyName, :description, :active, :idJobPosition);";
            $parameters["companyName"] = $company->getName();
            $parameters["description"] = $company->getDescription();
            $parameters["active"] = $company->getState();
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
                $company->setName($row["companyName"]);
                $company->setDescription($row["description"]);
                $company->setState($row["active"]);
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

            $query = "UPDATE ".$this->tableName." SET companyName =\"". $company->getName() ."\",
            description =\"". $company->getDescription() ."\",
            active =". $company->getState() .",
            idJobPosition =". $company->getCategory() ." WHERE idCompany = ". $company->getIdCompany();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function getId($name)
    {
        $foundCompany = new Company;
        try{

            $query = "SELECT idCompany FROM " .$this->tableName. ' WHERE companyName = :companyName;';

            $parameters["companyName"] = "$name";

            $this->connection = Connection::GetInstance();
    
            $foundCompany  = $this->connection->Execute($query, $parameters);

            $idCompany = $foundCompany[0]["idCompany"];
            
            return $idCompany;

        } catch(Exception $ex)
        {
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
                $company->setName($row["companyName"]);
                $company->setDescription($row["description"]);
                $company->setState($row["active"]);
                $company->setCategory($row["idJobPosition"]);

            }

            return $company ;

        } catch(Exception $ex)
        {
            throw $ex;
        }
    }
}
