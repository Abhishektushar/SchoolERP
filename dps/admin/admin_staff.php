<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../");
?>

<?php include "includes/htmlHead.php"?>

    <title>Staff List</title>

 <?php include "includes/metaCSSjs.php"?>
<style>
#staffTab
{
  text-align: left;
}
.jumbotron{
      padding-top:30px !important;
      padding-bottom:15px !important;
      background: #4CA1AF;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #C4E0E5, #4CA1AF);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #C4E0E5, #4CA1AF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }
    .col-md-4{
      float:right;
      margin-bottom:10px;
    }
    tr{
      border-collapse: separate;
      border-spacing: 15px;
    }
    tbody {
      display:block;
        height:auto;
        overflow:auto;
        max-height:380px;
    }
    
    thead, tbody tr {
        display:table;
        width:100% !important;
        table-layout:fixed;/* even columns width , fix width of table too*/
    }
   
    @media screen and (min-width: 750px) {
    tr {
        font-size: 15px;
      }

    }

@media screen and (max-width: 749px) {
 tr {
    font-size: 12px;
  }
  table tr{
  border-collapse: separate;
  border-spacing:5px 15px;
}
}
</style>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php include "includes/sidebar.php"?>
        <!-- Page Content Holder -->
        <div id="content">

       <?php include "includes/upperNav.php"?>
        
        <div class="jumbotron">
             <h2 style="font-size: 2vw">Staff List</h2> 
             <span><i>click on staff  name to view details</i></span>
             <div class="input-group col-md-4">
                <input type="text" class="form-control"id="searchInput" placeholder="SEARCH....">
                
              </div>
             <div class="table-responsive">
                 <table class="table table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th width="10%">Srno.</th>
                        <th>Full Name</th>
                        <th>Post</th>
                        <th>Contact No.</th>
                        <th>Address</th>
                        <th>Email</th>
                      </tr>
                    </thead>

                    <tbody id="staffTable" width=100%>
                     <?php
                      $database->getStaffList();
                      ?>
                    </tbody>
                    
                  </table>  
            </div>
        </div>
</div>  
      <?php include "includes/lowerHtml.php"?>
<script>
$(document).ready(function(){
  $("#searchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#staffTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>