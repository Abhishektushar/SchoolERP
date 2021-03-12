<?php 
session_start();
require("../base/staffdatabase.php");
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) ))  
    header("location:../");
?>

<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Edit My Details</title>

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
                        <a href="Profile.php">
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
            <?php $fetch=$staffdatabase->StaffDetails($_SESSION['staffId']);?>
              <h4 class="sub-heading" align="center"><strong><?php print $fetch["FirstName"]." ".$fetch["MiddleName"]." ".$fetch["LastName"];?></strong> </h4><div class="line"></div>
        <div class="container">
                <div class='col-md-4'><i>Registration id :</i> <strong><?php print $fetch['staff_id']?></strong></div></br>
               
                <form  method="post">
                <div class="container">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputAddress">First Name</label>
                      <input type="text" class="form-control" maxlength="20" name="firstName" value="<?php print $fetch['FirstName']?>" >
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputAddress">Middle Name</label>
                      <input type="text" class="form-control" maxlength="15" name="middleName" value="<?php print $fetch['MiddleName']?>">
                    </div>
                      <div class="form-group col-md-4">
                      <label for="inputAddress">Last Name</label>
                      <input type="text" class="form-control" maxlength="15" name="lastName" value="<?php print $fetch['LastName']?>">
                    </div>
                  </div>
           
                    <div class="form-row"> <div class="form-group col-md-4">
                      <label for="DOB">Date Of Birth</label>
                      <input type="date" class="form-control"  name="DOB" value="<?php print $fetch['DOB']?>">
                    </div>
                    
                        <span class="form-group col-md-2"></span>
                <div class="form-group col-md-3">
                      <label for="blood_group">Blood Group</label>
                      <select class="form-control" name="blood_group" id="blood_group" >
                      <option value="<?php print $fetch['bloodGrp']?>"><?php print $fetch['bloodGrp']?></option>
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
                            <input type="text" class="form-control" name="gender"  value="<?php print $fetch['gender']?>" disabled>
                    </div>
                <span class="form-group col-md-3"></span>
                <div class="form-group col-md-3">
                      <label for="nationality">Nationality:</label>
                      <input type="text" class="form-control" name="nationality" maxlength="15" value="<?php print $fetch["nationality"]?>"> 
                </div>
                
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3"> 
                        
                     <label for="inputAddress">Religion</label>
                      <input type="text" class="form-control" maxlength="15" name="religion" value="<?php print $fetch["religion"]?>">  
                    </div>
                    <span class="form-group col-md-3"></span>
                    
                    <div class="form-group col-md-3">   
                      <label for="category">Category:</label>
                      <select class="form-control" name="category" >
                      <option value="<?php print $fetch["category"]?>"><?php print $fetch["category"]?></option>
                        <option value="GEN">GEN</option>
                        <option value="OBC">OBC</option>
                        <option value="SC/ST">SC/ST</option>
                      </select>
                </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="student_email">Email</label>
                    <input type="email" class="form-control" maxlength="30"  name="staff_email" value="<?php print $fetch["staff_email"]?>">
                  </div>
                    
                    <span class="form-group col-md-2"></span>
                    
                    <div class="form-group col-md-4">
                    <label for="student_contact">Contact Number</label>
                    <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" name="staff_contact" value="<?php print $fetch["staff_contact"]?>">
                  </div>
                </div>
                
            </div>
                
