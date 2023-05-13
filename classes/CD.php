<?php

class CD{
    private $cdID;
    private $title;
    private $artist;
    private $releaseYear;
    private $genre;
    private $branchID;

    public function __construct(
        $cdID,
        $title,
        $artist,
        $releaseYear,
        $genre,
        $branchID
    )
    {
        $this->cdID = $cdID;
        $this->title = $title;
        $this->artist = $artist;
        $this->releaseYear = $releaseYear;
        $this->genre = $genre;
        $this->branchID = $branchID;
    }

    public function getID()
    {
        return $this->cdID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getBranchID()
    {
        return $this->branchID;
    }

    public function setTitle(String $title)
    {
        $this->title = $title;
    }

    public function setArtist(String $artist)
    {
        $this->artist = $artist;
    }

    public function setReleaseYear(String $releaseYear)
    {
        $this->releaseYear = $releaseYear;
    }

    public function setGenre(String $genre)
    {
        $this->genre = $genre;
    }

    public function setBranchID(int $branchID)
    {
        $this->branchID = $branchID;
    }
}