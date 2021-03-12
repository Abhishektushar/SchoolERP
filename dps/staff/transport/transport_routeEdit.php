<?php 
session_start();
require("../../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) ))  
    header("location:../../");
if((isset($_SESSION['post'])) && ($_SESSION['post']!="Transport Officer")){
    header("location:../../");
}
?>
<?php if(!$staffdatabase->validateRoute($_GET["id"])) header("location:../transport.php")?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Edit Route</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
<style>
.form-box{
  background-color:#00c8ff!important;
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
.element{
  width:77%;
  margin:0 auto;
}
form{
  padding:25px;
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
 .box-title button{
   float:right;
 }
 th ,td{
   font-size:0.8rem!important;
 }
.student-details{
  display:block; 
  width:inherit !important;
  
}
.student-details p{
  color:#eee;
  font-size:1rem;
  font-weight: normal;
}
#promp{
  font-weight:normal;
  font-size:18px !important;
  color:#ffffff;
}
.fineInfo{
  width:330px;
  height:150px;
  padding:30px 50px;
  background-color:#e6e6e6;
  border-radius:5px;
  font-size:0.8rem;
}
input{
    margin-bottom:15px;
}
label{
        font-size:20px;
}

</style>
</head>
<body>
  
    <!-- Page Content Holder -->
  <div class="wrapper">
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" align="center">
          <a href="../transport.php">
          <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
          </a><button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
          <h3 style="margin:0  33% !important;text-align: center;">Delhi Public School</h3>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                </li> 
              </ul>
            </div>
          </div>
      </nav> 
      <div class="element">
            <div class="box-title container">
              <h4>EDIT ROUTE</h4>        
              <div align="right" class="mybtn remove">
                 <a href='#' data-toggle='modal' data-target='#remove'>
                    <button class="btn btn-danger btn-sm" id="removeit">REMOVE</button></a>
              </div>
            </div>
           
          <div class="form-box container">
              <div class="form-row">                 
                    <div class="container" align="center" id="editInfo" class="form-group col-md-6">
                      <div class="form-group col-md-4">             
                      <form method="POST">
                              <?php $fetch=$staffdatabase->routeEdit($_GET["id"],$_SESSION['post'])?>
                              <label>Route No</label><input type="text" class="form-control" value="<?php print $fetch['route_no'];?>" disabled>
                              <label>Route name</label><input type='text' class='form-control' name='Rname' value="<?php print $fetch['name'];?>"  >
                              <label>Driver name</label><input type='text' class='form-control' name='driverName' value="<?php print $fetch['driver_name'];?>"  >
                              <label>Driver contact</label><input type='text' class='form-control' maxlength='10' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name='driverContact' value="<?php print $fetch['driver_contact'];?>"  >
                              <label>Road 1</label><input type='text' class='form-control' name='road1'  value="<?php print $fetch['road1'];?>"  >
                              <label>Road 2</label><input type='text' class='form-control' name='road2' value="<?php print $fetch['road2'];?>" >
                              <label>Road 3</label><input type='text' class='form-control' name='road3' value="<?php print $fetch['road3'];?>" >
                              <button type='submit' name='changes-submit' class='btn btn-warning btn-sm'>SUBMIT</button>
                       </form>
                      </div>                    
                    </div>
               
          </div>
          </div>
      </div>
    </div>
    </div>  
  </div>
  <!-- modal -->
  <div class="modal fade" id="remove" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation Required</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
          <form method="Post">
            <p>Are You Sure You want to delete!!!</p>
              <div align="center">
              <button class="btn btn-warning" type="submit" name="YconfrmDel">Yes</button>
              <span style="margin-left:25px"></span>
              <button class="btn btn-success" type="submit" name="NconfrmDel">No</button>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
  if(isset($_POST["changes-submit"]))
  {
      $name=strip_tags($_POST["Rname"]);
      $r1=strip_tags($_POST["road1"]);
      $r2=strip_tags($_POST["road2"]);
      $r3=strip_tags($_POST["road3"]);
      $driverName=strip_tags($_POST["driverName"]);
      $driverContact=strip_tags($_POST["driverContact"]);
      $staffdatabase->updateDetailsOfRoute($_GET['id'],$name,$r1,$r2,$r3,$driverName,$driverContact,$_SESSION['post']);
  }
 
  if(isset($_POST["YconfrmDel"]))
  {
      $staffdatabase->removeThisRoute($_GET["id"],$_SESSION['post']);
  }else if(isset($_POST["NconfrmDel"])) {
      echo "<script>location.href='transport_routeEdit.php?id=".$_GET["id"]."';</script>";
  }
?>