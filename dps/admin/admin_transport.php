<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../");
?>
<?php include "includes/htmlHead.php"?>

    <title>Transport</title>

<?php include "includes/metaCSSjs.php"?>
<style>
.jumbotron{
  background: #00c6ff;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #7386D5, #0072ff);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #7386D5, #0072ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
color:#ffffff;
}
.btn-custom{
  background-color:#f9f9f9;
}
</style>
    <div class="wrapper">
        <!-- Sidebar Holder -->
       <?php include "includes/sidebar.php" ?>
        <!-- Page Content Holder -->
        <div id="content">
            <?php include "includes/upperNav.php"?>
            <div class="jumbotron"> <a href="#" data-toggle="modal" data-target="#fee"><button class="float-right btn btn-md btn-warning">FEE DETAILS</button></a>
          
            <a href="#" data-toggle="modal" data-target="#add_route">
                <button type="button" style="float:right" class="btn  btn-info">Add Route</button></a>
            <h2>ROUTES</h2></br>
            <div class="table-responsive">
                 <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Srno.</th>
                        <th>Route Name</th>
                        <th>Road 1</th>
                        <th>Road 2</th>
                        <th>Road 3</th>
                        <th>Students</th>
                        <th>Action</th>                       
                      </tr>

                    </thead>
                    <tbody style="text-align: left;">
                     <?php
                      $database->getRouteList();
                      ?>
                    </tbody>
                  </table>  
              </div>  
            
        </div>
        </div>        
    </div>
  <!-- Modal for editing fees content-->  
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
        <label for="feeDetails">TRANSPORT FEES</label>
            <input type="text" class="form-control" id="feeDetails" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  name="feeDetails" value="<?php print $database->facilityfees("TRANSPORT")?>" required>
     </div></br>
<button type="submit" name="change" class="btn btn-success">Submit</button></form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php include "transport/addRoute.php"?>
  <?php include "includes/lowerHtml.php"?>
  
    <?php
    if(isset($_POST["change"])){
        $val=strip_tags($_POST["feeDetails"]);
        $database->changeFacilityFees("TRANSPORT",$val,"admin_transport");
    }
    ?>