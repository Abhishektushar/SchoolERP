<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php
if(!$database->validateEnqID($_GET['eid'])){
  header("location:../");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Notice</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
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
           margin:8px auto;
       }
       textarea{
           min-height:150px;
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
       .user{
        background-color:green;
        font-size:16px;
        padding:2px ;
        font-weight: normal ;
       }
       p{
           color:#272121;
           margin-top:30px !important;
           content:justify;
           text-align: justify;
           text-justify: inter-word;
       }
       .title{
           font-size:20px;
           font-weight:normal;
       }
    </style>
</head>

<body>
<div class="wrapper">
      <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" align="center">
                    <a href="../admin_enquiry.php">
                <button type="button" class="btn btn-default btn-sm">&#8592 Back</button></a>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <h3 style="margin:0  32% !important;text-align: center;">Delhi Public School</h3>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav> 
        
        <div class="container">
        <?php $fetch=($database->EnqID($_GET['eid']))?>
       <?php  $words = explode(" ", $fetch["sender_name"]);
            $acronym = "";
            foreach ($words as $w) {
            $acronym .= $w[0];
            }?>
        <div class="container Box">
           <span class="title">Reason: <?php  print $fetch["enq_title"];?></span> <?php print ( $fetch['resolve']==0)?'<span class="badge badge-info status">UNRESLOVED</span>':'<span class="badge badge-success status">RESLOVED</span>';?>
           
           <span class="type float-right">FROM : <strong><?php print $fetch['sender_type']?></strong></span>  
           <div class="media">
                <div class="media-left user"><?php print strtoupper($acronym)?></div>
                <div class="media-body">
             <h4 class="media-heading"><?php print $fetch["sender_name"]?><span class="float-right"><small>Posted on: <i><?php print $fetch["date_of_enq"]?></i></small></span></h4>
                    <p><?php print $fetch['body']?></p>
      
               <div class="media">
                <div class="media-left admin">A</div>
                  <div class="media-body">
                    <h4 class="media-heading">ADMIN <small><i><?php $database->responseDate($_GET['eid'])?></i></small></h4>
                   <form method="POST"><textarea class="form-control" name="comment-body"><?php print ($body=$fetch['admin_comment'])?$body:" " ?></textarea>
                  <button class="btn btn-info btn-sm float-right" name="post-comment"><?php print ($fetch['resolve']==0)? "POST":"Update";?></button></form></div>
              </div>
            </div></div></div>
        
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
if(isset($_POST["post-comment"]))
{
    $id=strip_tags($_GET['eid']);
    $comment=strip_tags(($_POST['comment-body']));

    $database->updateAdminComment($id,$comment);
}
?>