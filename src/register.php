<?php

include '../src/init.php';

$username=trim($_POST{'usernameR'});
$password=trim($_POST{'passwordR'});
$password_c=trim($_POST{'conf_password'});
$firstname=trim($_POST{'firstnameR'});
$lastname=trim($_POST{'lastnameR'});

if($_SERVER["REQUEST_METHOD"] == "POST"){


  $control = new Control();
  $checker=$control->AttemptRegistration($username,$password,$password_c,$firstname,$lastname);
  echo $checker;
}


?>
