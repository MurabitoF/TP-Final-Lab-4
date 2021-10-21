<?php

namespace DAO;

use DAO\IUserDAO as IUserDAO;
use Models\User as User;

class userDAO implements IUserDAO
{
    private $userList = array();

    public function Add(User $user)
    {
        $this->RetrieveData();

        array_push($this->userList, $user);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->userList;
    }

    public function GetByUserName($username)
    {
        $this->RetrieveData();

        foreach ($this->userList as $arrayValue) {
            if ($arrayValue->getUsername() == $username) {
                return $arrayValue;
            }
        }

        return NULL;
    }

    private function SaveData()
    {
        
    }

    private function RetrieveData()
    {

    }
}