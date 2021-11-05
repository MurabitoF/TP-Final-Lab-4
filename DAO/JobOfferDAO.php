<?php

namespace DAO;

use \Exception as Exception;
use DAO\IJobOfferDAO as IJobOfferDAO;
use Models\JobOffer as JobOffer;
use DAO\Connection as Connection;

class JobOfferDAO implements IJobOfferDAO
{
    private $connection;

    private $tableName = "JobOffers";

    public function Add(JobOffer $jobOffer)
    {
        try{
            $query = "INSERT INTO ". $this->tableName . " (title, description, workload, requirements, postDate, expireDate, active, city, idCompany, idJobPosition, idCareer) 
            VALUES (:title, :description, :workload, :requirements, :postDate, :expireDate, :active, :city, :idCompany, :idJobPosition, :idCareer);";

            $parameters["title"] = $jobOffer->getTitle();
            $parameters["description"] = $jobOffer->getDescription();
            $parameters["workload"] = $jobOffer->getWorkload();
            $parameters["requirements"] = $jobOffer->getRequirements();
            $parameters["postDate"] = $jobOffer->getPostDate();
            $parameters["expireDate"] = $jobOffer->getExpireDate();
            $parameters["active"] = $jobOffer->getActive();
            $parameters["city"] = $jobOffer->getCity();
            $parameters["idCompany"] = $jobOffer->getCompany();
            $parameters["idJobPosition"] = intval($jobOffer->getJobPosition());
            $parameters["idCareer"] = intval($jobOffer->getCareer());

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
            
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetAll()
    {
        try{
            $jobOfferList = array();
    
            $query = "SELECT * FROM ".$this->tableName;
    
            $this->connection = Connection::GetInstance();
    
            $resultSet = $this->connection->Execute($query);
    
            foreach($resultSet as $row)
            {
                $jobOffer = new JobOffer();
                
                $jobOffer->setIdJobOffer($row["idJobOffer"]);
                $jobOffer->setJobPosition($row["idJobPosition"]);
                $jobOffer->setCompany($row["idCompany"]);
                $jobOffer->setPostDate($row["postDate"]);
                $jobOffer->setExpireDate($row["expireDate"]);
                $jobOffer->setCity($row["city"]);
                $jobOffer->setCareer($row["idCareer"]);
                $jobOffer->setWorkload($row["workload"]);
                $jobOffer->setRequirements($row["requirements"]);
                $jobOffer->setActive($row["active"]);
                $jobOffer->setTitle($row["title"]);
                $jobOffer->setDescription($row["description"]);
    
                array_push($jobOfferList, $jobOffer);
            }
    
            return $jobOfferList;

        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function Remove($idJobOffer)
    {
        try{
            $query = "UPDATE ".$this->tableName." SET active = FALSE WHERE idJobOffer = ".$idJobOffer;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function Edit($jobOffer)
    {
        try{
            $query = "UPDATE ".$this->tableName." SET title =\"". $jobOffer->getTitle() ."\",
            description =\"". $jobOffer->getDescription() . "\",
            workload =\"". $jobOffer->getWorkload() ."\",
            requirements =\"". $jobOffer->getRequirements() ."\",
            postDate =\"". $jobOffer->getPostDate() ."\",
            expireDate =\"". $jobOffer->getExpireDate() ."\",
            active =\"". $jobOffer->getActive() ."\",
            city =\"". $jobOffer->getCity() ."\",
            idCompany =\"". $jobOffer->getCompany() ."\",
            idjobPosition =\"". $jobOffer->getJobPosition() ."\",
            idCareer =". $jobOffer->getCareer() ." WHERE idJobOffer = ". $jobOffer->getIdJobOffer();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function SearchId($idJobOffer)
    {
        $foundJobOffer = new JobOffer;
        
        try{
            $query = "SELECT * FROM ".$this->tableName." WHERE idJobOffer = :idJobOffer";

            $parameters['idJobOffer'] = $idJobOffer;

            $this->connection = Connection::GetInstance();

            $foundJobOffer  = $this->connection->Execute($query, $parameters);

            foreach ($foundJobOffer as $row)
            {
                $jobOffer = new JobOffer();
                
                $jobOffer->setIdJobOffer($row["idJobOffer"]);
                $jobOffer->setTitle($row["title"]);
                $jobOffer->setDescription($row["description"]);
                $jobOffer->setWorkload($row["workload"]);
                $jobOffer->setRequirements($row["requirements"]);
                $jobOffer->setPostDate($row["postDate"]);
                $jobOffer->setExpireDate($row["expireDate"]);
                $jobOffer->setActive($row["active"]);
                $jobOffer->setCity($row["city"]);
                $jobOffer->setCompany($row["idCompany"]);
                $jobOffer->setJobPosition($row["idJobPosition"]);
                $jobOffer->setCareer($row["idCareer"]);
            }

            return $jobOffer ;

        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function filterList($parameters)
    {
        try {
            $jobOfferList = array();

            $query = "SELECT * FROM $this->tableName";

            $filteredList = array_filter($parameters); // removes empty values from $_POST

  
            if ($filteredList) { // not empty
                $query .= " WHERE";

                foreach ($filteredList as $key => $value) {
                    $query .= " $key  LIKE '%$value%'";  // $filteredList keyname = $filteredList['keyname'] value
                    if (count($filteredList) > 1 && (count($filteredList) > $key)) { // more than one search filter, and not the last
                        $query .= " AND";
                    }
                }
            }
            $query .= ";";

            $this->connection = Connection::GetInstance();

            $foundJobOffer  = $this->connection->Execute($query);

            foreach ($foundJobOffer as $row) {
                $jobOffer = new JobOffer();

                $jobOffer->setIdJobOffer($row["idJobOffer"]);
                $jobOffer->setTitle($row["title"]);
                $jobOffer->setDescription($row["description"]);
                $jobOffer->setWorkload($row["workload"]);
                $jobOffer->setRequirements($row["requirements"]);
                $jobOffer->setPostDate($row["postDate"]);
                $jobOffer->setExpireDate($row["expireDate"]);
                $jobOffer->setActive($row["active"]);
                $jobOffer->setCity($row["city"]);
                $jobOffer->setCompany($row["idCompany"]);
                $jobOffer->setJobPosition($row["idJobPosition"]);
                $jobOffer->setCareer($row["idCareer"]);

                array_push($jobOfferList, $jobOffer);
            }

            return $jobOfferList;

        } catch (Exception $ex) 
        {
            throw $ex;
        }
    }

}