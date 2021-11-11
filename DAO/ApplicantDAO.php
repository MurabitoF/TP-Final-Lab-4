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
            $query = "CALL save_Applicant (:date, :cv, :description, :idJobOffer, :idStudent);";

            $parameters['date'] = $applicant->getDate();
            $parameters['cv'] = $applicant->getCv();
            $parameters['description'] = $applicant->getDescription();
            $parameters['idJobOffer'] = $applicant->getIdJobOffer();
            $parameters['idStudent'] = $applicant->getIdStudent();

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
                $applicant->setIdStudent($row['idStudent']);
                $applicant->setIdJobOffer($row['idJobOffer']);
                $applicant->setDescription($row['description']);
                $applicant->setDate($row['date']);
                $applicant->setCv($row['cv']);
                $applicant->setActive($row['active']); ///active seteado

               $applicantList[$row['idStudent']] = $applicant;
            }
            return $applicantList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetJobOffersFromApplicant($idStudent) ///DEVUELVE UNA LISTA DE idJobOffer en las que se postulo el alumno
    {
        try {
            $jobOfferList = array();
            
            $query = "SELECT * FROM " . $this->tableName . " WHERE idStudent = :idStudent";

            $parameter["idStudent"] = $idStudent;

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

    public function GetLastJobOffersFromApplicant($idStudent)
    {
        try {
            $jobOfferList = array();
            
            $query = "SELECT * FROM " . $this->tableName . " WHERE idStudent = :idStudent ORDER BY date DESC LIMIT 3";

            $parameter["idStudent"] = $idStudent;

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

    public function Remove($idStudent, $idUser_Has_JobOffer) ///REMOVE AHORA SETEA EL ACTIVE 
    {
        try{
            $query = "UPDATE " . $this->tableName . " SET active = FALSE WHERE idStudent =" . $idStudent." AND idUser_Has_JobOffer =" .$idUser_Has_JobOffer;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex){
            throw $ex;
        }
    }   
}
