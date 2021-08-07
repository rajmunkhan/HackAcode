<?php

include './partials/db.php';
$alert=false;
$erroralert=false;
$table="users";
if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($mysqli,$_POST['name']);
    $email=mysqli_real_escape_string($mysqli,$_POST['email']);
    $password=mysqli_real_escape_string($mysqli,$_POST['password']);
    $role=mysqli_real_escape_string($mysqli,$_POST['role']);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $unique=$mysqli->query("SELECT `email` FROM $table WHERE `email`='$email' ");
    if(mysqli_num_rows($unique)==0){
        $query=$mysqli->query("INSERT INTO $table VALUES('','$name','$email','$hash','$role')");
        if($query){
            $alert=true;
        }
        else{
            $erroralert="Something Went Wrong :(";
        }
    }
    else{
        $erroralert="This email id is already registered.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education</title>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Nav bar  -->
<nav class="navbar navbar-default navbar-expand-sm">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav navbar-right navbar-expand-sm">
      <li class="active nav-item"><a href="#" class="nav-link">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link">Page 1</a></li>
      <li class="nav-item"><a href="#" class="nav-link">Page 2</a></li>
      <li class="nav-item"><a href="#"class="nav-link">Page 3</a></li>
    </ul>
  </div>
</nav>
<?php if($alert) {
    
    echo ' <div class="alert alert-success 
        alert-dismissible fade show" role="alert" style="margin-bottom:0px;;border-radius:0px;">
        <strong>Success!</strong> Your account is 
        now created and you can login. 
        <button type="button" class="close"
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button> 
    </div> ';
    echo '<meta http-equiv="refresh" content="2;url=login.php" />';
     
   }
   if($erroralert) {
    
    echo ' <div class="alert alert-danger 
        alert-dismissible fade show" role="alert" style="margin-bottom:0px;border-radius:0px;"> 
       <strong>Error!</strong> '. $erroralert.'<button type="button" class="close" 
       data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">×</span> 
       </button> 
        </div> '; 
   }


?>
<!-- form -->
<div class="container">
<form method="POST">
    <h1>Sign Up</h1>
    <input type="text" class="form-control" placeholder="Enter your name" id="name" name="name"><br>
    <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email"><br>
    <input type="password" class="form-control" placeholder="Enter your password" id="password" name="password"><br>
    <input type="radio"  id="teacher" name="role" value="0">Teacher<br>
    <input type="radio"  id="student" name="role" value="1">Student<br><br>
    <button type="submit"  name="submit">Sign Up</button><br><br>
    <p>Already have an account ? <a href="login.php">login</a></p>
</form>
</div>
</body>
</html>