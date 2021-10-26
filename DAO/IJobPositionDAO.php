<?php
namespace DAO;

interface IJobPositionDAO{
    public function GetJobPositionById($id);
    public function GetAll();
}
?>