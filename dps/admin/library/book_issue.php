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

    <title>BOOK ISSUE</title>

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

#bookform{
  display:none;
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
          </a>
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
      <div class="element">
            <div class="box-title container">
              <h4>BOOK ALLOT</h4>
               <button class="btn btn-sm btn-warning" id="addnewBook" onclick="showM()">ADD BOOK</button>
            </div>
           
          <div class="form-box container">
              <div class="form-row">
                <div class="container">
                    <div class="form-group row">   
                      <?php $database->getPreviousBookIssueInfo($_GET['id']);?>
                          </div><span class="col-md-1"></span>
                      <?php $database->student_inf($_GET['id'])?>
                    </div>
                    <!-- if student has a pending fine -->
                    <?php if($val=$database->checkpendingFINES(($_GET['id']))){?>
                      <div class="container fineInfo" align="center" id="fine">
                        <p>This student has Pending Fine : <b><?php echo $val ?> /-</b></p>
                        
                        <a href="#" data-toggle="modal" data-target="#ignore-confirmation">
                           <button class="btn btn-ignore" id="ignoreFine">IGNORE</button>
                        </a>
                          <span style="margin-left:50px"></span>
                        
                        <a href="#" data-toggle="modal" data-target="#payFine-confirmation">
                          <button class="btn btn-pay" id="confrmPay" name="confrmPay" >PAY</button>
                        </a>
                    </div><?php 
                      echo"<script>function showM() {
                         var elem = document.getElementById('fine');
                        if (elem.style.display === 'none')
                             elem.style.display = 'block';
                       else 
                          elem.style.display = 'none';}</script>";}else{?>

                    <div class="container" align="center" id="bookform">
                        <form method="POST">
                        <h5 style="color:#ffffff;">&#34; New BOOK Details &#34;</h5>
                        <div class="form-group col-md-6">
                          <label for="studentId"></label>
                            <input type="text" name="studentId" class="form-control" id="studentId" value="Student ID : <?php echo ($_GET['id']);?>" disabled > 
                          <label for=""></label>
                            <input type="text" name="bookid" class="form-control" id="bookid" placeholder="Enter Book ID" required>
                           <label for="current_date"></label>
                            <input type="text" id="current_date" class="form-control" name="current_date" value="Today : <?php $mydate=getdate(date("U")); echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";?>" disabled>
                          <label for="return_days"></label>
                          <input type="date" class="form-control" id="return_date" name="return_date" required>
                        </div>
                        <button type="submit" name="save-details" id="save-details" class="btn btn-success">SUBMIT</button>
                        <span style="margin-left:25px"></span>
                        <button type="button" name="cancel-request" onclick="change()" id="cancel-request" class="btn btn-primary">CANCEL</button>
                      </form>
                    </div><script>
                          function showM() 
                          {
                            var elem = document.getElementById('bookform');
                            elem.style.display =(elem.style.display === 'none')?'block':'none';
                          }
                          function change() //cancel all requests made
                          {
                            location.href="../library/book_issue.php?id=<?php echo($_GET['id'])?>";
                          }                
                        // document.getElementById("addnewBook").remove();
                        // document.getElementById("pay-all").remove();  
                            </script>         
                                   <?php   }

                          if(isset($_POST['proceed-process']))
                          {?>
                            <div class="container" align="center" id="bookform" style="display:block">
                            <form method="POST">
                              <h5 style="color:#ffffff;">&#34; New BOOK Details &#34;</h5>
                              <div class="form-group col-md-6">
                                <label for="studentId"></label>
                                  <input type="text" name="studentId" class="form-control" id="studentId" value="Student ID : <?php echo ($_GET['id']);?>" disabled > 
                                <label for=""></label>
                                  <input type="text" name="bookid" class="form-control" id="bookid" placeholder="Enter Book ID" required>
                                <label for="current_date"></label>
                                  <input type="text" id="current_date" class="form-control" name="current_date" value="Today : <?php $mydate=getdate(date("U")); echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";?>" disabled>
                                <label for="return_days"></label>
                                <input type="date" class="form-control" id="return_date" name="return_date" required>
                              </div>
                              <button type="submit" name="save-details" id="save-details" class="btn btn-success">SUBMIT</button>
                              <span style="margin-left:25px"></span>
                              <button type="button" name="cancel-request" onclick="change()" id="cancel-request" class="btn btn-primary">CANCEL</button>
                            </form>
                            </div>                          
                          <script>              
                            function change(){//cancel all requests made
                              location.href="../library/book_issue.php?id=<?php echo($_GET['id'])?>";
                            }                
                              document.getElementById("addnewBook").remove();
                              document.getElementById("pay-all").remove();
                              
                          </script>
                         <?php }
                          ?>
                 </div>
          </div>
          </div>
      </div>
    </div>
    </div>  
          <!-- modal -->
          <div class="modal fade" id="ignore-confirmation" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content ">
                <div class="modal-header">
                  <h6 class="modal-title">Confirmation Required</h6>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>                
                </div>
                <div class="modal-body">
                  <form method="POST">
                      <div align="center">
                        <button type="submit" name="proceed-process" id="proceed-process" class="btn btn-sm btn-warning" >PROCEED</button>
                        <span style="margin-left:50px"></span>
                        <button type="submit" name="deny-process" id="deny-process" class="btn btn-sm btn-success">DON'T</button>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div> 
          </div>
          
          <!-- modal-2 for fine removal -->
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
    if(isset($_POST["save-details"]))
    {
      $sid=strip_tags($_GET["id"]);
      $bid=strip_tags($_POST["bookid"]);
      $return_date=strip_tags($_POST["return_date"]);

      $database->addbookToStudent($sid,$bid,$return_date);
    }
    if(isset($_POST["complete-fine"]))
    {
      $sid=strip_tags($_GET["id"]);
      $database->payAllfine($sid,"book_issue.php");
    }
  ?>