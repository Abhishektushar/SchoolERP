<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../");
?>
<?php include "includes/htmlHead.php"?>   
    <title>Special Notice</title>

<?php include "includes/metaCSSjs.php"?>
<style>
.jumbotron{
    padding:50px 15px;
    background: #c2e59c;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #64b3f4, #c2e59c);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #64b3f4, #c2e59c); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
</style>

    <div class="wrapper">
        <!-- Sidebar Holder -->
         <?php include "includes/sidebar.php"?>

        <!-- Page Content Holder -->
        <div id="content">

            <?php include "includes/upperNav.php"?>

         <div class="container mt-3">
  <h3>Notice Section</h3>
 
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="#notice">Notice</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#pnotice">Previous Notices</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="notice" class="container tab-pane active"><br>
    
      <div style="font-size: 18px;">
                <div class="jumbotron" >
                <form method="POST">
                    <h3 align="center">ADD NOTICE</h3></br>
                    <div class="form-group" style="width:30%">
                        <label for="notice_type">Notice Type:</label>
                        <input type="text" class="form-control" id ="notice_type" name="notice_type" placeholder="Enter type of Notice" required>
                    </div>  
                    <textarea name="notice_body" class="form-control" id="notice_body"  align="center" style="width:75%; margin:0 12.5%" required> Type Your Notice Here!! </textarea>
                    </br>
                    <button tpye="submit" name="addnotice" style="float:right"class="btn btn-success">SUBMIT</button>
                 </form>
                </div>
            </div>

    </div>
    
    <div id="pnotice" class="container tab-pane fade"><br>
        <h3>Previous Notices</h3>
    <?php $database->getAllNotice()?>   
    </div>
    
    </div>
</div>

      <?php include "includes/lowerHtml.php"?>
<script src="../assets/js/ckeditor/ckeditor.js"></script>
<script>
      CKEDITOR.replace('notice_body');
 </script>
<script>
    $(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    });
</script>
<?php
if(isset($_POST["addnotice"])){
    $type=strip_tags($_POST['notice_type']);
    $notice=$_POST['notice_body'];
    
    $database->make_notice($type,$notice);
}
?>
