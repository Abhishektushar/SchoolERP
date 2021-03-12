<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php
    if(!$database->checkIfStudentIDexist($_GET["sid"]))
        header("location:../");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php $database->getStudentName($_GET["sid"]);?></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
    <style>

.jumbotron{
    width:80%;
    margin:auto;
    background: #2BC0E4;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #EAECC6, #2BC0E4);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #EAECC6, #2BC0E4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.btn{
    margin-left:10px;
}
table, th, td {
    border: 2px solid black !important;
}
input{
    margin-left:15px;
    padding-left:15px;
}
label{
    margin-top:10px;
}
</style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid" align="center">
                        <a href="../admin_attendance.php">
                       <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
                        </a>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                        <h2 style="margin:0  31% !important;text-align: center;font-size:4.5vh">Delhi Public School</h2>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </nav> 
            <div class='jumbotron'>  
                <h3 align="center"><?php echo $database->getStudentName($_GET["sid"])?></h3><br>
                <h6><?php echo "CURRENTLY ACCESSED BY : <b>".$_SESSION['admin']."</b>"?></h6>
                <div class="table-responsive">
                 <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Student ID</th>
                        <th scope="col">Class</th>
                        <th scope="col">Total Attended</th>
                        <th scope="col">Working Days</th>
                        <th scope="col">Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $database->getStudentAttedanceRecord($_GET["sid"])?>
                    </tbody>
                    </table>
           <button type="button" class="btn btn-md btn-warning float-right" data-toggle="modal" data-target="#edit">EDIT ATTENDANCE</button>
                </div>
            </div> 
</div>
</div>
<!-- Modal -->
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Change Attendance</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <span>Change total Attended days by <b><?php print $database->getStudentName($_GET["sid"])?></b></span><br>
      <form method="POST">
    <?php $database->EditStudentAttendance($_GET["sid"])?>
    <button type="submit" class="btn btn-info float-right" name="submitIt" >Submit</button></form>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<?php
if(isset($_POST["submitIt"]))
{
    $presentval=strip_tags($_POST["changeP"]);
    $database->updatePresentDays($presentval,$_GET["sid"]);
}
?>