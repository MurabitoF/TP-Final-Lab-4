<?php

namespace DAO;

use \Exception as Exception;
use DAO\IUserDAO as IUserDAO;
use Models\User as User;
use DAO\Connection as Connection;

class userDAO implements IUserDAO
{
    private $connection;
    private $tableName = "User";

    public function Add(User $user)
    {
        try
            {
                $query = "INSERT INTO ".$this->tableName." (userName, password, role, active) VALUES (:userName, :password, :role, :active);";
                
                $parameters["userName"] = $user->getUsername();
                $parameters["password"] = $user->getPassword();
                $parameters["role"] = $user->getRole();
                $parameters["active"] = $user->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function GetAll()
    {
        try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    $user->setIdUser($row['idUser']);
                    $user->setUsername($row['userName']);
                    $user->setPassword($row['role']);
                    $user->setUsername($row['active']);

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function GetByUserName($username)
    {
        try
            {
                $user = NULL;

                $query = 'SELECT * FROM ' .$this->tableName .' WHERE userName = :username;';
                $parameters['username'] = $username;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters);
                if($result){
                    $user = new User;
                    $user->setIdUser($result[0]['idUser']);
                    $user->setUsername($result[0]['userName']);
                    $user->setPassword($result[0]['password']);
                    $user->setRole($result[0]['role']);
                    if($result[0]['active'] == 1){
                        $user->setActive(true);  
                    } else {
                        $user->setActive(false);  
                    }
                }

                return $user;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

}