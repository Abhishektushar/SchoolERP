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
    <title>Class Based Fees</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
<style>
.jumbotron{
    width:90% !important;
    margin:auto;
    width:100%;
    background: #667db6;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #667db6, #0082c8, #0082c8, #667db6);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #667db6, #0082c8, #0082c8, #667db6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
 opacity:1;
}
.bd{
    	width:auto;
    	height:auto;     	
        /* background: linear-gradient(to right, #002395, #002395 33.33%, white 33.33%, white 66.66%, #ed2939 66.66%); */
        background: linear-gradient(to right, #002395, #002395 50%, white 50%);
        display: flex;
        justify-content: center; /* center horizontally */
        align-items: center; /* center vertically */
        border-radius:5px;
        margin:10px auto;
    }
.inf-container
    {
        background: #5433FF;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left,#29A4FF, #20BDFF, #0943ef);  
        background: linear-gradient(to left, #29A4FF, #20BDFF, #0943ef); 
        padding:10px;
    	height:auto;   
        display: flex;
        justify-content: center; /* center horizontally */
        align-items: center; /* center vertically */
        margin:10px auto;
        border-radius:5px;
        border-left:15px solid #ffffff;
        padding:7%;
       color:#fff;
       font-size:18px;
    }

#leftcontainer{
    float:left;
    color:#fff;
    margin:10px auto;
}
#rightcontainer{
    margin:10px auto;
    color:#000;
}
#class-display{
    background-color:#eee;
    border-radius:2px;
    margin:5px;
    display: flex;
    justify-content: center; 
    align-items: center; 
    padding:5px ;
}
#total{
    font-size:20px;
    color:#fff;
    margin:20px;
}
#date{
    color:#fff;
    float:right;
}
h4{
    color:#ffffff;
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
            <div class="jumbotron">
               <?php $fetch=$database->classView($_GET["class"]); ?>
              
                <div class="container" align="center"><h4>CLASS DETAILS</h4></div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bd">
                                    <div class="container" align="center" id="leftcontainer">
                                        <h5>CLASS GROUP</h5>
                                    </div>
                                    <div class="container" id="rightcontainer">
                                        <?php ($x=explode(",",$fetch["class_grp"]));
                                            $i=0; 
                                                while($i!=count($x)){
                                                    print "<div id='class-display'>CLASS : ".$x[$i]."</div>";$i++;
                                                }
                                        ?>
                                    </div>
                            </div>                        

                        </div>
                       
                        <div class="col-md-6">
                             <div class="inf-container">             
                                TUTION : <?php print "₹ ".$fetch["tution"]?><br>
                                SPORTS : <?php print "₹ ".$fetch["sports"]?><br>
                                EXAM : <?php print "₹ ".$fetch["exam"]?><br>
                                EXTRA : <?php print "₹ ".$fetch["cca"]?><br>
                                SPECIAL SUBJECTS : <?php print "₹ ".$fetch["special_subject"]?><br>
                            </div>
                         <span id="date">LAST UPDATE : <?php print $fetch["last_update"]?></span>
                        </div>
                        <span id="total"><i>TOATAL STUDENT IN THIS CLASS: <?php print $database->countStudent($x[0])?></i></span>           
                    </div>
                    <a href="fee_structure.php">
                        <button type="button"  class="btn btn-warning btn-md">Edit Fees</button> </a>
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
