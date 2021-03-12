<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php if($_GET["class"]>12 || $_GET["class"]<=0)
    header("location:../");
?>
<style>
.btn{
    margin-top:10px;
    margin-bottom:10px;
}
</style>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo "Class ".$_GET["class"]?></title>

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
background: -webkit-linear-gradient(to right, #EAECC6, #2BC0E4);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #EAECC6, #2BC0E4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
</style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a href="../admin_student.php">
                       <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
                         </a>
                         <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                   
                         <h2 style="margin:0% 25% 0% 35% !important;text-align: center;justofy-content:center">Delhi Public School</h2>
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
             
               <div class="container "> <h3 align="center"><?php echo "CLASS ".$_GET["class"]?></h3></div><br>
               <?php if(!$database->checkIfClassHasTeacher($_GET['class'])){?>
             <button class="btn btn-sm btn-warning float-right" type="button" data-toggle="modal" data-target="#assign">ASSIGN TEACHER</button> <?php }else{?>
             <h6>CLASS TEACHER : <?php echo $database->getClassTeacherName($_GET['class']);?></h6>
             <?php }?>
                <div class="table-responsive">
                 <table class="table table-striped">
                    <thead>
                      <tr>
                        <th width="5%">Srno.</th>
                        <th width="15%">Full Name</th>
                        <th width="10%">Gender</th>
                        <th width="12%">Contact No.</th>
                        <th width="25%">Address</th>
                        <th width="15%">Father's Name</th>
                        <th wisth="15%">Father's Contact</th>
                     </tr>
                    </thead>
                    <tbody id="studentTab">
                <?php $database->getStudentListClassWise($_GET["class"]);?>
                </tbody>
                  </table>  
              </div>
            </div> 
            
        </div>
       </div>
        <!-- modal    -->
        <div id="assign" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">ASSIGN CLASS TEACHER</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <h5>CLASS <?php echo $_GET["class"];?></h5>
      <form method="POST">
      <select name="teacher" id="teacher" class="form-control plaintext">
        <option value="">--SELECT--</option>
            <?php ($database->getTeacherName($_GET['class'])); ?>
      </select>
      <button class="float-right btn btn-primary" name="add">ADD</button></form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>

    
</body>

</html>
<?php
    if(isset($_POST['add'])){
        $tid=strip_tags($_POST['teacher']);
        $class=strip_tags($_GET['class']);
        $database->setClassTeacherToClass($class,$tid);
    }

?>