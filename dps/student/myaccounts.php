<?php 
session_start();
require("../base/studentdatabase.php");
if(!isset($_SESSION['studentId']) && !isset($_SESSION['class']) && !isset($_SESSION['facility']) && !isset($_SESSION['student']))  
    header("location:../");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo "My Accounts Info" ?></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="assets/js/fontawesome.js" crossorigin="anonymous"></script>

<style>
table{
    font-size:14px;
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
#information{
    font-size:16px;
    float: left;
}
.container,#piechart{
    margin-top:25px;
}

#information span{
    display:block;
}
#information strong{
    padding-left:15px;
}
.btn{
    float:right;
}
svg{
    width:100%;
}

</style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid" align="center">
                        <a href="index.php">
                       <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
                        </a>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                        <h2 style="margin:0  31.5% !important;text-align: center;">Delhi Public School</h2>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </nav> 
            
        <div class="jumbotron" style="width : 80%;margin: auto">
            <h4 align="center"><u><?php $studentdatabase->myName($_SESSION['studentId']) ?></u></h4>
           <div class="container" align="center" >
                     <h5>STUDENT PAYMENT HISTORY</h5>
                    <div class="container" id="information">
                        <div class="col-md-12">
                        <?php $studentdatabase->myPayments($_SESSION['studentId'])?>
                        </div>
                    </div>
                
                    <div class="container" align="center">
                        <h5>STUDENTS PENDING FEES</h5>
                        <?php  
                        $fetch=($studentdatabase->myDues($_SESSION['studentId'],$_SESSION['class'],$_SESSION['facility']))
                        ?>
                        <i>DUE Fees : ₹ <?php print $fetch[0]+$fetch[1]+$fetch[2]+$fetch[3]+$fetch[4]+$fetch[5]?></i>

                        <div id="piechart"></div>
                    </div>
                
           </div>      
                       
        </div>

        </div>
    </div>

      </body>     
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>

    <script type="text/javascript" src="../assets/js/loader.js"></script>

    <script type="text/javascript">
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
    ['TOTAL', 'FEES PER SESSION'],
    ['TUTION', <?php print $fetch[0]?>],
    ['SPORTS', <?php print $fetch[1]?>],
    ['CCA', <?php print $fetch[2]?>],
    ['EXAM',<?php print $fetch[3]?>],
    ['SPECIAL SUBJECTS', <?php print $fetch[4]?>],
    ['<?php echo $_SESSION['facility']?>', <?php print $fetch[5]?>]
    ]);

    // Optional; add a title and set the width and height of the chart
    var options = {'title':'Total Remaining Fees', 'width':500, 'height':400};

    // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
    }
    </script>

</html>
