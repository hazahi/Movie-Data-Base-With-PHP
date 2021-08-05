$(document).ready(function(){
  $("#editForm").submit(function(event){
    event.preventDefault();
    var fname = $("#fnameE").val();
    var lname = $("#lnameE").val();
    var psw = $("#pswE").val();
    $("#errorMSgEdit").load("../src/edit.php",{
      firstnameE : fname,
      lastnameE : lname,
      passwordE : psw
    }, function(response, status, xhr) {
    if(response=="success"){
     $("#editForm")[0].reset();
     document.getElementById("operationFnameE").innerHTML="First name:   "+fname;
     document.getElementById("operationLnameE").innerHTML="Last name:   "+lname;
     document.getElementById("errorMSgEdit").innerHTML = "Changes saved successfully!";
    }
    });
  });
});
