<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php
if(!$database->validateNoticeID($_GET['id'])){
  header("location:../");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Notice</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>

</head>

<body>
<div class="wrapper">
      <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" align="center">
                    <a href="../admin_notice.php">
                <button type="button" class="btn btn-default btn-sm">&#8592 Back</button></a>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <h3 style="margin:0  32% !important;text-align: center;">Delhi Public School</h3>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav> 
        
        <div class="container">
            <?php $database->viewFullNotice($_GET['id']) ?>
        </div>
      </div>
  </div>
        

  <div class="container">
  <!-- Modal -->
  <div class="modal fade" id="delete" role="dialog">
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
if(isset($_POST['YconfrmDel'])){
    $database->deleteNotice($_GET['id']);
}
elseif(isset($_POST['NconfrmDel'])){
    echo"<script>location.href='full_view.php?id=".$_GET['id']."'</script>";
}

if(isset($_POST['unsee'])){
  $getID=$_POST['unsee'];

  $database->markInvisible($getID);
}

if(isset($_POST['see'])){
  $getID=$_POST['see'];

  $database->makeVisible($getID);
}

?>