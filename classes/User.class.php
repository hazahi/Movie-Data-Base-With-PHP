<?php
class User{

private $userName;
private $password;
private $firstName;
private $lastName;
private $uid;
private $role;

public function __construct($uname,$fname,$lname,$pass,$roleAC){
$this->userName=$uname;
$this->password=$pass;
$this->firstName=$fname;
$this->lastName=$lname;
$this->role=$roleAC;
}

public function SetId($id){
  $this->uid=$id;
}
public function GetId(){
  return $this->uid;
}

public function GetUname(){
  return $this->userName;
}

public function GetFname(){
  return $this->firstName;
}
public function GetLname(){
  return $this->lastName;
}
public function GetPass(){
  return $this->password;
}
public function GetRole(){
  return $this->role;
}
}
 ?>
