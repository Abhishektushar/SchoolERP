<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php
if(!$database->validateNoticeID($_GET['noticeId'])){
  header("location:../");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Notice</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script src="../../assets/js/ckeditor/ckeditor.js"></script>
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
<style>
.jumbotron{
    background: #5433FF;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top, #A5FECB, #20BDFF, #5433FF);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to top, #A5FECB, #20BDFF, #5433FF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
</style>
</head>

<body>
<div class="wrapper">
      <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" align="center">
                    <a href="../notice/full_view.php?id=<?php echo ($_GET['noticeId'])?>">
                <button type="button" class="btn btn-default btn-sm">&#8592 Back</button></a>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        
        <div class="container">
              <?php $get=$database->editMyNotice($_GET['noticeId']); ?>
              <div class="jumbotron">
            <form method="POST">
                <h3 align="center">Edit Notice</h3>
                <div class="form-group" style="width:30%">
                    <label for="notice_type">Notice Type:</label>
                    <input type="text" class="form-control" id ="notice_type" name="notice_type" value="<?php print $get["type"]?>"  disabled>
                    <small style="color:yellow">You cannot change the notice type</small>
                </div>  
                <textarea name="notice_body" class="form-control" id="notice_body"  align="center" style="margin:0 12.5%" required><?php print $get["notice_body"]?></textarea>
                </br>
                <button tpye="submit" name="editNotice" style="float:right"class="btn btn-success">SAVE</button>
             </form>
            </div>
        </div>
      </div>
  </div>
        
  <script>
      CKEDITOR.replace("notice_body");
 </script>
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    </body>
 <?php 
  if(isset($_POST["editNotice"])){
      $NoticeId=$_GET["noticeId"];
        $notice=$_POST["notice_body"];
    $database->updateNotice($notice,$NoticeId);
}
 ?>
</html>
