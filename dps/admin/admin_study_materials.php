<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../");
?>

<?php require "includes/htmlHead.php"?>
    <title>Study materials</title>
    
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

       }
       h5{
        align-content:center;
         justify-content: center;
         text-align:center;
       }
      .container{
         align-content:center;
         align-items:center;
          justify-content:center;
         width: 60% !important;
         margin: auto;
      }
</style>
<?php include "includes/metaCSSjs.php"?>

    <div class="wrapper">
        <!-- Sidebar Holder -->
            <?php include "includes/sidebar.php"?>
        <!-- Page Content Holder -->
        <div id="content">

            <?php include "includes/upperNav.php"?>
            
            <div >
                <h5>Click on Class To View the study matrials provided</h5><br>
            </div>
            <div class="container" >
                    <div class="row" >
                    <?php
                        for($x=1;$x<13;$x++)
                        {
                            echo '<a href="studyMaterial/class-materials.php?class='.$x.'">';
                             echo  '<div class="col-lg-3  Box">CLASS<br><h4>'.$x.'</h4></div></a>';
                        }
                    ?>
                            <!-- <a href="studyMaterial/class-materials.php?class=7">
                                <div class="col-lg-3  Box">CLASS<br><h4>7</h4></div></a>
                            <a href="studyMaterial/class-materials.php?class=8">
                                <div class="col-lg-3  Box">CLASS<br><h4>8</h4></div></a>
                            <a href="studyMaterial/class-materials.php?class=9">
                                <div class="col-lg-3  Box">CLASS<br><h4>9</h4></div></a>
                    
                            <a href="studyMaterial/class-materials.php?class=10">
                                <div class="col-lg-3  Box">CLASS<br><h4>10</h4></div></a>
                            <a href="studyMaterial/class-materials.php?class=11">
                                <div class="col-lg-3  Box">CLASS<br><h4>11</h4></div></a>
                            <a href="studyMaterial/class-materials.php?class=12">
                                <div class="col-lg-3  Box">CLASS<br><h4>12</h4></div></a> -->
                    </div>
             </div>    
            
        </div>        
    </div>
   
      <?php include "includes/lowerHtml.php"?>