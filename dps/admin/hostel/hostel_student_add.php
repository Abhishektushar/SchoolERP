<div id="addStudentToHostel" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
 
    <!-- Modal content-->
    <div class="modal-content" align="left">
      <div class="modal-header">
      
        <h5 class="modal-title">Add Student </h5>
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form method="POST">
        <div class="form-group">
     <h4 align="center"><?php $database->getHostelName($_GET['ref']);?></h4>
	 </div></br>

     <div class="form-group">
        <label for="student_val">Select Student from here :</label>
        <select class="form-control"  id="student_val" name="student_val" maxlength="30" placeholder=""  required>
        <?php $database->hostel_studentADD_list($_GET['ref']);?></select>
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
$sid=strip_tags($_POST['student_val']);
$hostel=strip_tags($_GET['ref']);
$database->addStudentToHostel($sid,$hostel);}
?>

