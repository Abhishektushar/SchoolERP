<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php
  if(!$database->validateStudentID($_GET['id']))
    header("location:../admin_library.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Return Book</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
<style>
.form-box{
  background-color:#7E57C2 !important;
  border-radius:0  0 10px 10px;
  box-shadow:
  0 2.8px 2.2px rgba(0, 0, 0, 0.034),
  0 6.7px 5.3px rgba(0, 0, 0, 0.048),
  0 12.5px 10px rgba(0, 0, 0, 0.06),
  0 22.3px 17.9px rgba(0, 0, 0, 0.072),
  0 41.8px 33.4px rgba(0, 0, 0, 0.086),
  0 100px 80px rgba(0, 0, 0, 0.12)
;
  min-height: 400px;
   height:auto;
   margin: auto;
   padding:2% 0;
   
} 
.element{
  width:77%;
  margin:0 auto;
}
form{
  padding:25px;
}
.box-title{
  background-color:#000000;
  color:#ffffff;
   width:100%;
  min-height:150px;
  border-radius:10px 10px 0 0;
 }
 .box-title h4{
   justify-content:center;
   text-align:center;
   padding-top:50px;

 }
 .box-title button{
   float:right;
 }
 th ,td{
   font-size:0.8rem!important;
 }
.student-details{
  display:block; 
  width:inherit !important;
  
}
.student-details p{
  color:#eee;
  font-size:1rem;
  font-weight: normal;
}
#promp{
  font-weight:normal;
  font-size:18px !important;
  color:#ffffff;
}
.fineInfo{
  width:330px;
  height:150px;
  padding:30px 50px;
  background-color:#e6e6e6;
  border-radius:5px;
  font-size:0.8rem;
}

#confrmPay,#ignoreFine{
  font-weight:bold;
}
#fine{
  display:none;
}
.fineInfo p
{
  color:#000000 !important;
  font-weight:normal;
}
.fineInfo button{
  margin-top:auto;
}
.btn-ignore{
  background-color:#fcdf00;
  }
.btn-pay{
  background-color:#02d14e;
}
#pay-all{
  font-weight:bold;
  border:2px solid #FFC107!important;
}
#pay-all:hover span {
  display:none
}

#pay-all:hover:after {
  content:"PAY & RETURN";
}
#returnlabel{
  color:#ffffff;
  font-size:20px;
}
/* fixing table height */
tbody {
  display:block;
    height:auto;
    overflow:auto;
    max-height:200px;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
thead {
    width: calc( 100% - 1em )/* scrollbar is average 1em/16px width, remove it from thead width */
}
table {
    width:400px;
}

</style>
</head>
<body>
  
    <!-- Page Content Holder -->
  <div class="wrapper">
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" align="center">
          <a href="../admin_library.php">
          <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
          </a><button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
      <div class="element">
            <div class="box-title container">
              <h4>BOOK RETURN</h4>        
            </div>
           
          <div class="form-box container">
              <div class="form-row">
                <div class="container">
                    <div class="form-group row">   
                      <?php $database->getPreviousBookIssueInfo($_GET['id']);?>
                          </div><span class="col-md-1"></span>
                      <?php $database->student_inf($_GET['id'])?>
                    </div>
                   
                    <div class="container" align="center" id="bookReturnForm" class="form-group col-md-6">
                      <div class="form-group col-md-4">             
                      <form method="POST">
                            <label for="Book-return" id="returnlabel">RETURN </label>
                            <?php $database->nonRetrndBookList($_GET["id"]);?>   
                       </form>
                      </div>                    
                    </div>
                   
                 </div>
          </div>
          </div>
      </div>
    </div>
    </div>  
  </div>
          
          <!-- modal for fine removal -->
          <div class="modal fade" id="payFine-confirmation" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title">Remove Fine <?php echo $database->checkpendingFINES(($_GET["id"]))?> /-</h6>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>                
                </div>
                <div class="modal-body">
                  <form method="POST">
                      <div align="center">
                        <button type="submit" name="complete-fine" id="complete-fine" class="btn btn-md btn-success">CONFIRM PAYMENT</button>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
  if(isset($_POST["MakeSubmsn"]))
  {
    $bid=strip_tags($_POST["makeReturn"]);
    $sid=strip_tags($_GET["id"]);
    $database->ReturnThisBook($bid,$sid);
  }
  if(isset($_POST["complete-fine"]))
  {
    $sid=strip_tags($_GET["id"]);
    $database->payAllfine($sid,"book_return.php");
  }
?>