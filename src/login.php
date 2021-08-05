<?php
include '../src/init.php';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
   echo $_SESSION["username"];
    exit;
}
$username=trim($_POST{'username'});
$password=trim($_POST{'password'});
$role = "";
if(!empty($username) && !empty($password))
{

    if($_SERVER["REQUEST_METHOD"] == "POST"){


      $control = new Control();
      $checker=$control->AttemptLogIn($username,$password);
      if(is_object($checker)){


      $_SESSION["loggedin"] = true;
      $idu=$checker->GetId();
      $_SESSION["id"] = $idu;
      $_SESSION["username"] = $username;
      $role=$checker->GetRole();
      $_SESSION["role"] = $role;
      echo  "success";
      }
      if(is_string($checker)){
        echo $checker;
      }
    }
  }
?>
