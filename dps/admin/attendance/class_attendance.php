<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php if($_GET["class"]>12 || $_GET["class"]<=0)
    header("location:../");
?>
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
    width:80%;
    margin:auto ;
    padding: 20px;
    background: #2BC0E4;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #EAECC6, #2BC0E4);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #EAECC6, #2BC0E4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.btn{
    margin-left:10px;
}
input{
    height:15px;
    width:15px;
    text-align:center;
    justify-content:center;
    margin:5px;

}
@media only screen and (max-width:996px) {
  table.attend {
    width:400px !important;
    font-size:12px !important;
  }
}
</style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid" align="center">
                        <a href="../admin_attendance.php">
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
            <div class='jumbotron'>  
            <button class="btn float-right btn-sm btn-default" data-toggle="modal" data-target="#attendanceRecord">Attendance Record</button><br><br>
                <h3 align="center"><?php echo "CLASS ".$_GET["class"]?></h3><br>
                <h5><?php echo "CURRENTLY ACCESSED BY : <b>".$_SESSION['admin']."</b>"?></h5>
                <div class="table-responsive">
                <form method="POST">
                 <table class="table table-striped">
                    <thead>
                      <tr>
                        <th width="20%">Student ID</th>
                        <th width="40%">Full Name</th>
                        <th width="40%">MARK</th>
                     </tr>
                    </thead>
                    <tbody >
                <?php ($database->studentAttendanceByClass($_GET["class"]))?>
                </tbody>
                  </table>                    
                 <?php echo (!$database->markedToday(date("Y-m-d",time()),$_GET['class']))? '<button class="btn btn-warning float-right" type="submit" id="attendance_submit" name="attendance_submit">SUBMIT</button>': '<span class="float-right"><b>MARKED TODAY</b></span>'; ?>
                 </form>
              </div>
            </div> 
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="attendanceRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ATTENDANCE RECORD OF <b>CLASS <?php echo $_GET['class']?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-bordered attend">
         <thead class="thead-dark">
            <tr>
                <td>SID</td>
                <td>NAME</td>
                <td>CLASS</td>
                <td>Present Days</td>
                <td>Working Days</td>
                <td>percentage</td>
            </tr>
         </thead>
         <tbody>
        <?php $database->thisClassAttendanceRecord($_GET["class"]);?>
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    if(isset($_POST["attendance_submit"])){
        $student_id=$_POST["student_id"];
        $current_date =date("Y-m-d",time());
        for($count=0; $count < count($student_id); $count++)
        {
            $data=array(
                ':student_id'=>$student_id[$count],
                ':attend_status'=>$_POST["attend_status".$student_id[$count].""],
                ':attendence_date'=>$current_date,
                ':attended_by'=>"ADMIN"
            );
           $database->setAttendence($data[':student_id'],$data[':attend_status'],$data[':attendence_date'],$data[':attended_by'],$_GET['class']);
        }
    }
?>
  