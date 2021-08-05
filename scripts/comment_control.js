$(document).ready(function(){
  $("#commentLeave").click(function(){

    var textC = $("#commentContentC").val();

    $("#errorMSgComment").load("../src/add.comment.php",{
      textC : textC
    });
  });
});
$(document).ready(function(){
  var limitation=4;
  $("#loadMoreComments").click(function(){
    limitation=limitation+4;
    $("#olderCommentsLoad").load("../src/load.comment.php",{
      limitation : limitation
    });
  });
});
