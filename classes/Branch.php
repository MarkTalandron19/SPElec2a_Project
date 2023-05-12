<?php

class Branch
{
    private $branchID;
    private $branchName;
    private $address;
    private $phone;

    public function __construct(
        $branchID,
        $branchName,
        $address,
        $phone
    )
    {
        $this->branchID = $branchID;
        $this->branchName = $branchName;
        $this->address = $address;
        $this->phone = $phone;
    }

    public function getID()
    {
        return $this->branchID;
    }

    public function getBranchName()
    {
        return $this->branchName;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setBranchName(String $branchName)
    {
        $this->branchName = $branchName;
    }

    public function setAdress(String $address)
    {
        $this->address = $address;
    }

    public function setPhone(String $phone)
    {
        $this->phone = $phone;
    }
}