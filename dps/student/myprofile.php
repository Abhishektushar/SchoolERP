<?php 
session_start();
require("../base/studentdatabase.php");
if(!isset($_SESSION['studentId']) && !isset($_SESSION['class']) && !isset($_SESSION['facility']) && !isset($_SESSION['student']))  
    header("location:../");
?>
<?php $fetch=$studentdatabase->myDetails($_SESSION['studentId']);?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php $studentdatabase->myName($_SESSION['studentId']);?></title>

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
            
        <div style="font-size: 16px;">
            
            <div class='jumbotron'>
             <a href="edit_details.php"><button class="btn btn-md btn-warning" style="float:right">EDIT</button></a>
            <div class='col-md-4'>Registration id: <?php print $fetch['student_id']; ?></div> </br>
            <form method='post'>
                <div class='container'>
                    <h5>Basic Details</h5></br>
                        <div class='form-row'>
                            <div class='form-group col-md-4'>Full Name : <b><?php print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName']; ?></b></div>
                            <span class='form-group col-md-5'></span><div class='form-group col-md-3'>Date Of Birth : <?php print $fetch['DOB'] ?></div>
                </div>
            <div class='form-row'>
                <div class='form-group col-md-2'>Gender : <u><?php print $fetch['gender'];?></u></div>
                    <span class='form-group col-md-1'></span>
                <div class='form-group col-md-2'>Nationality : <u><?php print $fetch['nationality'];?></u></div>
                    <span class='form-group col-md-1'></span>
                <div class='form-group col-md-2'>Religion : <?php print $fetch['religion'];?></div>
                    <span class='form-group col-md-1'></span>
                <div class='form-group col-md-2'>Category : <?php print $fetch['category']; ?></div>
            </div>
            <div class='form-row'>
                <div class='form-group col-md-2'>Blood Group : <?php print $fetch['bloodGrp'];?></div>
                    <span class='form-group col-md-1'></span>
                <div class='form-group col-md-5'>Student Email : <?php print $fetch['student_email']; ?> </div>
                    <span class='form-group col-md-1'></span>
                <div class='form-group col-md-3'>Student contact : <?php print $fetch['student_contact'];?></div>
            </div></br>

        <h5>Address</h5></br>
            <div class='form-row'>
                <div class='form-group col-md-2'>House No : <?php print $fetch['house_number']; ?></div>
                    <span class='form-group col-md-0.5'></span>
                <div class='form-group col-md-2'>Locality : <?php print $fetch['locality']; ?></div>
                    <span class='form-group col-md-0.5'></span>
                <div class='form-group col-md-2'>City : <?php print $fetch['city'] ?></div>
                    <span class='form-group col-md-0.5'></span>
                <div class='form-group col-md-3'>State : <?php print $fetch['state']; ?></div>
                    <span class='form-group col-md-0.5'></span>
                <div class='form-group col-md-2'>PIN : <?php print $fetch['zip']?></div>
            </div>
        </div></br>
        </div>
            
        <div class='jumbotron'>
            <div class='container'>
                <div class='form-row'> 
                    <div class='form-group col-md-6'>

                        <div class='form-group col-md-12'><h5>Father Details</h5></div>
                        <div class='form-group col-md-12'>Father's Name : <?php print $fetch['fatherName']; ?> </div>
                        <div class='form-group col-md-12'>Father's Occupation : <?php print $fetch['fatherOccupation']; ?></div>
                        <div class='form-group col-md-12'>Father's Contact : <?php print $fetch['fatherContact'] ;?></div>
                        <div class='form-group col-md-12'>Father's mail: <?php print $fetch['fatherEmail'];?></div>

                    </div>
        
                    <div class='form-group col-md-6'>
                        <div class='form-group col-md-12'><h5>Mother Details</h5></div>
                        <div class='form-group col-md-12'>Mother's Name :<?php print $fetch['motherName']; ?></div>
                        <div class='form-group col-md-12'>Mother's Occupation : <?php print $fetch['motherOccupation'];?></div>
                        <div class='form-group col-md-12'>Mother's Contact : <?php print $fetch['motherContact']; ?> </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php  if($fetch['guardianName'] !="NULL"){  ?>

        <div class='jumbotron'>
            <div class='container'>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <div class='form-group col-md-12'><h5>Guardian Details</h5></div>
                        <div class='form-group col-md-12'>Guardian's Name : <?php print $fetch['guardianName'];?></div>
                        <div class='form-group col-md-12'>Guardian's Occupation : <?php print $fetch['guardianOccupation']; ?></div>
                        <div class='form-group col-md-12'>Guardian's Contact : <?php print $fetch['guardianContact'] ;?></div>
                        <div class='form-group col-md-12'>Guardian's mail: <?php print $fetch['guardianEmail'] ;?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class='jumbotron'>
            <div class='container'><h5>Educational Background</h5></br>
                <div class='form-row'>
                    <div class='form-group col-md-2'>Previous Class : <?php print $fetch['previousClass'];?> </div>
                        <span class='form-group col-md-1'></span>
                    <div class='form-group col-md-2'>Board : <?php print $fetch['board']; ?></div>
                        <span class='form-group col-md-1'></span>
                    <div class='form-group col-md-2'>Percentage : <?php print $fetch['percentage']; ?> &#37;</div>
                        <span class='form-group col-md-1'></span>
                    <div class='form-group col-md-3'>year Of Passing : <?php print $fetch['YOP']; ?></div>
                </div>
                    </br>
                <h5>Applied For </h5>
                <div class='form-row'>
                    <div class='form-group col-md-2'> Class : <?php print $fetch['appliedClass']; ?></div>
                        <span class= "form-group col-md-2"></span>
                    <div class='form-group col-md-2'>Present Class : <?php print $fetch['current_class']; ?></div>
                         <span class= "form-group col-md-2"></span>
                    <div class="form-group col-md-4"> Date of Admission : <?php print $fetch['dateOfAdmission']; ?></div>
                </div><br>
                <div class="form-row" >
                    <div class='form-group col-md-12'>
                        <h5>EXTRA FACILITY TAKEN:</h5>Facility : <?php print $fetch["Facility"]; ?>
                    </div>
                </div>
            </div>
        </div>
        </form>             
            </div> 
            
        </div>
       
        
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>

    
</body>

</html>