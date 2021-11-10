<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\IApplicantDAO as IApplicantDAO;
use Models\Applicant as Applicant;
use Models\JobOffer as JobOffer;

class ApplicantDAO implements IApplicantDAO
{
    private $connection;
    private $tableName = "User_Has_JobOffer";

    public function Add(Applicant $applicant)
    {
        try {
            $query = "CALL save_Applicant (:date, :cv, :description, :idJobOffer, :idUser);";

            $parameters['date'] = $applicant->getDate();
            $parameters['cv'] = $applicant->getCv();
            $parameters['description'] = $applicant->getDescription();
            $parameters['idJobOffer'] = $applicant->getIdJobOffer();
            $parameters['idUser'] = $applicant->getIdUser();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetApplicantsFromJobOffer($idJobOffer) ///DEVUELVE LA LISTA DE POSTULANTES DE LA jobOffer
    {
        try {
            $applicantList = array();
            
            $query = "SELECT * FROM " . $this->tableName . " WHERE idJobOffer = :idJobOffer";

            $parameter["idJobOffer"] = $idJobOffer;

            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query, $parameter);

            foreach($result as $row){
                $applicant = new Applicant();
                $applicant->setIdApplicant($row['idUser_Has_JobOffer']);
                $applicant->setIdUser($row['idUser']);
                $applicant->setIdJobOffer($row['idJobOffer']);
                $applicant->setDescription($row['description']);
                $applicant->setDate($row['date']);
                $applicant->setCv($row['cv']);
                $applicant->setActive($row['active']); ///active seteado

               $applicantList[$row['idUser']] = $applicant;
            }
            return $applicantList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetJobOffersFromApplicant($idUser) ///DEVUELVE UNA LISTA DE idJobOffer en las que se postulo el alumno
    {
        try {
            $jobOfferList = array();
            
            $query = "SELECT * FROM " . $this->tableName . " WHERE idUser = :idUser";

            $parameter["idUser"] = $idUser;

            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query, $parameter);

            foreach($result as $row){
                array_push($jobOfferList, $row['idJobOffer']);
            }

            return $jobOfferList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetLastJobOffersFromApplicant($idUser)
    {
        try {
            $jobOfferList = array();
            
            $query = "SELECT * FROM " . $this->tableName . " WHERE idUser = :idUser ORDER BY date DESC LIMIT 3";

            $parameter["idUser"] = $idUser;

            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query, $parameter);

            foreach($result as $row){
                array_push($jobOfferList, $row['idJobOffer']);
            }

            return $jobOfferList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function CheckIfApplicant($idUser)
    {
        try{
            $query = "SELECT * FROM " . $this->tableName . "WHERE idUser = :idUser;";
            $parameter["idUser"] = $idUser;

            $this->connection = Connection::GetInstance();
            $returnedRows = $this->connection->ExecuteNonQuery($query, $parameter);
            
            if($returnedRows == 0){
                return true;
            } else {
                return false;
            }

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Remove($idUser, $idUser_Has_JobOffer) ///REMOVE AHORA SETEA EL ACTIVE 
    {
        try{
            $query = "UPDATE " . $this->tableName . " SET active = FALSE WHERE idUser =" . $idUser." AND idUser_Has_JobOffer =" .$idUser_Has_JobOffer;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex){
            throw $ex;
        }
    }
}
