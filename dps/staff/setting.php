<?php 
session_start();
require("../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) ))  
    header("location:../");
?>
<?php include "includes/htmlHead.php";?>
    <title><?php echo $_SESSION['first']." ".$_SESSION['last']?></title>

<?php include "includes/metaCSSjs.php"?>

<style>
    .jumbotron{
        background: #0cebeb;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #29ffc6, #20e3b2, #0cebeb);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #29ffc6, #20e3b2, #0cebeb); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
font-size:18px;
    }
       .fas{
           color:#ffffff;
           margin-bottom:6px;
       }
       .container{
        width: 90%;
        height:auto;
        position: relative;
        align-items: center;
        justify-content: center;    
             }
            svg{
                width:75px;
                height:75px;
            }
        #pending{
            float:right;
            }
</style>
<div class="wrapper">
    <!-- Sidebar Holder -->
        <?php include "includes/sidebar.php"?>
    <!-- Page Content Holder -->
    <div id="content">
        <?php include "includes/upperNav.php"?>
        <div class="container " align="center">
               <div class="jumbotron">
               <form class="form-horizontal" method="POST">
                <div class="form-group">
                <label class="control-label col-sm-5" for="email">CURRENT PASSWORD:</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="currentPwd" placeholder="Current Password" name="currentPwd" required >
                </div>
                </div>
                <div class="form-group">
                <label class="control-label col-sm-5" for="pwd">New Password:</label>
                <div class="col-sm-8">          
                    <input type="password" class="form-control" id="newPwd" placeholder="Enter New Password" name="newPwd" required>
                </div>
                </div>
                <div class="form-group">
                <label class="control-label col-sm-5" for="pwd">Confirm Password:</label>
                <div class="col-sm-8">          
                    <input type="password" class="form-control" id="ConfirmPwd" placeholder="Confirm Password" name="ConfirmPwd" required>
                </div>
                </div>   
                
                <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="submit-changes" class="btn btn-default">Submit</button>
                </div>
                </div>
            </form>
               
               </div>
        </div>
    </div>
</div>
      <?php include "includes/lowerHtml.php"?>

<?php
if(isset($_POST['submit-changes']))
{
    $oldp=$_POST['currentPwd'];
    $newp=$_POST['newPwd'];
    $confP=$_POST['ConfirmPwd'];
    if($newp == $confP){
        $staffdatabase->passwordReset($oldp,$newp,$confP,$_SESSION['staff'],$_SESSION['staffId']);}
    else{
        echo '<script>alert("Both password doesn\'t match");</script>';
    }
}
?>