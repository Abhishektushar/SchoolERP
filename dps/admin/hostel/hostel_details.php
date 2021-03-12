<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<!DOCTYPE html>
<html> 

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php $hostel_id=$_GET['ref'];$database->getHostelName($hostel_id);?></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
    <style>
    .jumbotron
    {
      background: #00d2ff;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top, #3a7bd5,#1BAAEC);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #3a7bd5, #1BAAEC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
color: #ffffff;   }
    </style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a href="../admin_hostel.php">
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
            
        <div style="font-size: 16px;">
        <div class="jumbotron" style="width : 85%;margin: auto">
        <a href="#" data-toggle="modal" data-target="#edit"><button class="float-right btn btn-md btn-warning">EDIT</button></a>
        <h3 align="center"><?php $database->getHostelName($hostel_id);?></h3></br></br>
        <a href="#" data-toggle="modal" data-target="#addStudentToHostel">
                <button type="button" style="float:right" class="btn btn-success">Add Student</button></a>
        <h4>Students List</h4></br>
        <div class="table-responsive">
        <form method="post">
        <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>Father Contact</th>     
                        <th>Class</th>     
                        <th>Address</th>     
                        <th>Action</th>     
                      </tr>
                    </thead>
                    <tbody style="text-align: left;">
                   <?php $database->displayStudentInHostel($hostel_id)?>
                    </tbody>
                  </table>  
                  <?php
            if(isset($_POST['delete-student'])){
                    $delete=$_POST['deleteStudent'];   
                    $hostel=$hostel_id;
                    $database->delete_Student($delete,$hostel);                  
            }?>
            </form></div>
        </div>
        
            </div>
        </div>
</div>
<!-- modal -->
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
 
    <!-- Modal content-->
    <div class="modal-content" align="left">
      <div class="modal-header">      
        <h5 class="modal-title">Change Hostel Name</h5>        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form method="POST">
        <div class="form-group">
        <label for="hostel_name">HOSTEL NAME</label>
    <input type="text" class="form-control" id="hostel_name" name="hostel_name" value="<?php print $database->getHostelName($_GET['ref'])?>"required>    
     
      </div>
      <div class="modal-footer">
      <button type="submit" name="edit_name" class="btn btn-sm btn-success">Submit</button></form>
       
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
        <?php include "hostel_student_add.php"?>

        </body>     
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>
           
</html>
<?php
    if(isset($_POST["edit_name"]))
    {
        $name=strip_tags($_POST["hostel_name"]);
        $database->ChangeHostelName($_GET['ref'],$name);
    }
?>