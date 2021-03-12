<?php 
session_start();
require("../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) && (!isset($_SESSION['post']))))  
    header("location:../");

if(isset($_SESSION['post']))
     if(($_SESSION['post'] !="Lab Assistant") && ($_SESSION['post'] !="Teacher") && ($_SESSION['post_assigned'] != "Librarian"))
            header("location:../");
  
?>
<?php include "includes/htmlHead.php"?>   
    <title>Library</title>
<style>
.list{
  margin-top:5%;
  padding:1%;
  border-radius:15px;
  background: #acb6e5;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #86fde8, #acb6e5);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #86fde8, #acb6e5); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
.search_book{
  width:150px;
  float:right;
  margin-right:1%;
  margin-bottom:10px;
}
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
<?php if($_SESSION['post_assigned'] == "Librarian"){?>
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
                <a href="library_/book_add.php"><button type="button" style="float:right" class="btn btn-success">Add Books</button></a>
              </form>
            </div>      
              <div align="center" class="container">   
                   <?php $staffdatabase->getBookBankList($_SESSION['post_assigned'])?>
              </div>
            </div>

    </div>
    
    <div id="book-issues" class="container tab-pane fade"><br>
        <h4>Books Issued</h4>
                 <a href="#" data-toggle="modal" data-target="#issueBook">
                    <button type="button" style="float:right" class="btn btn-success">Book Issue</button>
                    </a></br></br>
                    <div align="center" class="container">   
                      <?php $staffdatabase->getissuedBookList($_SESSION['post_assigned'])?>
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
            <input type="text" class="form-control" id="fineDetails" name="fineDetails" value="<?php print $staffdatabase->getLibFine($_SESSION['post_assigned'])?>" required>
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
    $staffdatabase->checkStudentId($stid,$_SESSION['post_assigned']);
}

if(isset($_POST["search-btn"]))
{
  $sid=strip_tags($_POST["input-student-ID"]);
  $staffdatabase->ReturnBook($sid,$_SESSION['post_assigned']);
}
if(isset($_POST["change"]))
{
  $val=strip_tags($_POST["fineDetails"]);
  $staffdatabase->updateLibFine($val,$_SESSION['post_assigned']);
}
if(isset($_POST["update-every-fine"]))
{
  $staffdatabase->updateEveryStudentFine($_SESSION['post_assigned']);
}
?>
<?php }else{?>
<div class="container list">
<div class="search_book">
<input type="text" class="form-control" id="searchInput" placeholder="SEARCH NAME...."></div>
              
  <h5 align="center">Library All Available Books</h5>
    <?php   $staffdatabase->getAllBookList()?>
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

$(document).ready(function(){
  $("#searchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#bookTab tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</body>
</html>

<?php }?>