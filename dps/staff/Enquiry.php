<?php 
session_start();
require("../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) ))  
    header("location:../");
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Enquiry</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="assets/js/fontawesome.js" crossorigin="anonymous"></script>

    <style>
    .Box{    
            border-radius:10px 10px;
            background-color:#f7f7f7;
            box-shadow:
            0 2.8px 2.2px rgba(0, 0, 0, 0.034),
            0 6.7px 5.3px rgba(0, 0, 0, 0.048),
            0 12.5px 10px rgba(0, 0, 0, 0.06),
            0 22.3px 17.9px rgba(0, 0, 0, 0.072),
            0 41.8px 33.4px rgba(0, 0, 0, 0.086),
            0 100px 80px rgba(0, 0, 0, 0.12);            
            height:auto;
            /* max-height:300px; */
            min-width:220px;
            padding:5%;
            margin: 10px 20px;
            font-size:14px;
       }
       .status{
           margin-left:15px;
       }
      
       .btn{
           display:inline-block;
  position:relative;
       }
       .type{
           margin-left:35px;
       }
       .admin,.user{
           width:30px;
           height:30px;
           padding:1px ;
           border-radius:50%;
           background-color:red;
           text-align:center;
           align-items:center;
           justify-content:center;
           font-size:18px;
           margin-right:10px;
           color:#ffffff;
           font-weight: bold;
       }
       input{
            margin: 10px auto;

       }
       .user{
        background-color:green;
        font-size:16px;
        padding:2px ;
        font-weight: normal ;
       }
       .title{
           font-size:16px;
           font-weight:normal;
       }
       #new{
           display:flex;
           margin-bottom:10% !important;
            float:right;
       }
       .msg{
           text-align:center;
           justify-content:center;
           font-size:16px;
       }
</style>

</head>

<body>
<div class="wrapper">
      <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" align="center">
                    <a href="index.php">
                <button type="button" class="btn btn-default btn-sm">&#8592 Back</button></a>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <h3 style="margin:0  31% !important;text-align: center;font-size:4.5vh">Delhi Public School</h3>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav> 
            
        <div class ="container " >
       
            <div id="new" ><button type="button" class=" btn btn-md btn-primary" data-toggle="modal" data-target="#newEnquiry" >New Enquiry</button></div>
            <h4 align="center">My Enquires</h4>
            <?php 
            $staffdatabase->myEnquiries($_SESSION['staffId'],$_SESSION['staff']);
            ?>
        </div>
      </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="newEnquiry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">
    <div class="form-group">
    <p>Note:This Enquiry will be visible to ADMIN</p>
      <label for="comment">Add Enquiry Below:</label>
      <input type="text" name="title" class="form-control" placeholder="TITLE HERE" required/>
      <textarea class="form-control" name="Body" rows="5" id="comment" required>Here....</textarea>
    </div>
    <button type="submit" name="addBody" class="btn btn-sm btn-success float-right">SUBMIT</button>
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
       <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    </body>
 
</html>
<?php
if(isset($_POST['resolve'])){
    $eid=strip_tags($_POST["enquiry_info"]);
    $senderType=$_SESSION['staff'];
    $senderId=$_SESSION['staffId'];

    $staffdatabase->MarkEnquiryResolved($eid,$senderType,$senderId);
}

if(isset($_POST['addBody']))
{
    $title=strip_tags($_POST['title']);
    $body=strip_tags($_POST['Body']);
    $senderType=$_SESSION['staff'];
    $senderId=$_SESSION['staffId'];
    $name=$_SESSION['first']." ".$_SESSION['last'];

    $staffdatabase->addThisEnquiry($title,$body,$senderType,$senderId,$name);
}
?>