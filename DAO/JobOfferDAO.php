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
        try {
            $query = "CALL save_JobOffer (:title, :description, :workload, :requirements, :postDate, :expireDate, :city, :idCompany, :idJobPosition, :idCareer, :status, :imgFlyer);";

            $parameters["title"] = $jobOffer->getTitle();
            $parameters["description"] = $jobOffer->getDescription();
            $parameters["workload"] = $jobOffer->getWorkload();
            $parameters["requirements"] = $jobOffer->getRequirements();
            $parameters["postDate"] = $jobOffer->getPostDate();
            $parameters["expireDate"] = $jobOffer->getExpireDate();
            $parameters["city"] = $jobOffer->getCity();
            $parameters["idCompany"] = $jobOffer->getCompany();
            $parameters["idJobPosition"] = intval($jobOffer->getJobPosition());
            $parameters["idCareer"] = intval($jobOffer->getCareer());
            $parameters["status"] = $jobOffer->getStatus();
            $parameters["imgFlyer"] = $jobOffer->getImgFlyer();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $jobOfferList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
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
                if (isset($row['imgFlyer'])) {
                    $jobOffer->setImgFlyer($row['imgFlyer']);
                }

                array_push($jobOfferList, $jobOffer);
            }

            return $jobOfferList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function CloseJobOffer($idJobOffer)
    {
        try {
            $query = "CALL JobOffer_Close(:idJobOffer)";

            $parameters["idJobOffer"] = $idJobOffer;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Remove($idJobOffer)
    {
        try {
            $query = "UPDATE " . $this->tableName . " SET active = FALSE WHERE idJobOffer = " . $idJobOffer;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Edit($jobOffer)
    {
        try {
            $query = "CALL update_JobOffer (:idJobOffer, :title, :description, :workload, :requirements, :postDate, :expireDate, :city, :idCompany, :idJobPosition, :idCareer, :status, :imgFlyer);";

            $parameters["idJobOffer"] = $jobOffer->getIdJobOffer();
            $parameters["title"] = $jobOffer->getTitle();
            $parameters["description"] = $jobOffer->getDescription();
            $parameters["workload"] = $jobOffer->getWorkload();
            $parameters["requirements"] = $jobOffer->getRequirements();
            $parameters["postDate"] = $jobOffer->getPostDate();
            $parameters["expireDate"] = $jobOffer->getExpireDate();
            $parameters["city"] = $jobOffer->getCity();
            $parameters["idCompany"] = $jobOffer->getCompany();
            $parameters["idJobPosition"] = intval($jobOffer->getJobPosition());
            $parameters["idCareer"] = intval($jobOffer->getCareer());
            $parameters["status"] = $jobOffer->getStatus();
            $parameters["imgFlyer"] = $jobOffer->getImgFlyer();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function SearchId($idJobOffer)
    {
        $foundJobOffer = new JobOffer;

        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE idJobOffer = :idJobOffer";

            $parameters['idJobOffer'] = $idJobOffer;

            $this->connection = Connection::GetInstance();

            $foundJobOffer  = $this->connection->Execute($query, $parameters);

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
                $jobOffer->setCompany($row["idCompany"]);
                $jobOffer->setStatus($row["status"]);
                if (isset($row['imgFlyer'])) {
                    $jobOffer->setImgFlyer($row['imgFlyer']);
                }
            }

            return $jobOffer;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function filterList($parameters)
    {
        try {
            $jobOfferList = array();

            $query = "SELECT * FROM $this->tableName WHERE active = 1";

            $filteredList = array_filter($parameters);


            if ($filteredList) { 
                $query .= " AND";

                foreach ($filteredList as $key => $value) {
                    $query .= " $key  LIKE '%$value%'"; 
                    if (count($filteredList) > 1 && (array_key_last($filteredList) != $key)) { ///MODIFICARLO EN EMPRESA
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
                $jobOffer->setStatus($row["status"]);
                if (isset($row['imgFlyer'])) {
                    $jobOffer->setImgFlyer($row['imgFlyer']);
                }

                array_push($jobOfferList, $jobOffer);
            }

            return $jobOfferList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
