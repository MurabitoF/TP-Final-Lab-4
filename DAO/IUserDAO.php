<?php
namespace DAO;

use Models\User as User;

interface IUserDAO
{
    function Add(User $user);
    function GetByUserName($username);
    function GetAll();
}
?>