<?php

class Patron {
    private $patronID;
    private $password;
    private $firstName;
    private $lastName;
    private $address;
    private $phone;
    private $hasFines;

    public function __construct($patronID, $password, $firstName, $lastName, $phone, $address, $hasFines)
    {
        $this->patronID = $patronID;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->phone = $phone;
        $this->hasFines = $hasFines;
    }

    public function getID()
    {
        return $this->patronID;
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
    
    public function getHasFines()
    {
        return $this->hasFines;
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

    public function setHasFines(bool $hasFines)
    {
        $this->hasFines = $hasFines;
    }
    
}