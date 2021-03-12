<?php 
session_start();
require("../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) ))  
    header("location:../");
?>
<?php include "includes/htmlHead.php"?>
    <title>Students List</title>
    <style>
    .jumbotron{
      padding-top:30px !important;
      padding-bottom:15px !important;
      background: #00c6ff;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #0072ff, #00d2ff);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #0072ff, #00d2ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

color: #ffffff;  }
    .search{
      float:right;
      margin-bottom:10px;
    }
    #studentTab{
      style="text-align: left;
    }
    .class-select{
      width:40px;
    }
    table{
      border-collapse: separate;
      border-spacing: 15px;
    }
    tbody {
      display:block;
        height:auto;
        max-height:380px;
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
        font-size: 15px;
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
.dropdown{
  margin-right:20px;
}
.dropdown ul{
  align-items:center;
  text-align:center;
}
    </style>
 <?php include "includes/metaCSSjs.php"?>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php include "includes/sidebar.php"?>
        <!-- Page Content Holder -->
        <div id="content">

       <?php include "includes/upperNav.php"?>
        
           <div class="jumbotron"> 
           <?php echo "ACCESS BY : ".$_SESSION['post'];?>
           <div id="class_"></div>
           
             <h2 style="font-size: 2vw">Students List</h2> 
                <div class="input-group search col-md-4">
                <input type="text" class="form-control"id="searchInput" placeholder="SEARCH NAME....">
              </div>
             <div class="table-responsive">
                 <table class="table table-striped">
                    <thead>
                      <tr>
                        <th width="5%">Sr.</th>
                        <th width="15%">Full Name</th>
                        <th width="10%">Gender</th>
                        <th width="12%">Contact No.</th>
                        <th width="10%">Class</th>
                        <th width="23%">Address</th>
                        <th width="15%">Father's Name</th>
                        <th wisth="12%">Father's Contact</th>
                     </tr>
                    </thead>
                    <tbody id="studentTab">
                     <?php if ((isset($_SESSION['post'])) &&(($_SESSION['post'])==="Lab Assistant") ){
                             $staffdatabase->getStudentListWithClass($_SESSION['staffId']);
                        }
                        elseif((isset($_SESSION['post'])) &&(($_SESSION['post'])==="Teacher")){
                            $staffdatabase->getStudentListWithClass($_SESSION['staffId']);
                        }
                     elseif(isset($_SESSION['post'])){
                      $staffdatabase->getStudentList($_SESSION['post']);}
                        
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
    $("#studentTab tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
