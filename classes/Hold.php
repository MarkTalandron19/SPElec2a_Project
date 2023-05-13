<?php

class Hold
{
    private $holdID;
    private $bookID;
    private $branchID;
    private $patronID;
    private $holdDate;

    public function __construct(
        $holdID,
        $bookID,
        $branchID,
        $patronID,
        $holdDate
    ) {
        $this->holdID = $holdID;
        $this->bookID = $bookID;
        $this->branchID = $branchID;
        $this->patronID = $patronID;
        $this->holdDate = $holdDate;
    }

    public function getID()
    {
        return $this->holdID;
    }

    public function getBookID()
    {
        return $this->bookID;
    }

    public function getBranchID()
    {
        return $this->branchID;
    }

    public function getPatronID()
    {
        return $this->patronID;
    }

    public function getHoldDate()
    {
        return $this->holdDate;
    }

    public function setBookID(int $bookID)
    {
        $this->bookID = $bookID;
    }

    public function setBranchID(int $branchID)
    {
        $this->branchID = $branchID;
    }

    public function setPatronID(int $patronID)
    {
        $this->patronID = $patronID;
    }

    public function setHoldDate(String $holdDate)
    {
        $this->holdDate = $holdDate;
    }
}

