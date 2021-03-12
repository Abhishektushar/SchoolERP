<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php include "handle/staffEntry.php"?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add Staff</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
    
    <style type="text/css">
        

        /* Styling Checkbox Starts */
        .checkbox-label {
            cursor: pointer;
            font-size: 22px;
            line-height: 24px;
            height: 24px;
            width: 24px;
            margin:10px 10px 0 0;
            
        }
        #subAssigned,
        #showMore,
        #classAssign,
        #typeOfPost {
            display: none;
        }
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
            <h3 class="sub-heading" style="text-align:center">Add Staff</h3><div class="line"></div>
            

                    <h4 style="margin:16px"><u>BASIC DETAILS</u> </h4>
            
           
<div class="col-md-4"><p>Registration number :  <span style="color:#000;font-weight:normal">
    <?php $database->getStaffRegNum();?>
    </span></p></div>
            
            <form id="staffForm" method="post">
                <div class="container">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="firstName" class="required">First Name</label>
                      <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="middleName">Middle Name</label>
                      <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle name" >
                    </div>
                      <div class="form-group col-md-4">
                      <label for="lastName" class="required">Last Name</label>
                      <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" required>
                    </div>
                  </div>
           
                    <div class="form-row"> <div class="form-group col-md-4">
                      <label for="DOB" class="required">Date Of Birth</label>
                      <input type="date" class="form-control" id="DOB" name="DOB" placeholder="" required>
                    </div>
                    
                        <span class="form-group col-md-2"></span>
                <div class="form-group col-md-3">
                      <label for="blood_group" class="required">Blood Group</label>
                      <select class="form-control" name="blood_group" id="blood_group"  required>
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
                      <select class="form-control" name="gender" id="gender"  required>
                            <option value="">Select</option>
                              <option value="Male">Male</option>
                            <option value="Female">Female</option>
                      </select>
                    </div>
                <span class="form-group col-md-3"></span>
                <div class="form-group col-md-3">
                      <label for="nationality" class="required">Nationality:</label>
                      <input type="text" class="form-control" name="nationality" id="nationality" placeholder="" required> 
                </div>
                
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3"> 
                        
                     <label for="inputAddress" class="required">Religion</label>
                      <input type="text" class="form-control" id="religion" name="religion" placeholder="Religion" required>  
                    </div>
                    <span class="form-group col-md-3"></span>
                    
                    <div class="form-group col-md-3">   
                      <label for="category" class="required">Category:</label>
                      <select class="form-control" name="category" id="category"  required>
                        <option value="GEN">GEN</option>
                        <option value="OBC">OBC</option>
                        <option value="SC/ST">SC/ST</option>
                      </select>
                </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="staff_email" class="required">Email</label>
                    <input type="email" class="form-control" id="staff_email" name="staff_email" placeholder="example@domain.com"  required>
                  </div>
                    
                    <span class="form-group col-md-2"></span>
                    
                    <div class="form-group col-md-4">
                    <label for="staff_contact" class="required">Contact Number</label>
                    <input type="text" class="form-control" id="staff_contact" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" name="staff_contact" placeholder="Do not add country code" required>
                  </div>
                </div>
                
            </div>
                
