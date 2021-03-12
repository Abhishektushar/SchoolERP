<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../");
?>
<?php include "includes/htmlHead.php"?>

    <title>Enquiry</title>
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
    </style>
<?php include "includes/metaCSSjs.php"?>


    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php include "includes/sidebar.php"?>
        <!-- Page Content Holder -->
        <div id="content">
           <?php include "includes/upperNav.php"?>
          
           <div class="container" align="center"><h3>ENQUIRY</h3></div> 
           <?php $fetch=$database->getEnquiry()?>
        </div>
</div>
    <?php include "includes/lowerHtml.php"?>
