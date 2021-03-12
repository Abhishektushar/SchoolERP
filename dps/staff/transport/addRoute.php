<!-- modal to add new Route -->
<div id="add_route" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" align="left">
      <div class="modal-header">
        <h4 class="modal-title">Add a new Route</h4>
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form method="POST">
        <div class="form-group">
	 </div>
     <div class="form-group">
     <label for="routeName">Route Name:</label>
   <input type="text" class="form-control"   id="routeName" name="routeName" maxlength="30" placeholder=""  class="form-control"  required=""/>
        </div>
        <div class="form-group">
     <label for="driverName">Driver Name:</label>
   <input type="text" class="form-control"   id="driverName" name="driverName" maxlength="30" placeholder=""  class="form-control"  required=""/>
        </div>
        <div class="form-group">
     <label for="driverContact">Driver Contact:</label>
   <input type="text" class="form-control"   id="driverContact" name="driverContact" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder=""  class="form-control"  required=""/>
        </div>
        <div class="form-group">
     <label for="road1">Road 1:</label>
   <input type="text" class="form-control"   id="road1" name="road1"  placeholder="" maxlength="25" class="form-control"  required=""/>
        </div>
       <div class="form-group">
     <label for="road2">Road 2:</label>
     <input type="text" class="form-control" id="road2" name="road2"  placeholder="" maxlength="25" class="form-control" required="" />
        </div>
       
        <div class="form-group">
     <label for="road3">Road 3:</label>
     <input type="text" class="form-control" id="road3" name="road3"  placeholder="" maxlength="25" class="form-control"  />
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
$name=strip_tags($_POST['routeName']);
$road1=strip_tags($_POST["road1"]);
$road2=strip_tags($_POST["road2"]);
$road3=strip_tags($_POST["road3"]);
$driverName=strip_tags($_POST["driverName"]);
$driverContact=strip_tags($_POST["driverContact"]);

$staffdatabase->addNewRoute($name,$road1,$road2,$road3,$driverName,$driverContact,$_SESSION["post"]);                           
    }      
?>

