<?php
include '../src/init.php';
// Check if the user is logged in, if not then redirect him to login page
$loggedin = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
if($_SESSION["role"]!="admin"){
  if($_SESSION["role"]=="user"){
    header("Location:user-info.php");
    }
    else{
      header("Location:index.php");
    }
    }
else{}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html" name="viewport" content="width=device-width, initial-scale=1.0"
        charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../styles/main.css">
     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="../scripts/animatedModal.js"></script>
    <script src="../scripts/user.js"></script>

    <title>FMDB</title>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="../resources/LogoNew.png" id="logo">
            <div class="user-info-h" id="hide4">
              <p class="relink" >
                <a href="admin.php" id="user-name-h"></a>
                <?php
                    if($loggedin)
                    {
                        echo "<a href=" . ($_SESSION["role"] == "user" ? "\"user-info.php\"" : "\"admin.php\"") . "id=\"user-name-h\"> " . $_SESSION["username"]." </a>";
                    }

                ?>
              </p>
                <img src="../resources/user-default.png" id="user-pfp-h">
            </div>
        </div>
        <nav class="left">
            <ul class="navigation" id="nav">
                <li><a href="index.php">Home Page</a></li>
                <li><a href="movies.php">Movies</a></li>
                    <li><a  id="hide1" href="#animatedModal">Login/Register</a></li>
                <li><a href="../src/logout.php" id="hide3">Logout</a></li>
                </li>
            </ul>
        </nav>
        <?php if(!$loggedin){
    echo "<script>document.getElementById('hide3').style.display='none';</script>";
      echo "<script>document.getElementById('hide4').style.display='none';</script>";
  }
    else{
        echo "<script>document.getElementById('hide1').style.display='none';</script>";
    }
        ?>
        <div class="main">
                <h2>Admin Panel</h2>
                <p>Welcome to the admin panel, you are the only person that can access this page, this is the tool used to add movies to the film database</p>
                <form class="uploader" action="../src/upload.php" method="POST" enctype="multipart/form-data">
                    <span>Movie Name:</span><br>
                    <input type="text" name="moviename"><br>
                    <span>Release year:</span><br>
                    <input type="number" name="releaseyear"><br>
                    <span>Movie genre:</span> <br>
                    <input type="text" name="moviegenre"><br>
                    <span>Movie description:</span> <br>
                    <textarea rows="4" cols="50" name="moviedescription"></textarea><br>
                    <input type="file" class="movieuploadselect" size="60" name="file">
                    <button class="movieupload" type="submit" name="submit">UPLOAD</button>
                    </form>
            </div>
            </div>
</body>

</html>
