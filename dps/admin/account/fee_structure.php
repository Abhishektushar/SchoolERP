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
    <title>Fee Structure</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>

<style>
#class_search
{
    width:40%;
    margin:auto
}

h2{
    color:#000000;
}
body{
    color:#ffffff;
}
.jumbotron{
    background: #4e54c8;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #8f94fb, #4e54c8);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #8f94fb, #4e54c8); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
</style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid" align="center">
                        <a href="../admin_accounting.php">
                       <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
                        </a>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                        <h2 style="margin:0  31.5% !important;text-align: center;">Delhi Public School</h2>
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
        <div class="jumbotron" style="width : 80%;margin: auto">
        <h3 align="center"><u>Fee Structure</u></h3></br>
            <div class="container" id="class_search">
                    <form method="POST">
                    <div class="input-group">   
                            <input type="text" class="form-control" id="inp-class" name="inp-class" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="Enter Class Here" required>   
                       
                        <div class="input-group-append">
                            <button class="btn btn-success" class="form-control" name="class-sub" id="class-sub" type="submit" >SEARCH</button>
                        </div> 
                       </div> 
                    </form>
                </div>
                <?php
    if(isset($_POST["class-sub"]))
    {
        if(!empty($_POST["inp-class"]))
        {
                $class=strip_tags(($_POST["inp-class"]));

                if($get=$database->getclassfees($class)){?>
                  <!-- Form for fee structure -->
                  
                <div class="container" align="center">
        <form id="feestructure" method="POST">
                    <div class="form-row">
                            <span class="form-group col-lg-1"></span>

                        <div class="form-group col-lg-4">
                            <label for="class_group">Class Group</label>
                            <input type="text" class="form-control" name="class-group" id="class-group" value="<?php print $get["class_grp"]?>" disabled>
                        </div>

                            <span class="form-group col-lg-2"></span>

                        <div class="form-group col-lg-4">
                            <label for="">TUTION FEES</label>
                            <input type="text" class="form-control" id="tutionFee" name="tutionFee" value="<?php print $get["tution"]?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                            <span class="form-group col-lg-1"></span>

                    </div>

                    <div class="form-row">
                            <span class="form-group col-lg-1"></span>
            
                        <div class="form-group col-lg-4">
                            <label for="">SPORTS FEES</label>
                            <input type="text" class="form-control" id="sportFee" name="sportFee" value="<?php print $get["sports"]?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                        </div>
                            <span class="form-group col-lg-2"></span>
                        <div class="form-group col-lg-4">
                        <label for="">EXTRA CURRICULUM FEES</label>
                            <input type="text" name="ccaFee"  class="form-control" id="ccaFee" value="<?php print $get["cca"]?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                        </div>
                                <span class="form-group col-lg-1"></span>

                    </div>

                    <div class="form-row">
                        <span class="form-group col-lg-1"></span>

                        <div class="form-group col-lg-4">
                            <label for="">EXAM FEES</label>
                            <input type="text" class="form-control" id="examFee" name="examFee"value="<?php print $get["exam"]?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required >
                        </div>
                    
                        <span class="form-group col-lg-2"></span>

                        <div class="form-group col-lg-4">
                        <label for="">SPECIAL SUBJECT FEES</label>
                            <input type="text" class="form-control" id="special-sub-fees" name="special-sub-fees" value="<?php print $get["special_subject"]?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required >
                        </div>
                        
                        <span class="form-group col-lg-1"></span>
                             <small><i>LAST UPDATE ON : <strong> <?php print $get["last_update"]?></strong>  </i></small>

                    </div>
                    <br>
                    <button type="submit" id="updateFee" name="updateFee" value="<?php print $get["id"]?>" class="btn btn-warning">UPDATE</button>
                </form>   </div>      
        <!--End of Form Content -->
        <script>document.getElementById("class_search").remove();</script>
               <?php }
        }else{
            echo "<script>alert('Please Enter a Valid input !!!')</script>";
        }
    }
?>             
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
                if(isset($_POST["updateFee"]))
                {
                    // $clgrp=strip_tags($_POST["class-group"]);
                    $id=$_POST["updateFee"];
                    $tution=strip_tags($_POST["tutionFee"]);
                    $sports=strip_tags($_POST["sportFee"]);
                    $cca=strip_tags($_POST["ccaFee"]);
                    $exm=strip_tags($_POST["examFee"]);
                    $spec=strip_tags($_POST["special-sub-fees"]);

                    $database->updatefeestr($id,$tution,$sports,$cca,$exm,$spec);
                }
                
                ?>