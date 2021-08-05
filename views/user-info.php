<?php
include '../src/init.php';
$loggedin = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
if($_SESSION['role']!='user'){
  header("Location:index.php");
}
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
    <script src="../scripts/edit_user.js"></script>

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
                  <div class="adjust">
                        <form action"../src/edit.php" id="editForm">
                          <h1>Account details</h1>

                                <label for="fnameE" class="changeDetails" ><b id="operationFnameE">First name:   <?php    $control = new Control(); echo $control->GetUserFirstName($_SESSION["id"]);unset($control);?></b></label></br>
                                <input type="text" placeholder="Change your first name" name="fnameE" id="fnameE"></br><br>

                                <label for="lnameE" class="changeDetails"><b id="operationLnameE">Last name:   <?php    $control = new Control(); echo $control->GetUserLastName($_SESSION["id"]);unset($control);?></b></label></br>
                                <input type="text"  placeholder="Change your last name" name="lnameE" id="lnameE"></br><br>
                                <label for="pswE" class="changeDetails"><b>Please confrim your identity by entering your password</b></br></label></br>
                                  <input type="password"  placeholder="Enter password" name="pswE" id="pswE"></br>
                                  <span class="changeDetails" id="errorMSgEdit"></span></br>
                                <button class="a" type="submit">Edit</button>



                        </form>

            </div>
          </div>
            </div>
</body>

</html>
