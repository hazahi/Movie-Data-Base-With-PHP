<?php
include '../src/init.php';

$firstname=trim($_POST{'firstnameE'});
$lastname=trim($_POST{'lastnameE'});
$password=trim($_POST{'passwordE'});
$id =  $_SESSION["id"];


    if($_SERVER["REQUEST_METHOD"] == "POST"){

      $control = new Control();
      $checker=$control->AttemptUpdate($id,$firstname,$lastname,$password);
      echo $checker;

    }


?>
