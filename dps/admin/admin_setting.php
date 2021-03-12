<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../");
?>
<?php include "includes/htmlHead.php"?>
    <title>SETTINGS</title>

<?php include "includes/metaCSSjs.php"?>
<style>
.jumbotron{
    background: #00B4DB;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to left, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to left, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    color:#ffffff; 
}
.input-group{
    width:50%;
    margin:5% auto;
    float:center;
}
.notice{
    color:red;
    margin-bottom:40px !important;
}
.btn-default{
  background-color:#fe346e;
  color:#ffffff;
  font-size:15px;
}

</style>
  <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php include "includes/sidebar.php"?>

        <!-- Page Content Holder -->
        <div id="content">
        <?php include "includes/upperNav.php"?>

        <!-- Start of Page -->
        <div class="jumbotron"  style="width:75%;margin:auto;">
        <h4 align="center">SETTING CHANGE</h4>
            <form method="POST">
                <button type="button" class="float-left btn btn-sm btn-default" data-toggle="modal" data-target="#addnew"> ADD NEW </button>
                     <button type="button" class="float-right btn btn-sm btn-warning" data-toggle="modal" data-target="#check">PERSONAL INFORMATION</button> <br>
                <div class="" align="center">              
                    <div class="input-group">
                    <div class="input-group-append"><select name="usertype" class="form-control" required>
                        <option value="">--SELECT--</option>
                        <option value="STAFF">STAFF</option>
                        <option value="STUDENT">STUDENT</option>
                    </select></div>
                        <input type="text" class="form-control" name="UID" id="UID" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter User ID" required>
                        <div class="input-group-append">
                            <button class="btn btn-success" class="form-control" name="goToID" id="goToID" type="submit">GO</button>
                        </div> 
                    </div>
                 
                        </div>
                    </div>
                </div>
            </form>
           
        </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="check" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Password Required</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <span class="notice">NOTE : Enter the password to proceed further</span>
        <form method="POST">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="pwd" id="pwd" required>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="submit" class="btn btn-primary" name="submit-pwd">SUBMIT</button></form>
      </div>
    </div>
  </div>
</div>

<!-- Modal add-->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-md">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
      <form method="POST">
      <label for="user" >Select Use Type</label>
        <select name="user_type" id="user_type" class="form-control" required>
          <option value="">-SELECT ONE-</option>
          <option value="STUDENT">STUDENT</option>
          <option value="STAFF">STAFF</option>
        </select>

    <label for="users">Member Name</label>
      <select id="users" name="users" class="form-control" required>
          <option value="">-- SELECT -- </option>
      </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addMember" class="btn btn-md btn-primary" >ADD</button></form>
        <?php
          if(isset($_POST['addMember']))
            {
              $userType=strip_tags($_POST['user_type']);
              $userID=strip_tags($_POST['users']);

              $database->giveAccess($userType,$userID);
          
          }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include "includes/lowerHtml.php"?>

<script>
$(document).ready(function () {
    $("#user_type").change(function () {
        var val = $(this).val();
        if (val == "STUDENT") {
            $("#users").html(`<?php $database->getNotAssig_StudentList();?>`);
        } else if (val == "STAFF") {
            $("#users").html(`<?php $database->getNotAssig_StaffList();?>`);
        } else if (val == "") {
            $("#users").html("<option value=''>--SELECT ONE--</option>");
        }
    });
});
</script>

<?php
    if(isset($_POST['submit-pwd']))
    {
        $password=$_POST['pwd'];
        $database->checkAdminPwd($_SESSION['admin'],$password);
    }
    if(isset($_POST['goToID']))
    {
        $userType=strip_tags($_POST['usertype']);
        $userId=strip_tags($_POST['UID']);
        
        $database->checkAndGoTO($userType,$userId);
    }
    
?>