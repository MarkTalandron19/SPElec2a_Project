<?php

class Video{
    private $videoID;
    private $title;
    private $director;
    private $releaseYear;
    private $format;
    private $branchID;

    public function __construct(
        $videoID,
        $title,
        $director,
        $releaseYear,
        $format,
        $branchID
    )
    {
        $this->videoID = $videoID;
        $this->title = $title;
        $this->director = $director;
        $this->releaseYear = $releaseYear;
        $this->format = $format;
        $this->branchID = $branchID;
    }

    public function getID()
    {
        return $this->videoID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function getBranchID()
    {
        return $this->branchID;
    }

    public function setTitle(String $title)
    {
        $this->title = $title;
    }

    public function setDirector(String $director)
    {
        $this->director = $director;
    }

    public function setReleaseYear(String $releaseYear)
    {
        $this->releaseYear = $releaseYear;
    }

    public function setFormat(String $format)
    {
        $this->format = $format;
    }

    public function setBranchID(int $branchID)
    {
        $this->branchID = $branchID;
    }
}