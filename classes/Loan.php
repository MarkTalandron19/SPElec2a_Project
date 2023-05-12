<?php

class Loan
{
    private $loanID;
    private $bookID;
    private $branchID;
    private $patronID;
    private $loanDate;
    private $dueDate;
    private $returnDate;

    public function __construct(
        $loanID,
        $bookID,
        $branchID,
        $patronID,
        $loanDate,
        $dueDate,
        $returnDate
    ) {
        $this->loanID = $loanID;
        $this->bookID = $bookID;
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


    public function setLoanDate(String $loanDate)
    {
        $this->loanDate = $loanDate;
    }

    public function setReturnDate(String $returnDate)
    {
        $this->returnDate = $returnDate;
    }
}
