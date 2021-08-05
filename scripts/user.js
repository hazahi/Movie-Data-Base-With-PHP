$(document).ready(function(){
  $("#loginForm").submit(function(event){
    event.preventDefault();
    var uname = $("#unamelog").val();
    var psw = $("#pswlog").val();
    $("#errorMSgLogin").load("../src/login.php",{
      username : uname,
      password : psw
    }, function(response, status, xhr) {
   if(response=="success"){

     document.getElementById('hide1').style.display='none';
     document.getElementById('hide3').style.display='block';
     document.getElementById('hide4').style.display='block';

     document.getElementById('user-name-h').innerHTML = uname;
     document.getElementById("endOfAll").click();

   }
   });
  });
});

$(document).ready(function(){
  $("#registerForm").submit(function(event){
    event.preventDefault();
    var unameR = $("#usernameR").val();
    var passR = $("#passwordR").val();
    var passConfR = $("#conf_passwordR").val();
    var fnameR = $("#firstnameR").val();
    var lnameR = $("#lastnameR").val();
    $("#errorMSgRegister").load("../src/register.php",{
      usernameR : unameR,
      passwordR : passR,
      conf_password: passConfR,
      firstnameR: fnameR,
      lastnameR: lnameR
    },function(response, status, xhr){
      if(response=="success"){

        $("#registerForm")[0].reset();
        document.getElementById("errorMSgRegister").innerHTML='Registration successfull, you may now log in!';

      }
    });
  });
});
