<?php

class Movie{
  private $moviename;
  private $mID;
  private $relY;
  private $mdesc;
  private $genre;
  private $cover;

public function __construct($name,$iD,$year,$descr,$genre,$cover){
  $this->moviename=$name;
  $this->mID=$iD;
  $this->relY=$year;
  $this->mdesc=$descr;
  $this->genre=$genre;
  $this->cover=$cover;
}
public function getNameOfMovie(){
  return $this->moviename;
}
public function getReleaseYear(){
  return $this->relY;
}
public function getDescription(){
  return $this->mdesc;
}
public function getGenre(){
  return $this->genre;
}
public function getCover(){
  return $this->cover;
}
public function getMovieID(){
  return $this->mID;
}

}
 ?>
