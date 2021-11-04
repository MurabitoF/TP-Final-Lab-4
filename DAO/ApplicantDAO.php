<?php

namespace DAO;

use \Exception as Exeption;
use DAO\Connection as Connection;
use DAO\IApplicantDAO as IApplicantDAO;
use Models\Applicant as Applicant;

class ApplicantDAO implements IApplicantDAO
{
    private $connection;
    private $tableName = "User_Has_JobOffer";

    public function Add(Applicant $applicant)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . "(date, cv, description, idJobOffer, idUser) VALUES (:date, :cv, :description, :idJobOffer, :idUser);";

            $parameters['date'] = $applicant->getDate();
            $parameters['cv'] = $applicant->getCv();
            $parameters['description'] = $applicant->getDescription();
            $parameters['idJobOffer'] = $applicant->getIdJobOffer();
            $parameters['idUser'] = $applicant->getIdUser();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exeption $ex) {
            throw $ex;
        }
    }

    public function GetApplicantsFromJobOffer($idJobOffer)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . "WHERE idJobOffer = :idJobOffer;";

            $parameter["idJobOffer"] = $idJobOffer;

            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query, $parameter);
        } catch (Exeption $ex) {
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

        } catch (Exeption $ex) {
            throw $ex;
        }
    }
}