<!--       end of basic detail container        -->
                 
                 <h4 style="margin:16px;"><u>ADDRESS</u> </h4>
                
                <div class="container">
                <div class="form-row">
                      <div class="form-group col-md-2">
                        <label for="inputAddress">House Number</label>
                        <input type="text" class="form-control" maxlength="10" name="house_number" value="<?php print $fetch["house_number"]?>">
                        </div>
                    <span class="form-group col-md-4"></span>
                        <div class="form-group col-md-4">
                        <label for="inputAddress2">Locality</label>
                        <input type="text" class="form-control" name="locality"  maxlength="50" value="<?php print $fetch["locality"]?>">
                      </div>
                </div>        
                  <div class="form-row">
                       <div class="form-group col-md-3">
                      <label for="state">State</label>
                      <select id="state" class="form-control" name="state">
                                <option value="<?php print $fetch["state"]?>"><?php print $fetch["state"]?></option>
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
                      <label for="inputCity">City</label>
                      <input type="text" class="form-control" id="City" maxlength="15" name="city" value="<?php print $fetch["city"]?>">
                    </div>
                   
                    <div class="form-group col-md-3">
                      <label for="inputZip">Zip</label>
                      <input type="text" class="form-control" id="zip" name="zip" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="6" value="<?php print $fetch["zip"]?>">
                    </div>
                  </div>
    </div>
                <div class="line"></div>
                <br>
                <h4 style="margin:16px;"><u>RELATION DETAILS</u></h4>
            
                <div class="container">
                    <div class="form-row">  
                        <div class="form-group col-md-3">
                          <label for="relation">Relation Of</label>
                              <select id="relation" name="relation" class="form-control" disabled>
                                        <option value="<?php print $fetch["relation"]?>"><?php print $fetch["relation"]?></option>

                              </select>
                        </div>
                        <span class="form-group col-md-3"></span>
                         <div class="form-group col-md-3">
                      <label for="relation_name">Name</label>
                      <input type="text" class="form-control" maxlength="30" name="relation_name" value="<?php print $fetch["relation_name"]?>">
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
                    
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control"  name="highSchoolRoll" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="10" value="<?php print $fetch["highSch_roll"]?>">  
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" maxlength="20" name="highSchoolBoard"  value="<?php print $fetch["highSch_Board"]?>">
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" name="highSchoolYOP" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="4"  value="<?php print $fetch["highSch_YOP"]?>">
                            </div>
                            
                            <div class="form-group col-md-9">
                               <input type="text" class="form-control" maxlength="20"  name="highSchoolMajor"  value="<?php print $fetch["highSch_major"]?>">
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" name="highSchool_agr"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="5"  value="<?php print $fetch["highSch_aggr"]?>">
                            </div>
                        
                        </div>
                        
                        
                        <div class="form-group col-md-6">
                                    <h5 class="form-group col-md-12"> Graduation</h5>
                    
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" maxlength="20"  name="grad_name"  value="<?php print $fetch["grad_name"]?>">  
                            </div>
                            

                            <div class="form-group col-md-9">
                                <input type="text" class="form-control"   name="grad_Roll"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10"  value="<?php print $fetch["grad_roll"]?>">  
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control"  maxlength="30" name="grad_university"  value="<?php print $fetch["grad_university"]?>">
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" name="graduationYOP" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="4"  value="<?php print $fetch["grad_YOP"]?>">
                            </div>
                            
                            <div class="form-group col-md-9">
                               <input type="text" class="form-control" maxlength="20"  name="graduationMajor"  value="<?php print $fetch["grad_major"]?>">
                            </div>
                            
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" name="graduation_agr"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="5"   value="<?php print $fetch["grad_aggr"]?>">
                            </div>
                        </div>
              </div>
                     
                <div class="form-row">
                   
                    <div id="showMore" class="showMore form-group col-md-9">
                        
                        <div class="form-group col-md-6">
                                    <h5 class="form-group col-md-12"> Other Qualification</h5>
                    
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control"  maxlength="30" name="otherQuali_Name"  value="<?php print ($fetch["otherQuali_name"])?$fetch["otherQuali_name"]:"NULL"?>">  
                            </div>
                        
                             <div class="form-group col-md-12">
                                <input type="text" class="form-control" maxlength="10" name="otherQuali_roll" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php print ($fetch["otherQuali_roll"])?$fetch["otherQuali_roll"]:"0"?>">  
                            </div>
                            
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="otherQuali_University" name="otherQuali_University" value="<?php print ($fetch["otherQuali_university"])?$fetch["otherQuali_university"]:"NULL"?>">
                            </div>
                            
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="OtherQuali_YOP" id="OtherQuali_YOP" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="4"  value="<?php print ($fetch["otherQuali_YOP"]!=0000)?$fetch["otherQuali_YOP"]:"0000"?>">
                            </div>
                            
                            <div class="form-group col-md-12">
                               <input type="text" class="form-control" maxlength="20" id="otherQuali_Major" name="otherQuali_Major" value="<?php print ($fetch["otherQuali_major"])?$fetch["otherQuali_major"]:"NULL"?>">
                            </div>
                            
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="otherQuali_aggr" id="otherQuali_aggr" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="5" value="<?php print ($fetch["otherQuali_aggr"])?$fetch["otherQuali_aggr"]:"0.0"?>">
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
                      <label for="staff">Staff Position</label>
                      <select id="staff" class="form-control" name="Sch_Pos" disabled >
                                <option value="<?php print $fetch["position"]?>"><?php print $fetch["position"]?></option>
                               
                      </select>
                    </div>
                      
                      
                    <div class="form-group col-md-3" id="typeOfPost"  style="display:<?php print ($fetch["post_assigned"])?'block !important':'none'?>" >
                        <label for="typeOfPost">Type Of Post</label>
                              
                                  <select id="PostType" class="form-control" name="Sch_Post" disabled>
                                    <option value="<?php print $fetch["post_assigned"]?>"><?php print $fetch["post_assigned"]?></option>
                                  </select>
                              
                    </div>
                   
                   <div class="form-group col-md-3" id="subAssigned" style="display:<?php print ($fetch["subject_assigned"])?'block !important':'none'?>">
                        <label for="subAssigned">Assign Subject</label>
                              <select id="AssignSubject" disabled class="form-control" name="Sub_assigned" >">
                                <option value="<?php print $fetch["subject_assigned"]?>"><?php print $fetch["subject_assigned"]?></option>
                              </select>      
                  </div>
                
                    <div class="form-group col-md-3" id="classAssign"  style="display:<?php print ($fetch["class_assigned"])?'block !important':'none'?>" >
                                <label for="classAssign">Assign Classes</label><br>
                                  <span><?php print ($fetch["class_assigned"])?"ASSIGNED : ".$fetch["class_assigned"]:"NO CLASS ASSIGNED<br>AGAIN ASSIGN DESIGNATED CLASSES"?></span>
                                   
                  </div>
                </div>
               
                    <br>
                      <button type="submit" id="submitForm" name="submitChanges" class="btn btn-success">Submit</button>
                </div>
                </form>
    </div>
