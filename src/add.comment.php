<?php
include '../src/init.php';
$userID;
if(isset($_SESSION["id"])){
  $userID=$_SESSION["id"];
  $text=trim($_POST{'textC'});
  $movieID=$_SESSION["movieID"];
  if($_SERVER["REQUEST_METHOD"] == "POST"){


    $control = new Control();
    $checker=$control->AddComment($userID,$text,$movieID);
    echo $checker;
}
}
else{
  $message="Comment not submited, you must be logged in to submit comments";
  echo $message;
}




?>
