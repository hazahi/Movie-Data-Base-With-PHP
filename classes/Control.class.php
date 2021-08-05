<?php
class Control extends Dbh{

  public function getMovies(){
    $sql="SELECT * FROM movies ORDER BY yearOfRelease DESC";
    $stmt= $this->connect()->query($sql);
    $movies=array();
    while($row=$stmt->fetch()){
    $movie = new Movie($row["movieName"],$row["ID"],$row["yearOfRelease"],$row["Mdescription"],$row["genre"],$row["cover"]);
    $movies[]=$movie;
      }
    return $movies;
  }

  public function DisplayMoviesList($mode){
    $arr=$this->getMovies();
    $counter=0;
    foreach($arr as $value){
      if($counter<3){
        $urlMaker=$value->getMovieID();
      echo "<table class='movie'><tr><th colspan="."2"."><a href="."movie.php?result=".$urlMaker.">". $value->getNameOfMovie()."(".$value->getReleaseYear() .")</a></th> </tr>";
      echo "<tr><td rowspan="."2"."><a href="."movie.php?result=".$urlMaker."><img src=". $value->getCover() ." class="."resize"."></td><td rowspan="."1".">Genre: ". $value->getGenre() ."</a></td></tr>";
      echo "<tr><td rowspan="."2"."> Description: <br>". $value->getDescription() ." </td></tr></table>";
      }
      if($mode==2){
        $counter+=1;
      }
    }
  }
  public function FindMovie($id){
    $arr=$this->getMovies();
    $movieSearch;
      foreach($arr as $value){
        if($value->getMovieID()==$id){
          $movieSearch=$value;
          return $movieSearch;
        }
      }
  }
  public function DisplayMovie($id){
    $movie=$this->FindMovie($id);
    echo "<div  class='mTitle'><h1>".$movie->getNameOfMovie()."(".$movie->getReleaseYear().")</h1></div>";
    echo "<div class='mCover'><img src=".$movie->getCover()." class='resize2'></div>";
    echo "<div class='mDesc'><p>Genre: ".$movie->getGenre()."</p><hr class='horline'><p>Description:<br>".$movie->getDescription()."</p></div>";
  }
  public function FindUser($id){
    $sql="SELECT * FROM user WHERE id = ?";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $row=$stmt->fetch();
    $user = new User($row["username"],$row["fname"],$row["lname"],$row["password"],$row["role"]);
    return $user;
  }
  public function GetUserFirstName($id){
    $user=$this->FindUser($id);
    $fname=$user->GetFname();
    return $fname;
  }
  public function GetUserLastName($id){
    $user=$this->FindUser($id);
    $lname=$user->GetLname();
    return $lname;
  }
  public function GetUserPassword($id){
    $user=$this->FindUser($id);
    $pass=$user->GetPass();
    return $pass;
  }
  public function AttemptUpdate($id,$fname,$lname,$psw){
    $firstname;
    $lastname;
    $password=$this->GetUserPassword($id);
    if(!empty($psw)){
      if(password_verify($psw,$password)){
      if(empty($fname)){
        $firstname=$this->GetUserFirstName($id);
      }
      else{
        $firstname=$fname;
      }
      if(empty($lname)){
        $lastname=$this->GetUserLastName($id);
      }
      else{
        $lastname=$lname;
      }
      $sql="UPDATE user SET fname= ? ,lname= ? WHERE id = ?";
      $stmt=$this->connect()->prepare($sql);
      $stmt->execute([$firstname,$lastname,$id]);
      $message="success";
      return $message;
      }
      else{
        $message="The password you have entered is wrong!";
        return $message;
      }
    }
    else{
      $message="Please enter your password in order to proceed";
      return $message;
    }

  }
  public function RegisterMovie($name,$year,$descrip,$genre,$cover){
    $listOfMovies=$this->getMovies();
    foreach($listOfMovies as $value){
      if($value->getNameOfMovie()==$name){
        return "Movie exists in database";
      }
    }
    $sql="INSERT INTO movies (movieName,yearOfRelease,Mdescription,genre,cover) VALUES (?,?,?,?,?)";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([$name,$year,$descrip,$genre,$cover]);
  }
  public function AttemptLogIn($username,$password){
    $sql="SELECT * FROM user WHERE username = ?";
    $stmt= $this->connect()->prepare($sql);
    $stmt->execute([$username]);
    $user;
    while($row=$stmt->fetch()){
      $user = new User($row["username"],$row["fname"],$row["lname"],$row["password"],$row["role"]);
      $user->SetId($row["id"]);

      }
      if(!empty($user)){
        $pass=$user->GetPass();
        if(password_verify($password,$pass)){

            return $user;

        }
        else{
          $message="Wrong password!";
          return $message;}
      }
      else{
        $message= "User not found!";
      return $message;}
  }
  public function AttemptRegistration($uname,$psw,$cpsw,$fname,$lname){
   $message;
   if($psw != $cpsw){
     $message = "Passwords do not match!";
     return $message;
   }
   else{
   if(empty($uname)||empty($psw)||empty($cpsw)||empty($fname)||empty($lname)){
     $message = "All fields are required!";
     return $message;
   }
   else{
     $sql="SELECT * FROM user WHERE username = ?";
     $stmt= $this->connect()->prepare($sql);
     $stmt->execute([$uname]);
     $result=$stmt->rowCount();
     if($result==0){
       $param_password = password_hash($psw, PASSWORD_DEFAULT);
       $sql="INSERT INTO user(username,password,fname,lname) VALUES(?,?,?,?)";
       $stmt=$this->connect()->prepare($sql);
       $stmt->execute([$uname,$param_password,$fname,$lname]);
       $message="success";
       return $message;
     }
     else {
       $message="Selected username is taken.";
       return $message;
     }
    }
    }
    }
  public function AddComment($uid,$text,$mid){

    if(empty($uid)||empty($mid)){
      $message="Only logged users can add comments";
      return $message;
    }
    else{
      if(!empty($text)){
      $cDate="[". date("Y-m-d h:i:sa")."]";
      $sql="INSERT INTO comments (comment,user_id,timeSt,id_movie) VALUES (?,?,?,?)";
      $stmt=$this->connect()->prepare($sql);
      $stmt->execute([$text,$uid,$cDate,$mid]);
      $message="Comment submited!";
      return $message;
      }
      else{
        $message="Cannot submit blank comment!";
        return $message;
      }
    }
  }
  public function GetComments($limit,$mid){

      $sql="SELECT * FROM comments  WHERE id_movie = ? ORDER BY timeSt DESC LIMIT $limit";
      $stmt=$this->connect()->prepare($sql);
      $stmt->execute([$mid]);
      $comments=array();
      while($row=$stmt->fetch()){
        $comment= new Comment($row["id_movie"],$row["user_id"],$row["timeSt"],$row["comment"],$row["id"]);
        $comments[]=$comment;
      }
      if(empty($comments)){
        $message="No comments found! Be the first one to leave a comment!";
        return $message;
      }
      else{
        return $comments;
      }
    }
  public function DisplayComments($limit,$mid){
    $comments=$this->GetComments($limit,$mid);
    if(is_string($comments)){
      echo $comments;
    }
    else{
      foreach($comments as $value){
      $user=$value->GetCommentUID();
      $fname=$this->GetUserFirstName($user);
      $lname=$this->GetUserLastName($user);
      echo "<div class='loadedComments'><div class='cUserPart'><p>Posted by: ".$fname." ".$lname."</p></div>";
      echo "<div class='cUserComment'><p>".$value->GetCommentText()."</p></div>";
      echo "<div class='cUserTimeSt'><p>Posted on:".$value->GetCommentTimeSt()."</p></div></div>";

    }
    
    }

  }

}

 ?>
