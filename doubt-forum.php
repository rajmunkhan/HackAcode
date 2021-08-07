<?php 
include './partials/db.php';
session_start();
$alert=false;
$erroralert=false;
$table="post";
if (isset($_POST['thread_submit'])){
    $title=mysqli_real_escape_string($mysqli,$_POST['title']);
    $content=mysqli_real_escape_string($mysqli,$_POST['editor']);
    $class="CLS345";
    $user_id=$_SESSION['user_id'];
    $date=date('Y-m-d h:i:s');
    $query=$mysqli->query("INSERT INTO $table VALUES ('','$title','$content','$class','$user_id','$date')");
    if($query){
        $alert=true;

    }
    else{
        $erroralert="something went wrong";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doubt Forum</title>
    <script src="ckeditor/ckeditor.js"></script>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


<link rel="stylesheet" href="./css/forum.css?v=<?php echo time();?>">
</head>
<body>
    <?php include './partials/header.php'?>
    <?php if($alert) {
    
    echo ' <div class="alert alert-success 
        alert-dismissible fade show" role="alert" style="margin-bottom:0px;;border-radius:0px;">
        <strong>Success!</strong> Your doubt has been posted
        <button type="button" class="close"
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button> 
    </div> ';
    echo '<meta http-equiv="refresh" content="2" />';
     
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
    <div class="container">
    <div class="container search-bar">
    <form style="margin-top:30px; " method="POST" class="d-flex">
        <input type="search" name="search" id="search" class="form-control" placeholder="Search discussions" aria-label="Search">
        <button class="btn btn-success search"  type="submit" name="submit" >Search</button>
       
    </form>
</div>
<br>
   <div class="container">
        
    <form method="POST" id="mainform">
        <input type="text" placeholder="title" id="title" class="form-control"name="title" required><br>
        <textarea   id="editor" name="editor"  required></textarea><br>
        <?php  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
          echo '<a class="btn btn-success" href="login.php" >Login to Continue</a>';
        }
        else{
          echo '<button class="btn btn-success" type="submit" name="thread_submit"  >Post thread</button>';
        }
        ?>
    </form>
   </div>

   <div class="container recent-posts">
       <br>
       <h1>Recently added</h1>
       <div class="container" id="display-thread">
       <?php

        $query="SELECT * FROM $table WHERE `class_id`='CLS345'";
        $result=$mysqli->query($query);
        while($data=$result->fetch_assoc()){
        echo '<div class="container"><p style="margin-bottom:0;color:orangered;font-size:15px;">'.$data['author'].' shared </p>';
        echo '<p style="margin-bottom:2px;" ><a class="link" href="post.php?id='.$data['post_id'].'">'.stripslashes($data['title']).' </a></p></div><br>';
        }

?>
       </div>
   </div>


</div>

<script>
  CKEDITOR.replace( 'editor', {
        height: 100
    } ); 

</script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>