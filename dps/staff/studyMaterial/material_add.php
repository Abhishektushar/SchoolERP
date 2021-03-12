<div id="addMaterial" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" align="left">
      <div class="modal-header">
        <h4 class="modal-title">Add New Material</h4>
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      
       <form method="POST" enctype="multipart/form-data">
       
     <div class="form-group">
     <label for="materialName"> Name</label>
   <input type="text" class="form-control" id="materialName" name="materialName" maxlength="30" placeholder=""  required=""/>
        </div>
        <div class="form-group">
     <label for="subject">Subject</label>
   <input type="text" class="form-control" id="subject" name="subject"  placeholder="" maxlength="25"  required=""/>
        </div>
        <small>file size should be less than <b>1 MB</b></br>Formats allowed are : <strong>'jpg','jpeg','png','pdf','doc','docx' & 'txt'</strong></small>
        </br></br>
    <div class="form-group">
      <label for="file">
        <input type="file" name="file">
      </label><br>
    </div>

       <div class="form-group">
     <label for="typeOf">Type</label>
     <select class="form-control" id="typeOf" name="typeOf"  required>
        <option value=''>---SELECT---</option>
        <option value="Notes">Notes</option>
        <option value="Assignment">Assignment</option>
     </select>
        </div>
       
        <div class="form-group">
        <label for="DOS">Date Of Submission</label>
        <input type="date" class="form-control" id="DOS" name="DOS"  placeholder="">
        </div>
       

      <button type="submit" name="addNew" class="btn btn-success">Submit</button></form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php


if(isset($_POST["addNew"])) 
{    
    $name=$_POST['materialName'];
    $subject=$_POST["subject"];
    $type=$_POST["typeOf"];
    $DOS=$_POST["DOS"];
    $class=$_GET['class'];

    $files=$_FILES['file'];

    $fileName=$_FILES['file']['name'];
    $fileTmpName=$_FILES['file']['tmp_name'];
    $fileSize=$_FILES['file']['size'];
    $fileError=$_FILES['file']['error'];
    $fileType=$_FILES['file']['type'];

    $staffdatabase->addMaterial($fileName, $fileError, $fileSize, $fileTmpName, $name, $subject, $type, $DOS, $class,$_SESSION['post_assigned'])   ;  
}

?>

