<?php 
session_start();
require("../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) ))  
    header("location:../");
?>
<?php 
$fetch=$staffdatabase->StaffDetails($_SESSION['staffId']);?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php 
        $staffdatabase->StaffName($_SESSION['staffId']);?></title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="assets/js/fontawesome.js" crossorigin="anonymous"></script>
<style>
.jumbotron{
    background: #2BC0E4;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #EAECC6, #2BC0E4);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #EAECC6, #2BC0E4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
</style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a href="index.php">
                       <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
                        </a><button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                   
                        <h2 style="margin:0 25% 0 35% !important;text-align: center;">Delhi Public School</h2>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </nav> 
            
        <div style="font-size: 1.1rem;">
        <div class='jumbotron'><a href="EditDetails.php"><button class="btn btn-sm btn-warning" style="float:right">EDIT ME</button></a>
                <div class='col-md-4'>Registration id: <?php print $fetch[0]?></div></br>
                <form method='post'>
                    <div class='container'><h5>Basic Details</h5></br>
                        <div class='form-row'>
                            <div class='form-group col-md-4'>Full Name : <b><?php print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];?></b></div>
                            <span class='form-group col-md-5'></span>
                        <div class='form-group col-md-3'>Date Of Birth : <?php print $fetch['DOB'];?></div>
                    </div>

                    <div class='form-row'>
                        <div class='form-group col-md-5'>Email : <?php print $fetch['staff_email'];?></div>
                            <span class='form-group col-md-4'></span>
                        <div class='form-group col-md-3'>Contact : <?php print $fetch['staff_contact'];?></div></br></br>
                        <div class='form-group col-md-2'>Nationality : <?php print $fetch['nationality']; ?></div>
                            <span class='from-group col-md-1'></span>
                        <div class='form-group col-md-2'>Religion : <?php print $fetch['religion']; ?></div>
                        <div class='form-group col-md-2'>Category : <?php print $fetch['category']; ?></div>
                        <div class='form-group col-md-2'>Gender : <?php print $fetch['gender']; ?></div>
                        <div class='form-group col-md-2'>Blood group :<?php print $fetch['bloodGrp']; ?></div>
                    </div></br>
                    
                    <h5>Address</h5
                    ><div class='form-row'>
                        <div class='form-group col-md-2'>House No : <?php print $fetch['house_number']; ?></div>
                        <div class='form-group col-md-3'>Locality: <?php print $fetch['locality']; ?></div>
                        <div class='form-group col-md-2'>City : <?php print $fetch['city']; ?></div>
                        <div class='form-group col-md-3'> State : <?php print $fetch['state']; ?></div>
                        <div class='form-group col-md-2'>Zip : <?php print $fetch['zip']; ?></div>
                    </div></br>
                    
                    <h5>Relation </h5>
                    <div class='form-row'>
                        <div class='form-group col-md-6'><?php print $fetch['relation']." : ".$fetch['relation_name'];?></div>
                    </div>
                </div>
        </div> 
        <div class='jumbotron'>
            <div class='container'><h5>Qualification Details</h5></br>
                    <div class='form-row'>
                        <div class='form-group col-md-5'><h6><b><u>High School Details</u></b></h6>
                            <div class='form-group col-md-12'> Roll Number : <?php print $fetch['highSch_roll']; ?></div>
                            <div class='form-group col-md-12'> BOARD : <?php print $fetch['highSch_Board']; ?></div>
                            <div class='form-group col-md-12'> Major In : <?php print $fetch['highSch_major']; ?></div>
                            <div class='form-group col-md-12'> Aggregate : <?php print $fetch['highSch_aggr']; ?></div>
                            <div class='form-group col-md-12'> Year Of Passing : <?php print $fetch['highSch_YOP']; ?></div>
                        </div>
                            <span class='form-group col-md-3'></span>
                        <div class='form-group col-md-4'><h6><b><u>Graduation Details</u></b></h6>
                            <div class='form-group col-md-12'> Graduation Name : <?php print  $fetch['grad_name']; ?></div>
                            <div class='form-group col-md-12'> Roll Number : <?php print  $fetch['grad_roll']; ?></div>
                            <div class='form-group col-md-12'> University : <?php print  $fetch['grad_university']; ?></div>
                            <div class='form-group col-md-12'> Major : <?php print  $fetch['grad_major']; ?></div>
                            <div class='form-group col-md-12'> Aggregate : <?php print  $fetch['grad_aggr']; ?></div>
                            <div class='form-group col-md-12'> Year Of Passing : <?php print  $fetch['grad_YOP']; ?></div>
                        </div>
                    </div>  
                <?php
            if($fetch['otherQuali_name']!='NULL'){ ?>
                    <div class='form-row'>
                        <div class='form-group col-md-12'><h6><u><b>Other Qualifications Details</b></u></h6>
                            <div class='form-group col-md-12'> Qulalification Name : <?php print  $fetch['otherQuali_name'] ;?></div>
                            <div class='form-group col-md-12'> Roll Number : <?php print  $fetch['otherQuali_roll'] ;?></div>
                            <div class='form-group col-md-12'> University : <?php print  $fetch['otherQuali_university'] ;?></div>
                            <div class='form-group col-md-12'> Major : <?php print  $fetch['otherQuali_major'] ;?></div>
                            <div class='form-group col-md-12'> Aggregate : <?php print  $fetch['otherQuali_aggr'] ;?></div>
                            <div class='form-group col-md-12'> Year Of Passing : <?php print  $fetch['otherQuali_YOP'] ;?></div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
        <div class='jumbotron'>
            <div class='container'><h5>Role In School</h5></br>
                <div class='form-row'>
                    <div class='form-group col-md-3'>Position : <?php print $fetch['position']; ?></div>
                        <span class='form-group col-md-1'></span>   <?php  if($fetch['post_assigned']){    ?>
                    <div class='form-group col-md-3'>Assigned As : <?php print $fetch['post_assigned']; ?></div>
                        <span class='form-group col-md-1'></span>
                    <div class='form-group col-md-4'>Subjects Assigned : <?php print $fetch['subject_assigned']; ?></div>
                        <span class='form-group row-md-0'></span>
                    </div>
                <div class='form-row'>   <?php    if($fetch['class_assigned']){   ?>
                    <div class='form-group col-md-3'>Classes Assigned : <?php print $fetch['class_assigned']; ?></div>
                        <span class='form-group col-md-5'></span>    <?php } } ?>
                    <div class='form-group col-md-4'>Date Of Joining : <?php print $fetch['dateOfJoining']; ?></div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
        
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>

    
</body>

</html>