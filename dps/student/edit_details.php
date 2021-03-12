<?php 
session_start();
require("../base/studentdatabase.php");
if(!isset($_SESSION['studentId']) && !isset($_SESSION['class']) && !isset($_SESSION['facility']) && !isset($_SESSION['student']))  
    header("location:../");
?>
<?php $get=$studentdatabase->myDetails($_SESSION['studentId']);?>
<?php ?>
<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Edit Details</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="assets/js/fontawesome.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a href="myprofile.php">
                       <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
                         </a>
                         <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            
            <h4 class="sub-heading" align="center">Edit Student Details</h4><div class="line"></div>
                    <h5 style="margin:16px"><u>BASIC DETAILS</u> </h5>
            <div class="col-md-4">
                <span><i>Registration number</i> : <strong><?php print $get["student_id"]?></strong>  </span>
            </div>
            
            <form id="studentForm" method="POST">
                <div class="container">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="firstName">First Name</label>
                      <input type="text" class="form-control" maxlength="20" name="firstName" value="<?php print $get["FirstName"] ?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="middleName">Middle Name</label>
                      <input type="text" class="form-control" maxlength="20" name="middleName" value="<?php print $get["MiddleName"] ?>">
                    </div>
                      <div class="form-group col-md-4">
                      <label for="lastName">Last Name</label>
                      <input type="text" class="form-control"maxlength="20" name="lastName" value="<?php print $get["LastName"] ?>">
                    </div>
                  </div>
           
                    <div class="form-row"> <div class="form-group col-md-4">
                      <label for="DOB">Date Of Birth</label>
                      
                      <input type="date" class="form-control" id="DOB" name="DOB" value="<?php print $get['DOB']?>" >
                    </div>
                    
                        <span class="form-group col-md-2"></span>
                        
                <div class="form-group col-md-3">
                
                      <label for="blood_group">Blood Group</label>
                      <select class="form-control" name="blood_group" id="blood_group">
                        <option value="<?php print $get["bloodGrp"]?>"><?php print $get["bloodGrp"]?></option>
                        <option value="A+">A+</option>
                        <option value="B+">B+</option> <option value="O+">O+</option>
                        <option value="AB+">AB+</option> <option value="AB-">AB-</option>
                        <option value="A-">A-</option>  <option value="B-">B-</option>
                        <option value="O-">O-</option>
                      </select>
                </div>
                    </div>
                
                <div class="form-row">
                   <div class="form-group col-md-3">
                      <label for="gender">Gender:</label>
                      <select class="form-control" name="gender" id="gender" >
                        <option value="<?php print $get["gender"]?>"><?php print $get["gender"]?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                      </select>
                </div>
                <span class="form-group col-md-3"></span>
                <div class="form-group col-md-3">
                      <label for="nationality">Nationality:</label>
                      <input type="text" class="form-control" maxlength="15" name="nationality" value="<?php print $get["nationality"]?>"> 
                </div>
                
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3"> 
                        
                     <label for="religion">Religion</label>
                      <input type="text" class="form-control" name="religion" maxlength="10" value="<?php print $get["religion"]?>">  
                    </div>
                    <span class="form-group col-md-3"></span>
                    
                    <div class="form-group col-md-3">   
                      <label for="category">Category:</label>
                      <select class="form-control" name="category" id="category">
                        <option value="<?php print $get["category"]?>"><?php print $get["category"]?></option>
                        <option value="GEN">GEN</option>
                        <option value="OBC">OBC</option>
                        <option value="SC/ST">SC/ST</option>
                      </select>
                </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="student_email">Email</label>
                    <input type="email" class="form-control" maxlength="30" name="student_email" value="<?php print $get["student_email"]?>">
                  </div>
                    
                    <span class="form-group col-md-2"></span>
                    
                    <div class="form-group col-md-4">
                    <label for="student_contact">Conatct Number</label>
                    <input type="text" name="student_contact" class="form-control" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php print $get["student_contact"]?>" >
                  </div>
                </div>
                
            </div>
                
