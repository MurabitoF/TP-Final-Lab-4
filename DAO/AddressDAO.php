<?php

namespace DAO;

use Models\Address as Address;
use DAO\IAddressDAO as IAddressDAO;
use DAO\Connection as Connection;
use \Exception as Exception;

class AddressDAO implements IAddressDAO{

    private $connection;
    private $tableName = "Address";


    public function GetAll()
    {
        try{

            $addressList = array();
    
            $query = "SELECT * FROM ". $this->tableName;
    
            $this->connection = Connection::GetInstance();
    
            $resultSet = $this->connection->Execute($query);
    
            foreach($resultSet as $row){
    
                $address = new Address();
                
                $address->setIdAddress($row["idAddress"]);
                $address->setStreetName($row["streetName"]);
                $address->setStreetAddress($row["streetAddress"]);
                $address->setCity($row["city"]);
                $address->setLatitude($row["latitude"]);
                $address->setLongitude($row["longitude"]);
                $address->setActive($row["active"]);
                $address->setIdCompany($row["idCompany"]);
                
    
                array_push($addressList, $address);
    
            }
    
            return $addressList;
    
           } catch (Exception $ex)
           {
               throw $ex;
           }
    }

    public function Edit($address)
    {
        $latLng = $this->getLatLng($address->getStreetName(), $address->getStreetAddress(), $address->getCity());
        try{

            $query = "UPDATE ".$this->tableName." SET city =\"". $address->getCity() ."\",
            streetName =\"". $address->getStreetName() ."\",
            streetAddress =\"". $address->getStreetAddress() ."\",
            latitude =\"". $latLng[0]['lat'] ."\",
            longitude =\"". $latLng[0]['lon'] ."\" WHERE idAddress = ". $address->getIdAddress();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex){
            throw $ex;
        }
    }

    

    public function Add(Address $address, $idCompany)
    {

        $latLng = $this->getLatLng($address->getStreetName(), $address->getStreetAddress(), $address->getCity());

        try{

            $query = "INSERT INTO " .$this->tableName." (streetName, streetAddress, city, active, latitude, longitude, idCompany) VALUES (:streetName, :streetAddress, :city, :active, :latitude, :longitude, :idCompany);";

            $parameters["streetName"] = $address->getStreetName();
            $parameters["streetAddress"] = $address->getStreetAddress();
            $parameters["city"] = $address->getCity();
            $parameters["latitude"] = $latLng[0]['lat'];
            $parameters["longitude"] = $latLng[0]['lon'];
            $parameters["active"] = true;
            $parameters["idCompany"] = $idCompany;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
            
        } catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Remove($idCompany)
    {
       
        try{

            $query = "UPDATE ".$this->tableName." SET active = FALSE WHERE idAddress = ".$idCompany;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex)
        {
            throw $ex;
        }

    }

    public function getAddresses($idCompany)
    {
        $foundAddress = new Address;

        try{
            $query = "SELECT * FROM " .$this->tableName. " WHERE `idCompany` = ". $idCompany;

            $this->connection = Connection::GetInstance();

            $foundAddress  = $this->connection->Execute($query);
            
            foreach ($foundAddress as $row)
            {
                $address = new Address();
                
                $address->setIdAddress($row["idAddress"]);
                $address->setStreetName($row["streetName"]);
                $address->setStreetAddress($row["streetAddress"]);
                $address->setCity($row["city"]);
                $address->setLatitude($row["latitude"]);
                $address->setLongitude($row["longitude"]);
                $address->setActive($row["active"]);
                $address->setIdCompany($row["idCompany"]);

            }

            return $address;

        } catch(Exception $ex)
        {
            throw $ex;
        }
    }

    private function getLatLng($streetName, $streetAddress, $cityName)
    {
        
        $ch = curl_init();
        $url = "https://nominatim.openstreetmap.org/search?format=json&street=$streetAddress $streetName&city=$cityName";
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Test-app");
        
        $response = curl_exec($ch);
        
        $decode = json_decode($response, true);
        
        return $decode;

    }

}