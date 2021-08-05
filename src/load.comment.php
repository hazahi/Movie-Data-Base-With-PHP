<?php
include '../src/init.php';
  $limitation=$_POST['limitation'];
  $movieID=$_SESSION["movieID"];
  if($_SERVER["REQUEST_METHOD"] == "POST"){


    $control = new Control();
    $control->DisplayComments($limitation,$_SESSION["movieID"]);


    unset($control);
}





?>
