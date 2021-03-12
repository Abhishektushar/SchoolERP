<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");  
?>
<?php include "handle/studentEntry.php"?>
<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add Student</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
    <style>
  .required:after {
    content:" *";
    color: red;
  }
</style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
          <?php include "sidebar.php"?>

        <!-- Page Content Holder -->
        <div id="content">
            <?php include "upperNav.php"?>
            
            <h3 class="sub-heading">Student Admission</h3><div class="line"></div>
            
                    <h4 style="margin:16px"><u>BASIC DETAILS</u> </h4>
            <div class="col-md-4">
                <p>Registration number : <span style="color:#000;font-weight:normal"><?php $database->getRegistrationNum();?></span></p>
            </div>
            
            <form id="studentForm" method="POST">
                <div class="container">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="firstName" class="required">First Name</label>
                      <input type="text" class="form-control" id="firstName" name="firstName"  required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="middleName">Middle Name</label>
                      <input type="text" class="form-control" id="middleName" name="middleName" >
                    </div>
                      <div class="form-group col-md-4">
                      <label for="lastName" class="required">Last Name</label>
                      <input type="text" class="form-control" id="lastName" name="lastName"  required>
                    </div>
                  </div>
           
                    <div class="form-row"> <div class="form-group col-md-4">
                      <label for="DOB" class="required">Date Of Birth</label>
                      <input type="date" class="form-control" id="DOB" name="DOB" placeholder="" required>
                    </div>
                    
                        <span class="form-group col-md-2"></span>
                        
                <div class="form-group col-md-3">
                      <label for="blood_group" class="required">Blood Group</label>
                      <select class="form-control" name="blood_group" id="blood_group" required>
                        <option value="">---Select---</option>
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
                      <label for="gender" class="required">Gender:</label>
                      <select class="form-control" name="gender" id="gender" required>
                        <option value="">---Select---</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                      </select>
                </div>
                <span class="form-group col-md-3"></span>
                <div class="form-group col-md-3">
                      <label for="nationality" class="required">Nationality:</label>
                      <input type="text" class="form-control" id="nationality" name="nationality" placeholder="" required> 
                </div>
                
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3"> 
                        
                     <label for="religion" class="required">Religion</label>
                      <input type="text" class="form-control" id="religion" name="religion" required>  
                    </div>
                    <span class="form-group col-md-3"></span>
                    
                    <div class="form-group col-md-3">   
                      <label for="category" class="required">Category:</label>
                      <select class="form-control" name="category" id="category" required>
                        <option value="">---Select---</option>
                        <option value="GEN">GEN</option>
                        <option value="OBC">OBC</option>
                        <option value="SC/ST">SC/ST</option>
                      </select>
                </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="student_email" class="required">Email</label>
                    <input type="email" class="form-control" id="student_email" name="student_email" placeholder="example@domain.com" required>
                  </div>
                    
                    <span class="form-group col-md-2"></span>
                    
                    <div class="form-group col-md-4">
                    <label for="student_contact" class="required">Conatct Number</label>
                    <input type="text" name="student_contact" class="form-control" id="student_contact" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="Do not add country code" required>
                  </div>
                </div>
                
            </div>
                
