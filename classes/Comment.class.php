<?php
class Comment{
private $movieID;
private $userID;
private $timeSt;
private $text;
private $id;

public function __construct($mID,$uID,$tST,$txt,$id){
  $this->movieID=$mID;
  $this->userID=$uID;
  $this->timeSt=$tST;
  $this->text=$txt;
  $this->id=$id;
}

public function GetCommentMID(){
  return $this->movieID;
}
public function GetCommentUID(){
  return $this->userID;
}
public function GetCommentTimeSt(){
  return $this->timeSt;
}
public function GetCommentText(){
  return $this->text;
}
public function GetCommentID(){
  return $this->id;
}
}
?>
