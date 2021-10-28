<?php

namespace DAO;

use Models\Address as Address;

interface IAddressDAO{
    function GetAll();
    function Add(Address $address, $idCompany);
}