<!--       end of basic detail container        -->
                 
                 <h4 style="margin:16px;"><u>ADDRESS</u> </h4>
                
            <div class="container">
                <div class="form-row">
                      <div class="form-group col-md-2">
                        <label for="house_number" class="required">House Number</label>
                        <input type="text" class="form-control" id="house_number" name="house_number" placeholder="" required>
                        </div>
                    <span class="form-group col-md-4"></span>
                        <div class="form-group col-md-4">
                        <label for="locality" class="required">Locality</label>
                        <input type="text" class="form-control" id="locality" name="locality" placeholder="Apartment, studio, or floor" required>
                      </div>
                </div>        
                  <div class="form-row">
                       <div class="form-group col-md-3">
                      <label for="state" class="required">State</label>
                      <select id="state" name="state" class="form-control" required>
                                <option value="">---Select---</option>
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
                      <label class="required" for="city">City</label>
                      <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                   
                    <div class="form-group col-md-3">
                      <label class="required" for="zip">Zip</label>
                      <input type="text" name="zip" class="form-control" id="zip" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
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
                            <label class="required" for="FatherName" >Father Name</label>
                                <input type="text" class="form-control" id="FatherName" name="FatherName" placeholder="Father's Name" required>  
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label class="required" for="FatherOccupation">Father Ocuupation</label>
                                <input type="text" class="form-control" id="FatherOccupation" name="FatherOccupation" placeholder="Father's Occupation" required>
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label class="required" for="FatherContact">Father Contact</label>
                                <input type="text" class="form-control" name="FatherContact" id="FatherContact" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="10"  placeholder="Father's Contact"required>
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label  for="father_email">Father Email</label>
                               <input type="email" class="form-control" id="" name="father_email" placeholder="Father's Email" >
                            </div>
                        
                        </div>
                        
                        
                        <div class="form-group col-md-6">
                            <h5 class="form-group col-md-5">Mother's Detail</h5>
                            
                            <div class="form-group col-md-9">
                            <label class="required" for="MotherName">Mother Name</label>                            
                               <input type="text" class="form-control" id="MotherName" name="MotherName" placeholder="Mother's Name" required>
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label  for="MotherOccupation">Mother Occupation</label>                            
                                <input type="text" class="form-control" id="MotherOccupation" name="MotherOccupation" placeholder="Mother's Occupation">
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label  for="MotherContact">Mother Contact</label>                            
                                  <input type="text" name="MotherContact" class="form-control" id="MotherContact" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="Mother's Contact" required>
                            </div>
                        </div>
              </div>
                    <br>
                    
                
                    
                <div class="form-row">
                    <h5 class="form-group col-md-3">Guardian Details, If Applicable</h5>
                </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label  for="GuardianName">Guardian Name</label> 
                        <input type="text" class="form-control" id="GuardianName" name="GuardianName" placeholder="Guardian's Name">
                        </div>
                    </div>  
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label  for="GuardianOccupation">Guardian Occupation</label> 
                        <input type="text" class="form-control" id="GuardianOccupation" name="GuardianOccupation" placeholder="Guardian's Occupation">
                        </div>
                    </div>  
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label  for="GuardianContact">Guardian Contact</label> 
                              <input type="text" name="GuardianContact"  class="form-control" id="GuardianContact" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="10" placeholder="Guardian's Contact">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label  for="guardian_email">Guardian Email</label>
                            <input type="email" class="form-control" id="guardian_email" name="guardian_email" placeholder="Email detail" >
                        </div>
                    </div>
                </div>
                
                <div class="line"></div>
                 <br>
                <h4 style="margin:16px;"><u>PREVIOUS EDUCATION DETAILS</u> </h4>
                <div class="container">
                       <div class="form-row">
                        <div class="form-group col-md-3">   
                          <label class="required" for="PreviousClass">Previous Class</label>
                          <select class="form-control" id="PreviousClass" name="PreviousClass" required>
                              <option>---Select Class---</option>
                          <?php    
                                  $i=1;
                                    while($i<12){
                                        echo"<option value=".$i.">".$i."</option>";
                                        $i++;
                                    }
                                  ?>
                          </select>
                        </div>
                           <span class="form-group col-md-3"></span>
                           
                           <div class="form-group col-md-3">
                               <label for="PreviousBoard" class="required">BOARD</label>
                                   <input type="text" class="form-control" id="PreviousBoard" name="PreviousBoard" placeholder="" required>
                            </div>
                           
                         </div> 
                    <div class="form-row">
                           <div class="form-group col-md-3">
                            <label for="PreviousPercentage" class="required">Percentage</label>
                                   <input type="text" name="PreviousPercentage" class="form-control" min="0" max="100"  id="PreviousPercentage" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="" required>
                            </div>
                        <span class="form-group col-md-3"></span>
                           <div class="form-group col-md-3">
                            <label for="YearOfPassing" class="required">Year Of Passing</label>
                                   <input type="text" name="YearOfPassing" maxlength=4 class="form-control" id="YearOfPassing" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="" required>
                            </div>
                    </div>
                <br>
                    
                     <h4  class="required">Class Aplied For</h4>
                     <div class="form-row">
                        <div class="form-group col-md-3">   
                                    <label for="AppliedClass"></label>
                          <select class="form-control" id="AppliedClass" name="AppliedClass" required>
                              <option value="">---Select Class---</option>
                                <?php    
                                  $i=1;
                                    while($i<=12){
                                        echo"<option value='Class ".$i."'>".$i."</option>";
                                        $i++;
                                    }
                                  ?>   
                          </select>
                        </div>
                    </div>
                </div>
                    <br>
                <div class="line"></div>
                    <h4 style="margin:16px;"  class="required"><u>EXTRA FACILITY TAKEN</u> </h4>
                <div class="container">
                    <div class="form-row">
                          
                           <div class="form-group col-md-3">
                               <select class="form-control" id="facility" name="facility" placeholder="" required>
                                    <option value="NONE">None</option>
                                    <option value="HOSTEL">HOSTEL</option>
                                    <option value="TRANSPORT">TRANSPORT</option>
                               </select>
                            </div>
                           
                         </div>
                    <br>
                            <button type="submit" id="submitDetails" name="submitDetails" class="btn btn-primary">Submit</button>
                                <span class="form-group col-md-3"></span>
                            <button type="button" id="resetDetails" name="" onclick="resetFunction()" value="Reset" class="btn btn-success">Reset</button>
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
      
        function resetFunction() {        
          var ask = confirm("Are you sure You want to reset?");
          if (ask == true) {
            document.getElementById("studentForm").reset();
            document.documentElement.scrollTop = 0;
          } else {
             document.documentElement.scrollTop = 0;
          }
        }
            $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

    </script>


</html>