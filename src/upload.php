<?php
include 'init.php';

if(isset($_POST['submit'])){
    $file=$_FILES['file'];

    $fileName=$_FILES['file']['name'];
    $fileTmpName=$_FILES['file']['tmp_name'];
    $fileSize=$_FILES['file']['size'];
    $fileError=$_FILES['file']['error'];
    $fileType=$_FILES['file']['type'];
    $fileDestTrue='uploads';
    $movieName=$_POST['moviename'];
    $releaseYear=$_POST['releaseyear'];
    $movieGenre=$_POST['moviegenre'];
    $movieDescript=$_POST['moviedescription'];

    $fileExt=explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');

    if(in_array($fileActualExt,$allowed)){
            if($fileError===0){

                if($fileSize< 5000000){

                    $fileNameNew=uniqid('',true).".".$fileActualExt;

                    $fileDestination='../uploads/'.$fileNameNew;
                    $fileDestTrue=$fileDestination;
                    move_uploaded_file($fileTmpName,$fileDestination);
                    $control = new Control();
                    $control->RegisterMovie($movieName,$releaseYear, $movieDescript, $movieGenre, $fileDestTrue);
                    unset($control);

                    header("Location: ../views/admin.php?uploadsuccess");


                }
                else{
                   echo "File is too big";
                }
            }
            else{
               echo "An error occured and image could not be uploaded";
            }
    }
    else{
        echo "File is with an unsupported extension";
    }



}
