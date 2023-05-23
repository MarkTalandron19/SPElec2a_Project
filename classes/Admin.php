<?php

class Admin {
    private $adminID;
    private $password;
    private $firstName;
    private $lastName;
    private $address;
    private $phone;

    public function __construct($adminID, $password, $firstName, $lastName, $phone, $address)
    {
        $this->adminID = $adminID;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->phone = $phone;
    }

    public function getID()
    {
        return $this->adminID;
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function getPhone()
    {
        return $this->phone;
    }

    public function setPassword(String $password)
    {
        $this->password = $password;
    }

    public function setFirstName(String $firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName(String $lastName)
    {
        $this->lastName = $lastName;
    }

    public function setPhone(String $phone)
    {
        $this->phone = $phone;
    }

}