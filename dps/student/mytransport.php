<?php 
session_start();
require("../base/studentdatabase.php");
if(!isset($_SESSION['studentId']) && !isset($_SESSION['class']) && !isset($_SESSION['facility']) && !isset($_SESSION['student']))  
    header("location:../");
?>
<?php $tid=$studentdatabase->getTransportId($_SESSION['studentId']);?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Transport Information</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="assets/js/fontawesome.js" crossorigin="anonymous"></script>
    <style>
.jumbotron{
    background: #2BC0E4;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #EAECC6, #2BC0E4);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #EAECC6, #2BC0E4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
width:80%;
margin:auto;

}
</style>
</head>
<body>
<div class="wrapper">
      <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" align="center">
                    <a href="index.php">
                <button type="button" class="btn btn-default btn-sm">&#8592 Back</button></a>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <h3 style="margin:0  33% !important;text-align: center;">Delhi Public School</h3>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav> 
        <div class="jumbotron" ><h3 align="center"><u>Route Information</u></h3><?php $studentdatabase->routeInfo($tid)?></div>
</br>
        <div class="jumbotron" >
        <h3>Students in this route</h3></br>
            <div class="table-responsive">
             <table class="table table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th>Srno.</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Father Name</th>
                        <th>Father Contact</th>     
                      </tr>
                    </thead>
                    <tbody style="text-align: left;">
                        <form method="POST">
                            <?php $studentdatabase->transport_student_list($tid);?>
                        </form>
                    </tbody>
                  </table>  
             </div>
        </div>
        
        
</div>
    <?php include "includes/lowerHtml.php"?>