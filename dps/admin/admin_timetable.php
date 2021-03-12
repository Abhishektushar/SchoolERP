<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
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
           <a href="#" data-toggle="modal" data-target="#addtimetable">
                <button type="button" style="float:right" class="btn btn-sm btn-success">Add Routine </button></a><br><br>
           <h3 align="center"><strong>Time Table</strong></h3>
           
           <strong><p align="center" style="color:#FF0000" id="getMsg"></p></strong>
                <?php $database->getTimeTable()?>
           </div>
        </div>
   </div>
<!---this model is for adding TIme Table--->
 <div id="addtimetable" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" align="left">
      <div class="modal-header">
        <h4 class="modal-title">Add Time Table</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form method="POST" enctype="multipart/form-data">
       
      <div class="form-group">
        <label for="select-class">Class</label>
        <select class="form-control" id="select-class" name="select-class"  required>
            <option value=''>---SELECT---</option>
            <?php
                $database->availableClassToAdd();
                ?>
        </select>
      </div>

    <div class="form-group">
      <label for="file">
        <input type="file"  name="file">
      </label></br><small>file size should be less than <b>1 MB</b>
      </br>Formats allowed are : <strong>'jpg', 'jpeg', 'png'</strong></small></br>
    </div>

      <button type="submit" name="addTable" class="btn btn-success">Submit</button></form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  
<?php
  if(isset($_POST["addTable"])) 
  {    
      $class=$_POST['select-class'];
  
      $file=$_FILES['file'];
  
      $fileName=$_FILES['file']['name'];
      $fileTmpName=$_FILES['file']['tmp_name'];
      $fileSize=$_FILES['file']['size'];
      $fileError=$_FILES['file']['error'];
      $fileType=$_FILES['file']['type'];
                    
      $database->addTimeTable($fileName, $fileError, $fileSize, $fileTmpName,$class);  
  }
?>
  <?php include "includes/lowerHtml.php"?>
 