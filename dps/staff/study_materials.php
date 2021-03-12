<?php 
session_start();
require("../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) && (!isset($_SESSION['post_assigned']))))  
    header("location:../");
?>
<?php
    if(isset($_SESSION['post_assigned']))
        if($_SESSION['post_assigned']!="Asst. Teacher")
        header("location:../");
?>
<?php include "includes/htmlHead.php";?>
    <title><?php echo $_SESSION['first']." ".$_SESSION['last']?></title>

<?php include "includes/metaCSSjs.php"?>
<style>
    .Box{
            background-color:#43d8c9 ;
            border-radius:10px 10px;
            box-shadow:
            0 2.8px 2.2px rgba(0, 0, 0, 0.034),
            0 6.7px 5.3px rgba(0, 0, 0, 0.048),
            0 12.5px 10px rgba(0, 0, 0, 0.06),
            0 22.3px 17.9px rgba(0, 0, 0, 0.072),
            0 41.8px 33.4px rgba(0, 0, 0, 0.086),
            0 100px 80px rgba(0, 0, 0, 0.12)
            ;
            
            height:100px;
            min-width:100px;
            padding:10%;
            margin: 20px;
            justify-content:center;
            text-align:center;
            color: #ffffff;
            font-size:18px;
       }
      .container{
         align-content:center;
         justify-content: center;
         width: 50% !important;
         margin: auto;
      }
      .row{
          margin-top:15%;
          align-items:center;
          justify-content:center;
      }
</style>
<div class="wrapper">
    <!-- Sidebar Holder -->
        <?php include "includes/sidebar.php"?>
    <!-- Page Content Holder -->
    <div id="content">
        <?php include "includes/upperNav.php"?>
        <div class="container " align="center">
                <div class="row" >
                <?php
                $x =explode(",",$_SESSION['classes']);
                foreach ($x as $y) {
                    echo '<a href="studyMaterial/class-materials.php?class='.$y.'"><div class="col-lg-3  Box"> CLASS <br><h4>'.$y.'</h4></div></a>';
                    
                }
            ?>                                      
                </div>
        </div>
    </div>
</div>
      <?php include "includes/lowerHtml.php"?>
