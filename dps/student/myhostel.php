<?php 
session_start();
require("../base/studentdatabase.php");
if(!isset($_SESSION['studentId']) && !isset($_SESSION['class']) && !isset($_SESSION['facility']) && !isset($_SESSION['student']))  
    header("location:../");
?>

<?php $hid=$studentdatabase->getHostelId($_SESSION['studentId']);?>
<!DOCTYPE html>
<html> 

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo  $studentdatabase->getHostelName($hid);?></title>

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
table{
   font-size:0.9rem !important; 
}
    </style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a href="index.php">
                       <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
                        </a>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                        <h2 style="margin:0 25% 0 35% !important;text-align: center;">Delhi Public School</h2>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </nav> 
            
        <div style="font-size: 16px;">
        <div class="jumbotron" style="width : 85%;margin: auto">
         <h3 align="center"><?php echo  $studentdatabase->getHostelName($hid);?></h3></br></br>
        <h4>Students In This Hostel</h4></br>
        <div class="table-responsive">
        <form method="post">
        <table class="table table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th>Sr No.</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>Father Contact</th>     
                        <th>Class</th>     
                        <th>Address</th>     
                      </tr>
                    </thead>
                    <tbody style="text-align: left;">
                   <?php $studentdatabase->displayStudentInHostel($hid)?>
                    </tbody>
                  </table>  
                  
            </form></div>
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