</div>
                            
    </body>

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
    </script>
</html>
<?php
    if(isset($_POST['submitChanges']))
    {
        
      $firstName=preg_replace('/\s+/', '', strip_tags($_POST['firstName'])); 
      $middleName=preg_replace('/\s+/', '', strip_tags($_POST['middleName'])); 
      $lastName=preg_replace('/\s+/', '', strip_tags($_POST['lastName'])); 
    
      $DOB=strip_tags($_POST['DOB']);
      $blood_grp=strip_tags($_POST['blood_group']);
      
      $nationality=strip_tags($_POST['nationality']);
      $religion=strip_tags($_POST['religion']);
      $category=strip_tags($_POST['category']);
      $staff_email=strip_tags($_POST['staff_email']);
      $staff_contact=strip_tags($_POST['staff_contact']);

      $house_number=strip_tags($_POST['house_number']);
      $locality=strip_tags($_POST['locality']);
      $state=strip_tags($_POST['state']);
      $city=strip_tags($_POST['city']);
      $zip=strip_tags($_POST['zip']);
          
      $relationName=strip_tags($_POST['relation_name']);
          
      $highSchool_roll=strip_tags($_POST['highSchoolRoll']);
      $highSchool_board=strip_tags($_POST['highSchoolBoard']);
      $highSchool_YOP=strip_tags($_POST['highSchoolYOP']);
      $highSchool_major=strip_tags($_POST['highSchoolMajor']);
      $highSchool_aggr=strip_tags($_POST['highSchool_agr']);
      
      $graduation_name=strip_tags($_POST['grad_name']);
      $graduation_roll=strip_tags($_POST['grad_Roll']);
      $graduation_university=strip_tags($_POST['grad_university']);
      $graduation_YOP=strip_tags($_POST['graduationYOP']);
      $graduation_major=strip_tags($_POST['graduationMajor']);
      $graduation_aggr=strip_tags($_POST['graduation_agr']);

      $oth_qauali_name=strip_tags($_POST['otherQuali_Name']);
      $oth_qauali_roll=strip_tags($_POST['otherQuali_roll']);
      $oth_qauali_university=strip_tags($_POST['otherQuali_University']);
      $oth_qauali_YOP=strip_tags($_POST['OtherQuali_YOP']);
      $oth_qauali_mojor=strip_tags($_POST['otherQuali_Major']);
      $oth_qauali_aggr=strip_tags($_POST['otherQuali_aggr']);
            
      $staffdatabase->updateMYDetails($_SESSION['staffId'],$firstName,$middleName,$lastName,$DOB,$blood_grp,$nationality,
      $religion,$category,$staff_email,$staff_contact,$house_number,$locality,$state,$city,
      $zip,$relationName,$highSchool_roll,$highSchool_board,$highSchool_YOP,$highSchool_major,
      $highSchool_aggr,$graduation_name,$graduation_roll,$graduation_university,$graduation_YOP,$graduation_major,$graduation_aggr,
      $oth_qauali_name,$oth_qauali_roll,$oth_qauali_university,$oth_qauali_YOP,$oth_qauali_mojor,$oth_qauali_aggr); 
  }


?>