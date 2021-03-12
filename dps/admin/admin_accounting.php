<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../");
?>
<?php include "includes/htmlHead.php"?>
            <title>Accounts Information</title>
<?php include "includes/metaCSSjs.php"?>
<style>
.jumbotron{
    background: #00B4DB;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    color:#ffffff; 
}
.input-group{
    width:70%;
    margin:2% auto;
    float:center;
}
#edit{
    margin-bottom:2%;
}
.container{
    margin:2% auto;
}

</style>
    <div class="wrapper">
        <!-- Sidebar Holder -->
            <?php include "includes/sidebar.php"?>

        <!-- Page Content Holder -->
       
        <div id="content">

        <?php include "includes/upperNav.php"?>

        <div class="jumbotron" align="center" style="width:75%;margin:auto;">
        <h4 align="center">ACCOUNTING DETAILS</h4>

            <div class="container"><a href="account/fee_structure.php">
            <button type="button"  id="edit" class="btn btn-warning btn-md float-right">Edit Fees</button> </a>
            </div>
                <br><br>
           <span id='err'></span>
            <form method="POST">
                <div class="container">
                <label for="class">View Class wise</label>
                     <div class="input-group"> 
                              <select class="form-control" id="class" name="class" >
                                <option value="">---Select Class---</option><?php $i=1;while($i<=12){
                                            echo"<option value='".$i."'>".$i."</option>";$i++;}?>   
                           </select>  
                        <div class="input-group-append">
                            <button class="btn btn-success" class="form-control" name="class-search-btn" type="submit">SEARCH</button>
                        </div> 
                    </div>                         
                   
                    <label for="">Student wise:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="studentID" id="studentID" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter Student ID" >
                        <div class="input-group-append">
                            <button class="btn btn-success" class="form-control" name="search-btn" id="search-btn" type="submit">SEARCH</button>
                        </div> 
                    </div>
                 
                        </div>
                    </div>
                </div>
            </form>

        </div>                 
        </div>
    </div>

<?php include "includes/lowerHtml.php"?>
<?php
    if(isset($_POST["class-search-btn"])){
        if(!empty($_POST["class"])){
            $class=strip_tags($_POST["class"]);
            $database->getclass($class);
        }else{
            echo"<script>alert('Select Input !!!')</script>";
        }
    }
    if(isset($_POST["search-btn"])){
        if(!empty($_POST["studentID"])){
            $stdID=strip_tags($_POST["studentID"]);
            $database->studentView($stdID);
        }else{
            echo"<script>alert('Enter ID please !!!')</script>";
        }
    }
?>