<!--       end of basic detail container        -->
                 
                 <h4 style="margin:16px"><u>ADDRESS</u> </h4>
                
            <div class="container">
                <div class="form-row">
                      <div class="form-group col-md-2">
                        <label for="house_number">House Number</label>
                        <input type="text" class="form-control" maxlength="10" name="house_number" value="<?php print $get["house_number"]?>">
                        </div>
                    <span class="form-group col-md-4"></span>
                        <div class="form-group col-md-4">
                        <label for="locality">Locality</label>
                        <input type="text" class="form-control" maxlength="25" name="locality"  value="<?php print $get["locality"]?>">
                      </div>
                </div>        
                  <div class="form-row">
                       <div class="form-group col-md-3">
                      <label for="state">State</label>
                      <select id="state" name="state" class="form-control">
                               <option value="<?php print $get["state"]?>"><?php print $get["state"]?></option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh </option>
                                <option value="Assam">Assam </option>
                                <option value="Bihar">Bihar </option>
                                <option value="Chhattisgarh">Chhattisgarh </option>
                                <option value="Goa">Goa </option>
                                <option value="Gujarat">Gujarat </option>
                                <option value="Haryana">Haryana </option>
                                <option value="Himachal Pradesh">Himachal Pradesh </option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir </option>
                                <option value="Jharkhand">Jharkhand </option>
                                <option value="Karnataka">Karnataka </option>
                                <option value="Kerala">Kerala </option>
                                <option value="Madhya Pradesh">Madhya Pradesh </option>
                                <option value="Maharashtra">Maharashtra </option>
                                <option value="Manipur">Manipur </option>
                                <option value="Meghalaya">Meghalaya </option>
                                <option value="Mizoram">Mizoram </option>
                                <option value="Nagaland">Nagaland </option>
                                <option value="Odisha">Odisha </option>
                                <option value="Punjab">Punjab </option>
                                <option value="Rajasthan">Rajasthan </option>
                                <option value="Sikkim">Sikkim </option>
                                <option value="Tamil Nadu">Tamil Nadu </option>
                                <option value="Telangana">Telangana </option>
                                <option value="Tripura">Tripura </option>
                                <option value="Uttar Pradesh">Uttar Pradesh </option>
                                <option value="Uttarakhand">Uttarakhand </option>
                                <option value="West Bengal">West Bengal </option>
                                <option value="Andaman and Nicobar">Andaman and Nicobar </option>
                                <option value="Chandigarh">Chandigarh </option>
                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli </option>
                                <option value="Daman and Diu">Daman and Diu </option>
                                <option value="Delhi">Delhi </option>
                                <option value="Lakshadweep">Lakshadweep </option>
                                <option value="Puducherry">Puducherry </option>  
                      </select>
                    </div>
                      
                      
                    <div class="form-group col-md-3">
                      <label for="city">City</label>
                      <input type="text" class="form-control" name="city" maxlength="20" value="<?php print $get["city"]?>">
                    </div>
                   
                    <div class="form-group col-md-3">
                      <label for="zip">Zip</label>
                      <input type="text" name="zip" class="form-control" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php print $get["zip"]?>">
                    </div>
                  </div>
               </div>
                <div class="line"></div>
                <br>
          <h4 style="margin:16px;"><u>PARENT DETAILS</u></h4>
                
                <div class="container">
                    <div class="form-row">
                        <div class="form-group col-md-6 ">
                                
                            <h5 class="form-group col-md-5">Father's Detail</h5>
                    
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control"maxlength="30" value="<?php print $get["fatherName"]?>" name="FatherName">  
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" maxlength="20" name="FatherOccupation" value="<?php print $get["fatherOccupation"]?>">
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" maxlength="10" name="FatherContact" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php print $get["fatherContact"]?>"  >
                            </div>
                            
                            <div class="form-group col-md-9">
                               <input type="email" class="form-control" maxlength="30" value="<?php print $get["fatherEmail"]?>" name="father_email" >
                            </div>
                        
                        </div>
                        
                        
                        <div class="form-group col-md-6">
                            <h5 class="form-group col-md-5">Mother's Detail</h5>
                            
                            <div class="form-group col-md-9">
                               <input type="text" class="form-control" maxlength="20" name="MotherName" value="<?php print $get["motherName"]?>">
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" maxlength="20" name="MotherOccupation" value="<?php print $get["motherOccupation"]?>">
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" name="MotherContact" class="form-control"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php print $get["motherContact"]?>">
                            </div>
                        </div>
              </div>
                    <br>
                    
                <?php if($get['guardianName']){?>
                    
                <div class="form-row">
                    <h5 class="form-group col-md-3">Update Guardian Information</h5>
                </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="GuardianName" maxlength="30" value="<?php print ($get["guardianName"]?$get["guardianName"]:"NULL")?>">
                        </div>
                    </div>  
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <input type="text" class="form-control"name="GuardianOccupation" maxlength="15" value="<?php print ($get["guardianOccupation"]?$get["guardianOccupation"]:"NULL")?>">
                        </div>
                    </div>  
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="text" name="GuardianContact"  class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="10"value="<?php print ($get["guardianContact"]?$get["guardianContact"]:0)?>" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control"  name="guardian_email" maxlength="30" value="<?php print ($get["guardianEmail"]?$get["guardianEmail"]:"NULL")?>" >
                        </div>
                    </div>
                </div><?php }?>
                <div class="line"></div>
                 <br>
                <h4 style="margin:16px;"><u>PREVIOUS EDUCATION DETAILS</u></h4>
                <span style="color:red" ><strong>NOTE: To change content of this Section Please Contact ADMIN</strong></span>
                <div class="container">
                       <div class="form-row">
                        <div class="form-group col-md-3">   
                          <label for="PreviousClass">Previous Class</label>
                          <input class="form-control" id="PreviousClass" value="<?php print $get["previousClass"]?>" disabled>                         
                        </div>
                           <span class="form-group col-md-3"></span>
                           
                           <div class="form-group col-md-3">
                               <label for="PreviousBoard">BOARD</label>
                                   <input type="text" class="form-control" value="<?php print $get["board"]?>" disabled>
                            </div>
                           
                         </div> 
                    <div class="form-row">
                           <div class="form-group col-md-3">
                            <label for="PreviousPercentage">Percentage</label>
                                   <input type="text"  class="form-control"  value="<?php print $get["percentage"]?>" disabled>
                            </div>
                        <span class="form-group col-md-3"></span>
                           <div class="form-group col-md-3">
                            <label for="YearOfPassing">Year Of Passing</label>
                                   <input type="text"  maxlength=4 class="form-control"  value="<?php print $get["YOP"]?>" disabled>
                            </div>
                    </div>
                <br>
                    
                     <h4>Class Aplied For</h4>
                     <div class="form-row">
                        <div class="form-group col-md-3">   
                          <input type="text" id="appliedClass" class="form-control" value="<?php print $get["appliedClass"]?>" disabled>
                        </div>
                    </div>
                </div>
                    <br>
                <div class="line"></div>
                    <h4 style="margin:16px;"><u>EXTRA FACILITY TAKEN</u> </h4>
                <div class="container">
                    <div class="form-row">
                          
                           <div class="form-group col-md-3">
                               <input type="text" class="form-control" value="<?php print $get["Facility"]?>" disabled>
                            </div>
                           
                         </div>
                    <br>
                            <button type="submit" name="submitChanges" class="btn btn-success">Submit</button>
                </div>
                </form>
        </div>
            
    </div>
                            
    </body>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>

    <script type="text/javascript">
     
            $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</html>
