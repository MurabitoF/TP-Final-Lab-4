<?php

namespace DAO;

use \Exception as Exception;
use DAO\IUserDAO as IUserDAO;
use Models\User as User;
use DAO\Connection as Connection;

class UserDAO implements IUserDAO
{
    private $connection;
    private $tableName = "User";

    public function Add(User $user)
    {
        try {
            $query = "CALL save_User (:userName, :password, :role);";

            $parameters["userName"] = $user->getUsername();
            $parameters["password"] = $user->getPassword();
            $parameters["role"] = $user->getRole();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $userList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $user = new User();
                $user->setIdUser($row['idUser']);
                $user->setUsername($row['userName']);
                $user->setPassword($row['role']);
                $user->setUsername($row['active']);

                array_push($userList, $user);
            }

            return $userList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetByUserName($username)
    {
        try {
            $user = NULL;

            $query = 'SELECT * FROM ' . $this->tableName . ' WHERE userName = :username;';
            $parameters['username'] = $username;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters);
            if ($result) {
                $user = new User;
                $user->setIdUser($result[0]['idUser']);
                $user->setUsername($result[0]['userName']);
                $user->setPassword($result[0]['password']);
                $user->setRole($result[0]['role']);
                if ($result[0]['active'] == 1) {
                    $user->setActive(true);
                } else {
                    $user->setActive(false);
                }
            }

            return $user;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getEmail($userList)
    {
        try {
            $emailList = '';

            foreach ($userList as $key => $user) {

                $query = 'SELECT userName FROM ' . $this->tableName . ' WHERE idUser = :idUser;';
                $parameters['idUser'] = $user->getIdUser();

                $this->connection = Connection::GetInstance();

                $email = $this->connection->Execute($query, $parameters);

                if ($key != array_key_last($userList)) {
                    $emailList .= $email[0]["userName"] . ', ';
                } else {
                    $emailList .= $email[0]["userName"];
                }
            }
            return $emailList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
