<?php 
session_start();
require("../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) ))  
    header("location:../");
if((isset($_SESSION['post'])) && ($_SESSION['post']!="Warden")){
    header("location:../");
}
?>
<?php include "includes/htmlHead.php"?>
    <title>Hostel</title>
<style type="text/css">

.box-display{
    align:center;
    padding:12% 10%!important; 
    width:280px;
    height:200px
}
.Box{    
            border-radius:10px 10px;
            box-shadow:
            0 2.8px 2.2px rgba(0, 0, 0, 0.034),
            0 6.7px 5.3px rgba(0, 0, 0, 0.048),
            0 12.5px 10px rgba(0, 0, 0, 0.06),
            0 22.3px 17.9px rgba(0, 0, 0, 0.072),
            0 41.8px 33.4px rgba(0, 0, 0, 0.086),
            0 100px 80px rgba(0, 0, 0, 0.12)
            ;
            
            height:200px;
            min-width:220px;
            padding:25% 5%;
            margin: 10px 10px;
            justify-content:center;
            text-align:center;
            color: #ffffff;
            font-size:20px;
       }
       .container{
        align-content:center;
         justify-content: center;
         width: 80% !important;
         margin:10% !important;
       }
       .box1{
           background-color:#ff677d;
       }
       .box2{
           background-color:#fa744f;
       }
       .box3{
           background-color:#43d8c9;
       }
       
       
</style>
<?php include "includes/metaCSSjs.php"?>


    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php include "includes/sidebar.php"?>

        <!-- Page Content Holder -->
        <div id="content" >
            <?php include "includes/upperNav.php"?>
            <a href="#" data-toggle="modal" data-target="#fee"><button class="float-right btn btn-md btn-warning">FEE DETAILS</button></a>
            <div class="container" >
                    <div class="row" >
                            <a href="hostel/hostel_details.php?ref=1">
                                <div class="col-sm-3 box1 Box"><?php $staffdatabase->getHostelName(1,$_SESSION['post'])?></div></a>
                            <a href="hostel/hostel_details.php?ref=2">
                                <div class="col-sm-3 box2 Box"><?php $staffdatabase->getHostelName(2,$_SESSION['post'])?></div></a>
                            <a href="hostel/hostel_details.php?ref=3">
                                <div class="col-sm-3 box3 Box"><?php $staffdatabase->getHostelName(3,$_SESSION['post'])?></div></a>
                    </div>
             </div>         
        </div>        
        </div>
   
    <!-- Modal content-->  
<div id="fee" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
 
    <div class="modal-content" align="left">
      <div class="modal-header">
      
        <h5 class="modal-title">CHANGE FEE STRUCTURE</h5>
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form method="POST">
        <div class="form-group">
        <label for="feeDetails">HOSTEL FEES</label>
            <input type="text" class="form-control" id="feeDetails" name="feeDetails" value="<?php print $staffdatabase->facilityfees("HOSTEL")?>" required>
     </div></br>
<button type="submit" name="change" class="btn btn-success">Submit</button></form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <?php include "includes/lowerHtml.php"?>
    <?php
    if(isset($_POST["change"])){
        $val=strip_tags($_POST["feeDetails"]);
        $staffdatabase->changeFacilityFees("HOSTEL",$val,"Hostel",$_SESSION['post']);
    }
    ?>