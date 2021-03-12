<?php 
session_start();
require("../base/studentdatabase.php");
if(!isset($_SESSION['studentId']) && !isset($_SESSION['class']) && !isset($_SESSION['facility']) && !isset($_SESSION['student']))  
    header("location:../");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>BOOK ISSUE</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="assets/js/fontawesome.js" crossorigin="anonymous"></script>
<style>
.form-box{
  background-color:#7E57C2 !important;
  border-radius:0  0 10px 10px;
  box-shadow:
  0 2.8px 2.2px rgba(0, 0, 0, 0.034),
  0 6.7px 5.3px rgba(0, 0, 0, 0.048),
  0 12.5px 10px rgba(0, 0, 0, 0.06),
  0 22.3px 17.9px rgba(0, 0, 0, 0.072),
  0 41.8px 33.4px rgba(0, 0, 0, 0.086),
  0 100px 80px rgba(0, 0, 0, 0.12)
;
  min-height: 400px;
   height:auto;
   margin: auto;
   padding:2% 0;
   
} 
#fine{
    color:yellow;
    font-size:16px;
    float:right;
    margin-right:10%;
}
.element{
  width:77%;
  margin:0 auto;
}
.box-title{
  background-color:#000000;
  color:#ffffff;
   width:100%;
  min-height:150px;
  border-radius:10px 10px 0 0;
 }
 .box-title h4{
   justify-content:center;
   text-align:center;
   padding-top:50px;

 }
 th ,td{
   font-size:1rem!important;
 }
/* fixing table height */
tbody {
    background-color:#ffffff;
  display:block;
    height:auto;
    overflow:auto;
    max-height:400px;
}
thead, tbody tr {

    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}

table {
    width:80% !important;
    margin:auto;
}

</style>
</head>
<body>
  
    <!-- Page Content Holder -->
  <div class="wrapper">
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" align="center">
          <a href="index.php">
          <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
          </a>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
          <h3 style="margin:0  32% !important;text-align: center;">Delhi Public School</h3>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                </li> 
              </ul>
            </div>
          </div>
      </nav> 
      <div class="element">
            <div class="box-title container">
              <h4>BOOK ISSUES</h4>
             </div>
           
          <div class="form-box container">
          <?php if($val=$studentdatabase->checkpendingFINES(($_SESSION['studentId']))) echo "<div id='fine'>PENDING FINE : &#8377; ".$val."</div><br>";?>

              <div class="form-row">
                <div class="container">
                    <div class="form-group row">   
                      <?php $studentdatabase->getPreviousBookIssueInfo($_SESSION['studentId']);?>
                    </div>
                    <!-- if student has a pending fine -->
                    
                         
                 </div>
          </div>
          </div>
      </div>
    </div>
    </div>       
          
 </body>
      <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>

  </html>
 