<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php if(!$database->validateRoute($_GET["id"])) header("location:../admin_transport.php")?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php print $database->routeName($_GET['id']);?></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
<style>
.jumbotron{
    background: #2BC0E4;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #EAECC6, #2BC0E4);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #EAECC6, #2BC0E4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
</style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a href="../admin_transport.php">
                       <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
                        </a>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                        <h2 style="margin:0 25% 0 35% !important;text-align: center;">Delhi Public School</h2>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </nav> 
            
        <div style="font-size: 18px;">
        <div class="jumbotron" style="width : 85%;margin: auto"><h3 align="center"><u>Route Information</u></h3><?php $database->routeInfo($_GET['id'])?></div>
</br>
        <div class="jumbotron" style="width : 85%;margin: auto">
        <a href="#" data-toggle="modal" data-target="#add_student">
                <button type="button" style="float:right" class="btn btn-success">Add Student</button></a>
        <h3>Students taking this route</h3></br>
            <div class="table-responsive">
             <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Srno.</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Father Name</th>
                        <th>Father Contact</th>     
                        <th>Action</th>     
                      </tr>
                    </thead>
                    <tbody style="text-align: left;">
                        
                            <?php $database->transport_student_list($_GET['id']);?>
                      
                    </tbody>
                  </table>  
             </div>
        </div>
        
            </div>
        </div>
</div>
        <?php include "addstudent.php";?>

        </body>     
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>

 
</html>
<?php
if(isset($_POST["delete-student"]))
{
    $stdnt=strip_tags($_POST["deleteStudent"]);
    $database->removethisStudentFrmRoute($stdnt,$_GET['id']);
}
?>