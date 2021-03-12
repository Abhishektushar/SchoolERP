<!-- modal for adding student -->
<div id="add_student" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" align="left">
      <div class="modal-header">
      
        <h4 class="modal-title">Add Student To This Route</h4>
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form method="POST">
        <div class="form-group">
     <label for="Rote name"></label>
     <?php print $staffdatabase->routeName($_GET['id']);?>
	 </div>

     <div class="form-group">
        <label for="student_val">Select Student :</label>
        <select class="form-control"  id="student_val" name="student_val" maxlength="30" placeholder=""  required>
        <?php $staffdatabase->transport_studentADD_list($_SESSION["post"]);?></select>
      </div>
      <button type="submit" name="add_Student" class="btn btn-success">Submit</button></form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php

if(isset($_POST["add_Student"])) 
{    
$name=strip_tags($_POST['student_val']);
$route=strip_tags($_GET['id']);
$staffdatabase->addStudentToRoute($name,$route,$_SESSION["post"]);}
?>

