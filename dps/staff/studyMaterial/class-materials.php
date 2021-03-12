<?php 
session_start();
require("../../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) && (!isset($_SESSION['post_assigned']))))  
    header("location:../../");

?>
<?php
    if(isset($_SESSION['post_assigned']))
        if($_SESSION['post_assigned']!="Asst. Teacher")
        header("location:../../");
    $class=$_GET["class"];
     function checkClass($class)
        {   
            $flag=0;
            $x =explode(",",$_SESSION['classes']);
            foreach ($x as $y) {
        if($class == $y)
            {$flag=1;break;}
        else
            $flag=0;}
        return $flag;}

    if(checkClass($_GET["class"])!=1)
        header("location:../../");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php print "Class ". ($_GET["class"])?></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
    <style>
        .jumbotron{
            background: #00c6ff;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #0072ff, #00c6ff);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #0072ff, #00c6ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
color:#ffffff;

}
        
    </style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid" align="center">
                        <a href="../study_materials.php">
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
            
        <div style="font-size: 15px;">
        <div class="jumbotron" style="width : 85%;margin: auto;background-color:#43d8c9">
        <h3 align="center"><?php print "<u>CLASS ".$_GET['class']."</u>"?></h3></br>
        <a href="#" data-toggle="modal" data-target="#addMaterial">
                <button type="button" style="float:right" class="btn btn-success">Add Material</button></a>
        <h4>Materials Provided</h4></br><strong><p align="center" style="color:#FF0000" id="getMsg"></p></strong>
             <?php $staffdatabase->getMaterials($_GET['class']);
             
                if(isset($_POST['deleteMaterial'])){
                    $val=$_POST['delete-material'];
                    $class=$_GET['class'];
                  
                    $staffdatabase->removeMaterial($val,$class,$_SESSION['post_assigned']);
                  }
                ?>    
        </div>
        
            </div>
        </div>
</div>
        <?php include "material_add.php"?>

        </body>     
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>

 
</html>
