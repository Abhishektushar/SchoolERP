<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php 
$class=explode(" ",$_GET["class"]);
if ($class[1] <=0|| $class[1] > 12)
{
    header("location:../");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php print ($_GET['class'])." Exam Schedule";?></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
<style>
#getMsg{
    color:red;
}
</style>
</head>

<body>
<div class="wrapper">
      <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" align="center">
                    <a href="../admin_examination.php">
                <button type="button" class="btn btn-default btn-sm">&#8592 Back</button></a>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <h3 style="margin:0  31% !important;text-align: center;font-size:4.5vh">Delhi Public School</h3>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav> 
            
        <div class ="container " align="center">
        
            <h2 align="center"><?php print ($_GET['class']);?></h2>
            <span id="getMsg"></span>
            <?php $database->examSchView($_GET['class'])?>
        </div>
      </div>
  </div>

     <!---this model is for updating TIme Table--->
     <div id="update-exam" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" align="left">
        <div class="modal-header">
            <h4 class="modal-title">Update Exam Schedule</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="select-class">You are changing Exam Schedule of <strong> <?php print ($_GET['class']);?> </strong></label>
        </div>
    
        <div class="form-group">
        <label for="file">
            <input type="file"  name="file2">
        </label></br>
        
        <small>file size should be less than <b>1 MB</b>
        </br>Formats allowed are : <strong>'jpg', 'jpeg', 'png'</strong></small></br>
        </div>

        <button type="submit" name="update" class="btn btn-success">Submit</button></form>
        
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div> 
    <?php
  if(isset($_POST["update"])) 
  {    
      $class=$_GET['class'];
      $file=$_FILES['file2'];
  
      $fileName=$_FILES['file2']['name'];
      $fileTmpName=$_FILES['file2']['tmp_name'];
      $fileSize=$_FILES['file2']['size'];
      $fileError=$_FILES['file2']['error'];
      $fileType=$_FILES['file2']['type'];
                    
      $database->updateExamSchedule($fileName, $fileError, $fileSize, $fileTmpName,$class);  
  }
?>     
       <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    </body>
 
</html>