<!--       end of basic detail container        -->
                 
                 <h4 style="margin:16px;"><u>ADDRESS</u> </h4>
                
                <div class="container">
                <div class="form-row">
                      <div class="form-group col-md-2">
                        <label for="inputAddress" class="required">House Number</label>
                        <input type="text" class="form-control" id="house_number" name="house_number" placeholder=""  required>
                        </div>
                    <span class="form-group col-md-4"></span>
                        <div class="form-group col-md-4">
                        <label for="inputAddress2" class="required">Locality</label>
                        <input type="text" class="form-control" id="locality" name="locality" maxlength="30" placeholder="Apartment, studio, or floor" required>
                      </div>
                </div>        
                  <div class="form-row">
                       <div class="form-group col-md-3">
                      <label for="state" class="required">State</label>
                      <select id="state" class="form-control" name="state"  required>
                                <option >Select</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh ">Arunachal Pradesh </option>
                                <option value="Assam ">Assam </option>
                                <option value="Bihar ">Bihar </option>
                                <option value="Chhattisgarh ">Chhattisgarh </option>
                                <option value="Goa ">Goa </option>
                                <option value="Gujarat ">Gujarat </option>
                                <option value="Haryana ">Haryana </option>
                                <option value="Himachal Pradesh ">Himachal Pradesh </option>
                                <option value="Jammu and Kashmir ">Jammu and Kashmir </option>
                                <option value="Jharkhand ">Jharkhand </option>
                                <option value="Karnataka ">Karnataka </option>
                                <option value="Kerala ">Kerala </option>
                                <option value="Madhya Pradesh ">Madhya Pradesh </option>
                                <option value="Maharashtra ">Maharashtra </option>
                                <option value="Manipur ">Manipur </option>
                                <option value="Meghalaya ">Meghalaya </option>
                                <option value="Mizoram ">Mizoram </option>
                                <option value="Nagaland ">Nagaland </option>
                                <option value="Odisha ">Odisha </option>
                                <option value="Punjab ">Punjab </option>
                                <option value="Rajasthan ">Rajasthan </option>
                                <option value="Sikkim ">Sikkim </option>
                                <option value="Tamil Nadu ">Tamil Nadu </option>
                                <option value="Telangana ">Telangana </option>
                                <option value="Tripura ">Tripura </option>
                                <option value="Uttar Pradesh ">Uttar Pradesh </option>
                                <option value="Uttarakhand ">Uttarakhand </option>
                                <option value="West Bengal ">West Bengal </option>
                                <option value="Andaman and Nicobar ">Andaman and Nicobar </option>
                                <option value="Chandigarh ">Chandigarh </option>
                                <option value="Dadar and Nagar Haveli ">Dadar and Nagar Haveli </option>
                                <option value="Daman and Diu ">Daman and Diu </option>
                                <option value="Delhi ">Delhi </option>
                                <option value="Lakshadweep ">Lakshadweep </option>
                                <option value="Puducherry ">Puducherry </option>  
                      </select>
                    </div>
                      
                      
                    <div class="form-group col-md-3">
                      <label for="inputCity" class="required">City</label>
                      <input type="text" class="form-control" id="City" name="city" required>
                    </div>
                   
                    <div class="form-group col-md-3">
                      <label for="inputZip" class="required">Zip</label>
                      <input type="text" class="form-control" id="zip" name="zip" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="6" required>
                    </div>
                  </div>
    </div>
                <div class="line"></div>
                <br>
                <h4 style="margin:16px;"><u>RELATION DETAILS</u></h4>
            
                <div class="container">
                    <div class="form-row">  
                        <div class="form-group col-md-3">
                          <label for="relation" class="required">Relation Of</label>
                              <select id="relation" name="relation" class="form-control" required>
                                        <option value="" >Select</option>

                              </select>
                        </div>
                        <span class="form-group col-md-3"></span>
                         <div class="form-group col-md-3">
                      <label for="relation_name" class="required">Name</label>
                      <input type="text" class="form-control" name="relation_name" id="relation_name" required>
                    </div>
                    </div>
                </div>
                
                <div class="line"></div>
                 <br>
                
                <h4 style="margin:16px;"><u>QUALIFICATION DETAILS</u> </h4>
                 <div class="container">
                    <div class="form-row">
                        <div class="form-group col-md-6 ">
                                
                            <h5 class="form-group col-md-12">High School information</h5>
                    
                            <div class="form-group col-md-9" >
                              <label for="highSchoolRoll" class="required">Roll</label>
                                <input type="text" class="form-control " id="highSchoolRoll" name="highSchoolRoll" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Roll Number" maxlength="10" required>  
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label for="highSchoolBoard" class="required">Board</label>
                                <input type="text" class="form-control" id="highSchoolBoard" name="highSchoolBoard" placeholder="BOARD" required>
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label for="highSchoolYOP" class="required">Year Of Passing</label>
                                <input type="text" class="form-control" name="highSchoolYOP" id="highSchoolYOP" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="4"  placeholder="YOP" required>
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label for="highSchoolMajor" class="required">Major Subject</label>
                               <input type="text" class="form-control" id="highSchoolMajor" name="highSchoolMajor" placeholder="Major" required>
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label for="highSchool_agr" class="required">Percentage</label>
                                <input type="text" class="form-control" name="highSchool_agr" id="highSchool_agr" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="5"  placeholder="Aggregate" required>
                            </div>
                        
                        </div>
                        
                        
                        <div class="form-group col-md-6">
                                    <h5 class="form-group col-md-12"> Graduation</h5>
                    
                            <div class="form-group col-md-9">
                            <label for="grad_name" class="required">Graduadtion Name</label>
                                <input type="text" class="form-control" id="grad_name" name="grad_name" placeholder="Name of Degree"required>  
                            </div>
                            

                            <div class="form-group col-md-9">
                            <label for="grad_Roll" class="required">Roll</label>
                                <input type="text" class="form-control" id="grad_Roll" name="grad_Roll" placeholder="Roll Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" required>  
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label for="grad_university" class="required">University</label>
                                <input type="text" class="form-control" id="grad_university" name="grad_university" placeholder="University" required>
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label for="graduationYOP" class="required">Year Of Passing</label>
                                <input type="text" class="form-control" name="graduationYOP" id="graduationYOP" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="4"  placeholder="YOP" required>
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label for="graduationMajor" class="required">Major Subject</label>
                               <input type="text" class="form-control" id="graduationMajor" name="graduationMajor" placeholder="Major" required>
                            </div>
                            
                            <div class="form-group col-md-9">
                            <label for="graduation_agr" class="required">Percentage</label>
                                <input type="text" class="form-control" name="graduation_agr" id="cgraduation_agr" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="5"  placeholder="Aggregate" required>
                            </div>
                        </div>
              </div>
                     
                <div class="form-row">
                    <div class="form-group col-md-3"><input type="checkbox" class="checkbox-label" id="doCheck"/>Add other Qualifications</div>
                    <div id="showMore" class="showMore form-group col-md-9">
                        
                        <div class="form-group col-md-6">
                                    <h5 class="form-group col-md-12"> Other Qualification</h5>
                    
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="otherQuali_Name" name="otherQuali_Name" placeholder="Name of Qualificaion">  
                            </div>
                        
                             <div class="form-group col-md-12">
                                <input type="text" class="form-control" maxlength="10" id="otherQuali_roll" name="otherQuali_roll" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Roll">  
                            </div>
                            
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="otherQuali_University" name="otherQuali_University" placeholder="University">
                            </div>
                            
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="OtherQuali_YOP" id="OtherQuali_YOP" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="4"  placeholder="YOP">
                            </div>
                            
                            <div class="form-group col-md-12">
                               <input type="text" class="form-control" id="otherQuali_Major" name="otherQuali_Major" placeholder="Major">
                            </div>
                            
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="otherQuali_aggr" id="otherQuali_aggr" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="5"  placeholder="Aggregate">
                            </div>
                        </div>
                    </div>     
                </div>              
                    <br>
                    
                
                    
                <div class="form-row">
                    <h5 class="form-group col-md-3">School Position</h5>
                </div>
                   <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="staff" class="required">Staff Position</label>
                      <select id="staff" class="form-control" name="Sch_Pos" onchange="showSelect('typeOfPost',this)" required>
                                <option >---Select---</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Lab Assistant">Lab Assistant</option>
                                <option value="Warden">Warden </option>
                                <option value="Transport Officer">Transport Officer</option>
                      </select>
                    </div>
                      
                      
                    <div class="form-group col-md-3" id="typeOfPost">
                        <label for="typeOfPost" class="required">Type Of Post</label>
                              
                                  <select id="PostType" class="form-control" name="Sch_Post" onchange="showSubAssigned('subAssigned',this)">
                                    <option value="">Select</option>
                                  </select>
                              
                    </div>
                   
                   <div class="form-group col-md-3" id="subAssigned">
                        <label for="subAssigned" class="required">Assign Subject</label>
                              <select id="AssignSubject" class="form-control" name="Sub_assigned" onchange="showClass('classAssign')">
                                <option value="">--Select--</option>
                              </select>      
                  </div>
                
                    <div class="form-group col-md-3" id="classAssign">
                                <label for="classAssign" class="required">Assign Classes</label><br>
                                    <select id="AssignedClass" name="class_assigned[]"  class="form-control" name="AssignedClass" size="7" multiple>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                    </select>
                                    <br>
                                    
                                <small><p style="cursor:pointer"  name="Save" id="Save">Assign Now</p>
                                    <p id="output"></p></small>
                                  </select>      
                  </div>
                </div>
               
                    <br>
                      <button type="submit" id="submitForm" name="submitForm" class="btn btn-primary">Submit</button><span class="form-group col-md-3"></span>
                
                    <button type="button" id="resetForm" name="resetForm" class="btn btn-success" onclick="resetFunction()" value="Reset" >Reset</button>
                </div>
                </form>
            </div>
    </body>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>
        <!--my  important js functions -->
    <script src="js/staff.js"></script>
</html>