<?php

class Book
{
    private $bookID;
    private $title;
    private $author;
    private $pubYear;
    private $publisher;
    private $isbn;
    private $copiesAvailable;
    private $available;
    private $branchID;

    public function __construct(
        $bookID,
        $title,
        $author,
        $pubYear,
        $publisher,
        $isbn,
        $copiesAvailable,
        $available,
        $branchID
    ) {
        $this->bookID = $bookID;
        $this->title = $title;
        $this->author = $author;
        $this->pubYear = $pubYear;
        $this->publisher = $publisher;
        $this->isbn = $isbn;
        $this->copiesAvailable = $copiesAvailable;
        $this->available = $available;
        $this->branchID = $branchID;
    }

    public function getID()
    {
        return $this->bookID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getPubYear()
    {
        return $this->pubYear;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }

    public function getISBN()
    {
        return $this->isbn;
    }

    public function getCopiesAvailable()
    {
        return $this->copiesAvailable;
    }

    public function getAvaiable()
    {
        return $this->available;
    }

    public function getBranchID()
    {
        return $this->branchID;
    }

    public function setTitle(String $title)
    {
        $this->title = $title;
    }

    public function setAuthor(String $author)
    {
        $this->author = $author;
    }

    public function setPubYear(String $pubYear)
    {
        $this->pubYear = $pubYear;
    }

    public function setPublisher(String $publisher)
    {
        $this->publisher = $publisher;
    }

    public function setISBN(String $isbn)
    {
        $this->isbn = $isbn;
    }

    public function setCopies(int $copies)
    {
        $copiesAvailable = $copies;
    }

    public function setAvailable(bool $available)
    {
        $this->available = $available;
    }

    public function setBranchID(int $branchID)
    {
        $this->branchID = $branchID;
    }

}
