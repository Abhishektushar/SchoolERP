<?php 
session_start();
require("../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) && (!isset($_SESSION['post']))))  
    header("location:../");

if(isset($_SESSION['post']))
     if(($_SESSION['post'] !="Lab Assistant") && ($_SESSION['post'] !="Teacher") )
            header("location:../");

?>

<?php include "includes/htmlHead.php"?>
<title>Time Table</title>
    

 <?php include "includes/metaCSSjs.php"?>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php include "includes/sidebar.php"?>
        <!-- Page Content Holder -->
        <div id="content">
             <?php include "includes/upperNav.php"?>
           <div class="container">
          
           <h3 align="center"><strong>Time Table</strong></h3>
               <div class="table-responsive">
                    <?php $staffdatabase->getMyClassTimeTable($_SESSION['classes'])?>
               </div>
           </div>
        </div>
   </div>

  <?php include "includes/lowerHtml.php"?>
 