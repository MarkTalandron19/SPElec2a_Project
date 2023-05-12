<?php

class Periodical
{
    private $periodicalID;
    private $title;
    private $publisher;
    private $pubYear;
    private $isbn;

    public function __construct(
        $periodicalID,
        $title,
        $publisher,
        $pubYear,
        $isbn
    ) {
        $this->periodicalID = $periodicalID;
        $this->title = $title;
        $this->publisher = $publisher;
        $this->pubYear = $pubYear;
        $this->isbn = $isbn;
    }

    public function getID()
    {
        return $this->periodicalID;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }

    public function getPubYear()
    {
        return $this->pubYear;
    }

    public function getISBN()
    {
        return $this->isbn;
    }

    public function setTitle(String $title)
    {
        $this->title = $title;
    }

    public function setPublisher(String $publisher)
    {
        $this->publisher = $publisher;
    }

    public function setPubYear(String $pubYear)
    {
        $this->pubYear = $pubYear;
    }

    public function setISBN(String $isbn)
    {
        $this->isbn = $isbn;
    }

}
