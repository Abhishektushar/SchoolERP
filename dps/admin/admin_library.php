<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../");
?>
<?php include "includes/htmlHead.php"?>   
    <title>Library</title>
<style>
.search-stbox
{
  width:auto;
  height: 200px;
  background-color:#3f3f44;
  border-radius:10px;
  padding: 5%;
}
.input-group {
    width:30% !important;
    justify-content:center;
    align-items:center;
    position:absolute;
   }
.btn-custom{
  background-color:#0779e4;
  color:#ffffff;
}
.btn-cst{
  background-color:#00a1ab;
  color:#ffffff;
}
.upr{
  margin-bottom:25px;
}
table{
  border-collapse: separate;
  border-spacing: 15px;
}
 tbody {
  display:block;
    height:auto;
    overflow:auto;
    max-height:320px;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
thead {
    width: calc( 100% - 1em )/* scrollbar is average 1em/16px width, remove it from thead width */
}
@media screen and (min-width: 750px) {
 tr {
    font-size: 14px;
  }

}

@media screen and (max-width: 749px) {
 tr {
    font-size: 12px;
  }
  table{
  border-collapse: separate;
  border-spacing:5px 15px;
}
}
</style>
<?php include "includes/metaCSSjs.php"?>
    <div class="wrapper">
        <!-- Sidebar Holder -->
         <?php include "includes/sidebar.php"?>

        <!-- Page Content Holder -->
        <div id="content">

            <?php include "includes/upperNav.php"?>

         <div class="container md-3">
 <a href="#" data-toggle="modal" data-target="#fine-Define"><button class="btn float-right btn-custom">MANAGE FINE</button></a>
  <h3 align="center">Library Section</h3>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="#book-bank-list">Book Bank</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#book-issues">Book Issues</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#book-return">Book Return</a>
    </li>
  </ul>
  
  <!-- Tab panes -->
  <div class="tab-content">
    <div id="book-bank-list" class="container tab-pane active"><br>
    
      <div style="font-size: 14px;">
            <h4>Book Bank List</h4><br>
            <div class="container upr">
              <form  method="POST"><button class="btn btn-cst float-left" name="update-every-fine">Update fine</button>
                <span><small>Click on this Button to update fines</small></span>
                <a href="library/book_add.php"><button type="button" style="float:right" class="btn btn-success">Add Books</button></a>
              </form>
            </div>      
              <div align="center" class="container">   
                   <?php $database->getBookBankList()?>
              </div>
            </div>

    </div>
    
    <div id="book-issues" class="container tab-pane fade"><br>
        <h4>Books Issued</h4>
                 <a href="#" data-toggle="modal" data-target="#issueBook">
                    <button type="button" style="float:right" class="btn btn-success">Book Issue</button>
                    </a></br></br>
                    <div align="center" class="container">   
                      <?php $database->getissuedBookList()?>
                   </div>  
        
    </div>
    
    <div id="book-return" class="container tab-pane fade"><br>
        <h4>Book Returns</h4></br>
       <div class="container" align="center">
           <div class="container search-stbox">
            <form method="POST">
            <div class="input-group">
              <input type="text" class="form-control boxfor" name="input-student-ID" id="input-student-ID" placeholder="Enter Student ID" required>
              <div class="input-group-append">
                <button class="btn btn-warning" class="form-control boxfor" name="search-btn" id="search-btn" type="submit">SEARCH</button>
              </div> 
            </div>
            </form>
           </div>
       </div>
    </div>
    </div>
</div>
</div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="issueBook" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Enter Student Id</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
          <form method="POST">
          
              <div>
                <input type="text" name="stId" id="stId" class="form-control" placeholder="STUDENT ID" required>
                <br>
                <button type="submit" name="stud-ID" id="stud-ID" class="btn btn-sm btn-warning">GO</button>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div> 
  </div>

   <!-- Modal content-->  
<div id="fine-Define" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
 
    <div class="modal-content" align="left">
      <div class="modal-header">
      
        <h5 class="modal-title">CHANGE DAILY FINE</h5>
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form method="POST">
        <div class="form-group">
        <label for="fineDetails">FINE IMPOSED ON DAILY BASIS</label>
            <input type="text" class="form-control" id="fineDetails" name="fineDetails" value="<?php print $database->getLibFine()?>" required>
     </div></br>
<button type="submit" name="change" class="btn btn-success">Submit</button></form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  <!-- check from here -->
     <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

    $(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    });
    // tooltip
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body>
</html>
<?php
if(isset($_POST["stud-ID"]))
{
    $stid=strip_tags($_POST['stId']);
    $database->checkStudentId($stid);
}

if(isset($_POST["search-btn"]))
{
  $sid=strip_tags($_POST["input-student-ID"]);
  $database->ReturnBook($sid);
}
if(isset($_POST["change"]))
{
  $val=strip_tags($_POST["fineDetails"]);
  $database->updateLibFine($val);
}
if(isset($_POST["update-every-fine"]))
{
  $database->updateEveryStudentFine();
}
?>
