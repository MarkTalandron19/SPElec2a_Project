<?php

class CDLoan
{
    private $loanID;
    private $cdID;
    private $branchID;
    private $patronID;
    private $loanDate;
    private $dueDate;
    private $returnDate;

    public function __construct(
        $loanID,
        $cdID,
        $branchID,
        $patronID,
        $loanDate,
        $dueDate,
        $returnDate
    ) {
        $this->loanID = $loanID;
        $this->cdID = $cdID;
        $this->branchID = $branchID;
        $this->patronID = $patronID;
        $this->loanDate = $loanDate;
        $this->dueDate = $dueDate;
        $this->returnDate = $returnDate;
    }

    public function getID()
    {
        return $this->loanID;
    }

    public function getCDID()
    {
        return $this->cdID;
    }

    public function getBranchID()
    {
        return $this->branchID;
    }

    public function getPatronID()
    {
        return $this->patronID;
    }

    public function getLoanDate()
    {
        return $this->loanDate;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function getReturnDate()
    {
        return $this->returnDate;
    }

    public function setCDID(int $cdID)
    {
        $this->cdID = $cdID;
    }

    public function setBranchID(int $branchID)
    {
        $this->branchID = $branchID;
    }

    public function setPatronID(int $patronID)
    {
        $this->patronID = $patronID;
    }


    public function setLoanDate(String $loanDate)
    {
        $this->loanDate = $loanDate;
    }

    public function setReturnDate(String $returnDate)
    {
        $this->returnDate = $returnDate;
    }
}