<?php
    if(isset($_POST["submitChanges"]))
    {    
        $firstName=preg_replace('/\s+/', '', strip_tags($_POST['firstName'])); 
        $middleName=preg_replace('/\s+/', '', strip_tags($_POST['middleName'])); 
        $lastName=preg_replace('/\s+/', '', strip_tags($_POST['lastName'])); 
      
        
            $DOB=strip_tags($_POST['DOB']);
            $bloodGrp=strip_tags($_POST['blood_group']);
            $gender=strip_tags($_POST['gender']);
            $nationality=strip_tags($_POST['nationality']);
            $religion=strip_tags($_POST['religion']);
            $category=strip_tags($_POST['category']);
        
            $student_email=strip_tags($_POST['student_email']);
            $student_contact=strip_tags($_POST['student_contact']);
        
            $house_number=strip_tags($_POST['house_number']);
            $locality=strip_tags($_POST['locality']);
            $state=strip_tags($_POST['state']);
            $city=strip_tags($_POST['city']);
            $zip=strip_tags($_POST['zip']);
        
            $fatherName=strip_tags($_POST['FatherName']);
            $fatherOccupation=strip_tags($_POST['FatherOccupation']);
            $fatherContact=strip_tags($_POST['FatherContact']);
            $fatherEmail=strip_tags($_POST['father_email']);
        
            $motherName=strip_tags($_POST['MotherName']);
            $motherOccupation=strip_tags($_POST['MotherOccupation']);
            $motherContact=strip_tags($_POST['MotherContact']);
        
            $guardianName=strip_tags($_POST['GuardianName']);
            $guardianContact=strip_tags($_POST['GuardianContact']);
            $guardianOccupation=strip_tags($_POST['GuardianOccupation']);
            $guardianEmail=strip_tags($_POST['guardian_email']);
        
          
                               
            $studentdatabase->updateMyDetails($_SESSION['studentId'],$firstName,$middleName,$lastName,$DOB,$bloodGrp,$gender,$nationality,$religion,$category, $student_email,$student_contact,$house_number,$locality,$state,$city,$zip,$fatherName,$fatherOccupation,$fatherContact,$fatherEmail,$motherName,$motherOccupation,$motherContact,$guardianName,$guardianContact,$guardianOccupation,$guardianEmail);     
  
    }

?>