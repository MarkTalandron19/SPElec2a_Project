<?php

class Transfer
{
    private $transferID;
    private $bookID;
    private $fromBranchID;
    private $toBranchID;
    private $transferDate;

    public function __construct(
        $transferID,
        $bookID,
        $fromBranchID,
        $toBranchID,
        $transferDate
    ) {
        $this->transferID = $transferID;
        $this->bookID = $bookID;
        $this->transferDate = $transferDate;
        $this->fromBranchID = $fromBranchID;
        $this->toBranchID = $toBranchID;
        $this->transferDate = $transferDate;
    }

    public function getID()
    {
        return $this->transferID;
    }

    public function getBookID()
    {
        return $this->bookID;
    }

    public function getFromBranchID()
    {
        return $this->fromBranchID;
    }

    public function getToBranchID()
    {
        return $this->toBranchID;
    }

    public function getTransferDate()
    {
        return $this->transferDate;
    }

    public function setBookID(int $bookID)
    {
        $this->bookID = $bookID;
    }

    public function setFromBranchID(int $fromBranchID)
    {
        $this->fromBranchID = $fromBranchID;
    }

    public function setToBranchID(int $toBranchID)
    {
        $this->toBranchID = $toBranchID;
    }

    public function setTransferDate(String $transferDate)
    {
        $this->transferDate = $transferDate;
    }

}
