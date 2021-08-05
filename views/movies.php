<?php
include '../src/init.php';

// Check if the user is logged in, if not then redirect him to login page
$loggedin = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
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
                <h1>List of all movies</h1>

                <?php
                $control = new Control();
                $control->DisplayMoviesList(1);
                unset($control);
                ?>

            </div>
            </div>
            <div id="animatedModal">
                    <div class="close-animatedModal">
                        <img width='50px' id="endOfAll" src="../resources/Close.png">
                    </div>

                    <div class="modal-content">
                        <div class="separator"><div class="vl"></div></div>

                    <div class="signin">
                      <form action="../src/login.php" method="POST" id="loginForm">

                          <h1 class="formName">Login</h1>
                              <label for="uname"><b>Username:</b></label></br>
                              <input type="text" placeholder="Enter Username" id="unamelog" name="username" required></br>
                              <label for="psw"><b>Password:</b></label></br>
                              <input type="password" placeholder="Enter Password" id="pswlog" name="password" required></br>
                             <span class="msg" id="errorMSgLogin"><a href="#"></a></span></br>
                              <button class="a" type="submit">Login</button>

                      </form>
                    </div>


                      <div class="signup">
                      <form  action="../src/register.php" id="registerForm">

                          <h1 class="formName">Register</h1>
                              <label for="firstnameR"><b>First name:</b></label><br>
                              <input type="text" placeholder="Enter first name:" name="firstnameR" id="firstnameR" required></br>
                              <label for="lastnameR"><b>Last name:</b></label><br>
                              <input type="text" placeholder="Enter last name:" name="lastnameR" id="lastnameR" required></br>
                              <label for="usernameR"><b>Username:</b></label></br>
                              <input type="text" placeholder="Enter Username" name="usernameR" id="usernameR" required></br>
                              <label for="passwordR"><b>Password:</b></label></br>
                              <input type="password" placeholder="Enter Password" name="passwordR" id="passwordR" required></br>
                              <label for="conf_passwordR"><b>Repeat password:</b></label></br>
                              <input type="password" placeholder="Enter Password" name="conf_passwordR" id="conf_passwordR" required></br>
                              <span class="msg" id="errorMSgRegister"><a href="#"></a></span></br>
                              <button class="a" type="submit">Register</button>

                      </form>
                    </div>
                    </div>
                </div>
      <script>
        $("#hide1").animatedModal();
      </script>

</body>

</html>
