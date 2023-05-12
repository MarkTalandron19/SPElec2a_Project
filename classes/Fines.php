<?php

class Fines
{
    private $fineID;
    private $loanID;
    private $fineAmount;
    private $fineDate;
    private $paid;
    public function __construct(
        $fineID,
         $loanID,
         $fineAmount,
         $fineDate,
         $paid
    ) {
        $this->fineID = $fineID;
        $this->loanID = $loanID;
        $this->fineAmount = $fineAmount;
        $this->fineDate = $fineDate;
        $this->paid = $paid;
    }

    public function getID()
    {
        return $this->fineID;
    }

    public function getLoanID()
    {
        return $this->loanID;
    }

    public function getFineAmount()
    {
        return $this->fineAmount;
    }

    public function getFineDate()
    {
        return $this->fineDate;
    }

    public function getPaid()
    {
        return $this->paid;
    }

    public function setLoanID(int $loanID)
    {
        $this->loanID = $loanID;
    }

    public function setFineAmount(float $fineAmount)
    {
        $this->fineAmount = $fineAmount;
    }

    public function setFineDate(int $fineDate)
    {
        $this->fineDate = $fineDate;
    }


    public function setPaid(bool $paid)
    {
        $this->paid = $paid;
    }

}
