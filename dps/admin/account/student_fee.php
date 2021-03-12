<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>

<?php $get=($database->studentFeesView($_GET["id"]))?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php print $get["FirstName"]." ".$get["MiddleName"]." ".$get["LastName"]." Fee Details";?></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>

<style>

h2{
    color:#000000;
}
body{
    color:#ffffff;
}
.modal-content{
    color:#000000  !important;
}
.col-lg-6{
    margin-top:25px;
}
.jumbotron{
    background: #4e54c8;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #5150CA, #4e54c8);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #5150CA, #4e54c8); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
#information{
    font-size:16px;
    float: left;
}
.container,#piechart{
    margin-top:20px;
}

#information span{
    display:block;
}
#information strong{
    padding-left:15px;
}
.btn-warning{
    float:right;
}
.btn-custom{
    margin-top:10px;
    background-color: #42e6a4;
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
            
        <div class="jumbotron" style="width : 80%;margin: auto">
            <h4 align="center"><?php print $get["FirstName"]." ".$get["MiddleName"]." ".$get["LastName"]?></h4>
            <button type="button"  data-toggle="modal" data-target="#feesInput" class="btn btn-md btn-warning">PAY</button>
           <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                     <h5>STUDENT DETAILS</h5>
                        <div class="container" id="information">
                        <span>STUDENT ID : <strong><?php print $get["student_id"] ?></strong></span>
                        <span>FULL NAME : <strong><?php print $get["FirstName"]." ".$get["MiddleName"]." ".$get["LastName"] ?></strong></span>
                        <span>CLASS : <strong><?php print $get["current_class"] ?></strong> </span>
                        <span>NATIONALITY : <strong><?php print  $get["nationality"] ?></strong> </span>
                        <span>EMAIL : <strong><?php print $get["student_email"] ?></strong> </span>
                        <span>CONTACT : <strong><?php print $get["student_contact"] ?></strong> </span>
                        <span>ADDRESS : <strong><?php print $get["house_number"].", ".$get["locality"].", ".$get["state"].", ".$get["city"].", PIN-".$get["zip"]; ?></strong> </span>
                        <span>FATHER NAME : <strong><?php print $get["fatherName"] ?></strong> </span>
                        <span>FATHER CONTACT : <strong><?php print $get["fatherContact"] ?></strong> </span>
                        <span>FATHER EMAIL : <strong><?php print $get["fatherEmail"] ?></strong> </span>
                        <span>MOTHER NAME : <strong><?php print $get["motherName"] ?></strong></span>
                        <span>MOTHER CONTACT : <strong><?php print $get["motherContact"] ?></strong></span>
<?php if($get["guardianName"]){?><span>GUARDIAN NAME :  <strong><?php print $get["guardianName"] ?></strong></span>
                        <span>GUARDIAN CONTACT : <strong><?php print $get["guardianContact"] ?></strong></span><?php }?>
                        <span>FACILITY : <strong><?php print ($f=$get["Facility"])?$f:"NONE" ?></strong></span>
                        <span>DATE OF ADMISSION : <strong><?php print $get["dateOfAdmission"] ?></strong></span>
                        <?php $fetch=$database->getclassfees($get["current_class"])?>
                        <span>TOTAL FEES :  <strong>₹ <?php print $total=$fetch["tution"]+$fetch["sports"]+$fetch["cca"]+$fetch["exam"]+$fetch["special_subject"]+($val=$database->facilityfees($get["Facility"])) ?></strong></span>
                        <span><a href="student_payment_history.php?id=<?php print $_GET["id"]?>&c=<?php print $get["current_class"]?>&f=<?php print $get["Facility"]?>"><button class="btn btn-custom ">PAY HISTORY</button></a></span>
                        <?php  
                        $m=($database->remianingStudentFees($_GET["id"],$get["current_class"],$f))
                        ?>
                        <i>DUE Fees : ₹ <?php print $m[0]+$m[1]+$m[2]+$m[3]+$m[4]+$m[5]?></i>
                        </div>
                        
                    </div>
                    
                    <div class="col-lg-6">
                        <h5>STUDENTS FEE DETAILS HERE</h5>
                    <div id="piechart"></div>
                    </div>
                </div>
           </div>      
                       
        </div>

        </div>
    </div>

<!-- Modal -->
<div id="feesInput" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"> 
       <h4 class="modal-title">PAYMENT FORM</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

      <?php if ($database->checkPendingFees($_GET["id"],$total)){ ?>
      <form method="POST">
    <div class="form-group">
      <label for="email">TUTION FEES :</label>
      <input type="number" min="0" class="form-control" id="tution" max="<?php echo $m[0];?>" placeholder="Dues  <?php echo $m[0];?>" name="tution" required>
    </div>
    
    <div class="form-group">
      <label for="email">SPORTS FEES :</label>
      <input type="number" class="form-control" min="0" id="sports" max="<?php echo $m[1]?>" placeholder="Dues <?php echo $m[1]?> " name="sports" >
    </div><div class="form-group">
      <label for="email">EXTRA CURRICULUM ACTIVITY FEES :</label>
      <input type="number" class="form-control" id="cca-fees" min="0" max="<?php echo $m[2]?>" placeholder="Dues <?php echo $m[2]?> " name="cca-fees">
    </div><div class="form-group">
    <div class="form-group">
      <label for="email">EXAM FEES :</label>
      <input type="number" min="0" class="form-control" id="exam" max="<?php echo $m[3]?>" placeholder="Dues <?php echo $m[3]?> " name="exam" >
    </div>
      <label for="email">SPECIAL SUBJECT FEES :</label>
      <input type="number" class="form-control" id="Special-Sub-fees" min="0" max="<?php echo $m[4]?>" placeholder="Dues <?php echo $m[4]?> " name="Special-Sub-fees">
    </div>
    
    <div class="form-group">
      <label for="email">FACILITY FEES :</label>
      <input type="number" class="form-control" id="facility" placeholder="Dues <?php echo $m[5]?>" name="facility" <?php print ($database->facilityfees($get["Facility"]))?' max="'.$m[5].'"  required':' disabled'?>>
    </div> 
    <button type="submit" name="submit-fees" class="btn btn-success">Submit</button>
      </form><?php }else{?>
          <i>No Pending Fees </i><?php }?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
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

    <script type="text/javascript" src="../../assets/js/loader.js"></script>

    <script type="text/javascript">
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
    ['TOTAL', 'FEES PER SESSION'],
    ['TUTION', <?php print $fetch["tution"]?>],
    ['SPORTS', <?php print $fetch["sports"]?>],
    ['CCA', <?php print $fetch["cca"]?>],
    ['EXAM',<?php print $fetch["exam"]?>],
    ['SPECIAL SUBJECTS', <?php print $fetch["special_subject"]?>],
    ['FACILITY', <?php print $database->facilityfees($get["Facility"])?>]
    ]);

    // Optional; add a title and set the width and height of the chart
    var options = {'title':'Total Fees', 'width':450, 'height':400};

    // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
    }
    </script>

</html>
<?php
       if(isset($_POST["submit-fees"]))
       {
           $tution=strip_tags($_POST["tution"]);
           $exam=strip_tags($_POST["exam"]);
           $sports=strip_tags($_POST["sports"]);
           $cca=strip_tags($_POST["cca-fees"]);
           $spSub=strip_tags($_POST["Special-Sub-fees"]);
           $facility=strip_tags($_POST["facility"]);

           $database->submitFees($_GET["id"],$tution,$exam,$sports,$cca,$spSub,$facility);
            }
  ?>