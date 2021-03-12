<?php 
  class Database 
  {
      public $connect;  //for connection
      public $stcount; //counts the number of student in particular class
    //   public $teachercount; //counts total number of teachers

		// DB Connect
		public function connection() {
		  
           return $this->connect=mysqli_connect('localhost','root','','dps');
        }
             
         
             //counts student in class(X)
       public function countStudent($class){
        $this->connection();
            $count=mysqli_query($this->connect,"SELECT `appliedClass` FROM `student_add` WHERE `current_class`=$class");
            return $this->stcount=mysqli_num_rows($count);     
        }

            //student Admision method
      public function AddStudent($firstName,$middleName,$lastName,$DOB,$bloodGrp,$gender,$nationality,$religion,$category,
                                $student_email,$student_contact,$house_number,$locality,$state,$city,$zip,$fatherName,
                                $fatherOccupation,$fatherContact,$fatherEmail,$motherName,$motherOccupation,$motherContact,
                                $guardianName,$guardianContact,$guardianOccupation,$guardianEmail,$PreviousClass,$Board,
                                $Percentage,$YOP,$AppliedClass,$currClass,$facility)
      {
    	$this->connection();
    	$add=mysqli_query($this->connect,"INSERT INTO `student_add`(`FirstName`, `MiddleName`, `LastName`, `DOB`, `bloodGrp`, `gender`, `nationality`, `religion`, 
                                         `category`, `student_email`, `student_contact`, `house_number`, `locality`, `state`, `city`, `zip`, `fatherName`,
                                          `fatherOccupation`, `fatherContact`, `fatherEmail`, `motherName`, `motherOccupation`, `motherContact`, `guardianName`, 
                                          `guardianContact`, `guardianOccupation`, `guardianEmail`, `previousClass`, `board`, `percentage`, `YOP`, `appliedClass`,`current_class`,`Facility`)
                                           VALUES ('$firstName','$middleName','$lastName','$DOB','$bloodGrp','$gender','$nationality','$religion','$category','$student_email',
                                           '$student_contact','$house_number','$locality','$state','$city','$zip','$fatherName','$fatherOccupation','$fatherContact',
                                           '$fatherEmail','$motherName','$motherOccupation','$motherContact','$guardianName','$guardianContact','$guardianOccupation',
                                           '$guardianEmail','$PreviousClass','$Board','$Percentage','$YOP','$AppliedClass',$currClass,'$facility')");

        $addToAttendance=mysqli_query($this->connect,"INSERT INTO `attendance`( `student_class`) VALUES ($currClass)");
           if($add && $addToAttendance)
                echo" <script> alert('Submitted Successfully'); location.href='admission_student.php';</script>";
            else 
                echo" <script> alert('please Try again!!'); location.href='admission_student.php';</script>";

        }
        
        //student info updation method
       public function updateStudentDetails($sid,$firstName,$middleName,$lastName,$DOB,$bloodGrp,$gender,$nationality,$religion,$category, $student_email,$student_contact,$house_number,$locality,$state,$city,$zip,$fatherName,$fatherOccupation,$fatherContact,$fatherEmail,$motherName,$motherOccupation,$motherContact,$guardianName,$guardianContact,$guardianOccupation,$guardianEmail)    
        {
            $this->connection();
            $sql="UPDATE `student_add` SET `FirstName`=?,`MiddleName`=?,`LastName`=?,`DOB`=?,`bloodGrp`=?,`gender`=?,`nationality`=?,`religion`=?,
                 `category`=?,`student_email`=?,`student_contact`=?,`house_number`=?,`locality`=?,`state`=?,`city`=?,`zip`=?,`fatherName`=?,
                 `fatherOccupation`=?,`fatherContact`=?,`fatherEmail`=?,`motherName`=?,`motherOccupation`=?,`motherContact`=?,`guardianName`=?,
                 `guardianContact`=?,`guardianOccupation`=?,`guardianEmail`=? WHERE `student_id`= ?";
          
         $stmt=$this->connect->prepare($sql);
         $stmt->bind_param("ssssssssssissssississsisissi",$firstName,$middleName,$lastName,$DOB,$bloodGrp,$gender,$nationality,$religion,$category,$student_email,$student_contact,$house_number,$locality,$state,$city,$zip,$fatherName,$fatherOccupation,$fatherContact,$fatherEmail,$motherName,$motherOccupation,$motherContact,$guardianName,$guardianContact,$guardianOccupation,$guardianEmail,$sid);
               
       if($stmt->execute())
       echo "<script>alert('Updated Successfully !!!');location.href='../student/studentDetails.php?id=".$sid."'</script>" ;
       else
       echo "<script>alert('Please try Again !!!');location.href='../student/edit_details.php?id=".$sid."'</script>" ;
        
        } 
       

        //returns temprory registration number on admission of student
      public function getRegistrationNum()
             { $this->connection();
                    $res=mysqli_query($this->connect,"SELECT `student_id` FROM `student_add` WHERE 1");
                if(mysqli_num_rows($res)== 0)
                   { print 1;}
                else{
                        while(($fetch=mysqli_fetch_array($res)) && (mysqli_num_rows($res)>0)) 
                           { $val=$fetch[0] ;   }         
                        print $val+1;
                    }
             }
     
        //returns student list
        public function getStudentList(){
		
            $i=1;        
            $this->connection();          
            $sql=mysqli_query($this->connect,"SELECT `FirstName`, `MiddleName`, `LastName`, `gender`,  `student_contact`, `house_number`,
                                 `locality`, `city`, `state`, `zip`, `fatherName`,`fatherContact`,`student_id` FROM `student_add` WHERE 1");   
            while($fetch=mysqli_fetch_array($sql)){
		    ?> <tr>
                <td width="5%"><?php   print $i;?></td>
                <td width="15%"><a href="student/studentdetails.php?id=<?php echo $fetch['student_id']; ?>"><?php   print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];?></a></td>
                <td width="8%"><?php   print $fetch['gender'];?></td>
                <td width="12%"><?php   print $fetch['student_contact'];?></td>
                <td width="25%"><?php   print $fetch['house_number'].", ".$fetch['locality'].", ".$fetch['city'].", ".$fetch['state'].", PIN- ".$fetch['zip'];?></td>
                <td width="15%"><?php   print $fetch['fatherName'];?></td>
                <td width="15%"><?php   print $fetch['fatherContact'];?></td>
            </tr>
			<?php  $i++;  
		    }
         }
    
    //returns student Fullname
     public function getStudentName($id){
        $this->connection();          
		$sql=mysqli_query($this->connect,"SELECT `FirstName`, `MiddleName`, `LastName` FROM `student_add` WHERE student_id = '$id'");
       if(mysqli_num_rows($sql)==1) {$fetch=mysqli_fetch_array($sql); 
			print $fetch[0]." ".$fetch[1]." ".$fetch[2];}
        }
        //returns all the details of the stduent
        public function getThisStudentDetails($id){
            $this->connection();          
            $sql=mysqli_query($this->connect,"SELECT * FROM `student_add` WHERE student_id = '$id'");
            if(mysqli_num_rows($sql)==1){
                $fetch=mysqli_fetch_array($sql); 
                return $fetch;
            }else{
                header("location:../");
            }
        } 

        //claswise student view method
     public function getStudentListClassWise($class)
     {         
        $class=intval($class);
        $this->connection();          
        $sql=mysqli_query($this->connect,"SELECT `FirstName`, `MiddleName`, `LastName`, `gender`,  `student_contact`, `house_number`,
                             `locality`, `city`, `state`, `zip`, `fatherName`,`fatherContact`,`student_id` FROM `student_add` WHERE  `current_class`=$class");   
       $i=1; 
       while($fetch=mysqli_fetch_array($sql)){
        ?> <tr>
            <td width="5%"><?php   print $i;?></td>
            <td width="15%"><a href="studentdetails.php?id=<?php echo $fetch['student_id']; ?>"><?php   print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];?></a></td>
            <td width="8%"><?php   print $fetch['gender'];?></td>
            <td width="12%"><?php   print $fetch['student_contact'];?></td>
            <td width="25%"><?php   print $fetch['house_number'].", ".$fetch['locality'].", ".$fetch['city'].", ".$fetch['state'].", PIN- ".$fetch['zip'];?></td>
            <td width="15%"><?php   print $fetch['fatherName'];?></td>
            <td width="15%"><?php   print $fetch['fatherContact'];?></td>
        </tr>
        <?php  $i++;  
        }

     }   
     
             //STAFFING methods
        public function AddStaff($firstName,$middleName,$lastName,$DOB,$blood_grp,$gender,
        $nationality,$religion,$category,$staff_email,$staff_contact,$house_number,$locality,
        $state,$city,$zip,$relation,$relationName,$highSchool_roll,$highSchool_board,$highSchool_YOP,
        $highSchool_major,$highSchool_aggr,$graduation_name,$graduation_roll,$graduation_university,$graduation_YOP,
        $graduation_major,$graduation_aggr,$oth_qauali_name,$oth_qauali_roll,$oth_qauali_university,
        $oth_qauali_YOP,$oth_qauali_mojor,$oth_qauali_aggr,$staff,$satff_post,$subject_assigned,$classes_assigned){
        
        if($classes_assigned != NULL){
            $class_string = implode (",", $classes_assigned );
        }else{
            $class_string= NULL;
        }
        $this->connection();

    	$add=mysqli_query($this->connect,"INSERT INTO `staff_add`( `FirstName`, `MiddleName`, `LastName`, `DOB`, `bloodGrp`, `gender`,
                    `nationality`, `religion`, `category`, `staff_email`, `staff_contact`, `house_number`, `locality`, 
                    `state`, `city`, `zip`, `relation`, `relation_name`, `highSch_roll`, `highSch_Board`, `highSch_YOP`,
                    `highSch_major`, `highSch_aggr`,`grad_name`, `grad_roll`, `grad_university`, `grad_YOP`, `grad_major`, `grad_aggr`,
                    `otherQuali_name`, `otherQuali_roll`, `otherQuali_university`, `otherQuali_YOP`, `otherQuali_major`, 
                    `otherQuali_aggr`, `position`, `post_assigned`, `subject_assigned`,`class_assigned`) 
                    VALUES ('$firstName','$middleName','$lastName','$DOB','$blood_grp','$gender','$nationality',
                    '$religion','$category','$staff_email','$staff_contact','$house_number','$locality','$state',
                    '$city','$zip','$relation','$relationName','$highSchool_roll','$highSchool_board','$highSchool_YOP',
                    '$highSchool_major','$highSchool_aggr','$graduation_name','$graduation_roll','$graduation_university','$graduation_YOP',
                    '$graduation_major','$graduation_aggr','$oth_qauali_name','$oth_qauali_roll','$oth_qauali_university',
                    '$oth_qauali_YOP','$oth_qauali_mojor','$oth_qauali_aggr','$staff','$satff_post','$subject_assigned','$class_string')");
        
        if($add)
        echo" <script> alert('Submitted Successfully');location.href='admission_staff.php'; </script>";      
        else
        echo "<script>alert('Please Try Again !!!');location.href='admission_staff.php';</script>";  
            }

            //updation in staff details
        public function updateThisStaffDetails($staffID,$firstName,$middleName,$lastName,$DOB,$blood_grp,$nationality,
        $religion,$category,$staff_email,$staff_contact,$house_number,$locality,$state,$city,
        $zip,$relationName,$highSchool_roll,$highSchool_board,$highSchool_YOP,$highSchool_major,
        $highSchool_aggr,$graduation_name,$graduation_roll,$graduation_university,$graduation_YOP,$graduation_major,$graduation_aggr,
        $oth_qauali_name,$oth_qauali_roll,$oth_qauali_university,$oth_qauali_YOP,$oth_qauali_mojor,$oth_qauali_aggr)
        {
            $this->connection();
            $staffID=intval($staffID);
            $graduation_roll=intval($graduation_roll);

            $sql="UPDATE `staff_add` SET `FirstName`=?,`MiddleName`=?,`LastName`=?,`DOB`=?,`bloodGrp`=?,`nationality`=?,`religion`=?,`category`=?,`staff_email`=?,
            `staff_contact`=?,`house_number`=?,`locality`=?,`state`=?,`city`=?,`zip`=?,`relation_name`=?,
            `highSch_roll`=?,`highSch_Board`=?,`highSch_YOP`=?,`highSch_major`=?,`highSch_aggr`=?,
            `grad_name`=?,`grad_roll`=?,`grad_university`=?,`grad_YOP`=?,`grad_major`=?,`grad_aggr`=?,
            `otherQuali_name`=?,`otherQuali_roll`=?,`otherQuali_university`=?,`otherQuali_YOP`=?,`otherQuali_major`=?,`otherQuali_aggr`=? WHERE `staff_id`= ?";

            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("sssssssssissssisisisisisisisisisii",$firstName,$middleName,$lastName,$DOB,$blood_grp,$nationality,$religion,$category,$staff_email,$staff_contact,$house_number,
            $locality,$state,$city,$zip,$relationName,$highSchool_roll,$highSchool_board,$highSchool_YOP,$highSchool_major,$highSchool_aggr,$graduation_name,$graduation_roll,
            $graduation_university,$graduation_YOP,$graduation_major,$graduation_aggr,$oth_qauali_name,$oth_qauali_roll,$oth_qauali_university,$oth_qauali_YOP,$oth_qauali_mojor,
            $oth_qauali_aggr,$staffID);
            if($stmt->execute()){
                       echo "<script>alert('Updated Succesfully !!!');location.href='../staff/staffdetails.php?id=".$staffID."'</script>";
            }else
                    echo "<script>alert('Please TRY Again !!!');location.href='../staff/edit_details.php?id=".$staffID."'</script>";
            }  

        //returns temprory registration number
    public function getStaffRegNum(){
        $n=0;
            $this->connection();
                    $res=mysqli_query($this->connect,"SELECT `staff_id` FROM `staff_add` WHERE 1");
                if(($res) == null){
                    print 1;
                }
                else{
                        while(($fetch=mysqli_fetch_array($res)) && (mysqli_num_rows($res)>0)) 
                        $n=$fetch['staff_id'] ; 
                        print $n+1;
                  }
            }

        //returns Staff fullname
        public function getStaffName($id){
            $this->connection();          
            $sql=mysqli_query($this->connect,"SELECT `FirstName`, `MiddleName`, `LastName` FROM `staff_add` WHERE staff_id = '$id'");
            if(mysqli_num_rows($sql)==1)
            $fetch=mysqli_fetch_array($sql); 
                print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];
        }
            
            // shows full staff list
        public function getStaffList(){
                $i=1;        
                $this->connection();          
                $sql=mysqli_query($this->connect," SELECT `FirstName`, `MiddleName`, `LastName`, 
                `position`,`post_assigned`, `staff_contact`, `house_number`, `locality`, `state`, `city`, `zip`,`staff_email`,`staff_id` 
                FROM `staff_add` WHERE 1");   
            if($sql){
                while($fetch=mysqli_fetch_array($sql)){   
                ?>
                <form method="post">
                <tr>
                    <td width="10%"><?php   print $i;?></td>
                    <td><a href="staff/staffdetails.php?id=<?php echo $fetch[12]; ?>"><?php   print $fetch[0]." ".$fetch[1]." ".$fetch[2];?></a></td>
                    <td><?php   print $fetch['position']; ($fetch['post_assigned'])?print "/".$fetch['post_assigned']:print "";?></td>
                    <td><?php   print $fetch[5];?></td>
                    <td><?php   print $fetch[6].", ".$fetch[7].", ".$fetch[8].", ".$fetch[9].", PIN- ".$fetch[10];?></td>
                    <td><?php   print $fetch[11];?></td>
                </tr>
                </form>
                    <?php  
                    $i++;  
                }}
            }
     
            //details of selcted staff
        public function getStaffDetails($id){
            $this->connection();          
            $sql=mysqli_query($this->connect,"SELECT * FROM `staff_add` WHERE staff_id = '$id'");
            if(mysqli_num_rows($sql)==1){
                $fetch=mysqli_fetch_array($sql); 
                return $fetch;
            }else{
                header("location:../");
            }
             }


        //ACCOUNTINGS
        public function giveRow($class)//intermediary function
        {
            $row=0; 
            $class=intval($class);
             if($class <= 5 && $class >0){
                  return $row=1;
                  }else if( $class <=10 && $class > 5){
                       return $row=2;
                    }else if($class== 11 || $class == 12){
                        return  $row=3;}
             else  return 0;             
        }

        //returns class fees including different fees-sections
        public function getclassfees($class)
        {   
            $row=$this->giveRow($class);
            if($row){
            $this->connection();          
            $sql=mysqli_query($this->connect," SELECT  `id`,`class_grp`, `tution`, `sports`, `cca`, `exam`, `special_subject`, `last_update` FROM `accounts` WHERE `id`= $row");
            if(mysqli_num_rows($sql)==1)
            {
                $fetch=mysqli_fetch_array($sql);
                return $fetch;
            }else{
                header('location:../admin_accounting.php');
            }}else{
                echo "<script>alert('Enter Valid Class');location.href='../admin_accounting.php';</script>";
            }
        }
        
        //this function returns the class grouped row id
        public function getclass($class)
        {$row=$this->giveRow($class);
            if($row){
                $this->connection();          
                $sql=mysqli_query($this->connect," SELECT `id` FROM `accounts` WHERE `id`= $row");
                if($sql)
                {
                   echo "<script>location.href='account/class_fee.php?class=".$row."'</script>";
                }else{
                    header('location:admin_accounting.php');
                }}else{
                    echo "<script>alert('Enter Valid Class');location.href='admin_accounting.php';</script>";
                }

        }

        //this mehtod displays name of techer assined to class x
        public function getTeacherName($class){
                $this->connection();
                $class=intval($class);
                $sql=mysqli_query($this->connect,"SELECT `staff_id`,`FirstName`,`MiddleName`,`LastName` FROM staff_add where find_in_set($class,`class_assigned`) <> 0");
                if(mysqli_num_rows($sql)>0){
                    while($row=mysqli_fetch_array($sql)){
                        echo '<option value="'.$row['staff_id'].'">'.$row['FirstName'].' '.$row['MiddleName'].' '.$row['LastName'].'</option>';
                    }
                }
        }

        public function checkIfClassHasTeacher($c){     //$c is class integr val
            $this->connection();
            $class="Class ".$c;
            $sql=mysqli_query($this->connect,"SELECT `classes` FROM `time_table` WHERE `class_teacher_id` !='' and `classes`='$class'");
            if(mysqli_num_rows($sql)==1)
                return true;
            else
                return false;
        }

        public function getClassTeacherName($c){
            $this->connection();
            $class="Class ".$c;
            $sql=mysqli_query($this->connect,"SELECT staff_add.FirstName,staff_add.MiddleName, staff_add.LastName FROM staff_add 
                                LEFT JOIN time_table ON staff_add.staff_id = time_table.class_teacher_id WHERE time_table.classes='$class' ");
            if(mysqli_num_rows($sql)==1){
                $fetch=mysqli_fetch_array($sql);
                $name= $fetch["FirstName"].' '.$fetch["MiddleName"].' '.$fetch["LastName"];
                return $name;
            }
        }

        //adding class teacher to class x
        public function setClassTeacherToClass($c,$staff_id)
        {   $this->connection();
            $class="Class ".$c;
            $staff_id=intval($staff_id);
            $sql=mysqli_query($this->connect,"UPDATE `time_table` SET `class_teacher_id`=$staff_id WHERE `classes`='$class'");
            if($sql)
                echo '<script>alert("Class Teacher Assigned !!!");location.href="classView.php?class='.$c.'";</script>';
            else
              echo '<script>alert("Please try again !!!");</script>';
        }   

        //this method displays class fess structure
        public function classView($id)
        { $id=intval($id);
            if($id>3 || $id <1 ){
                header('location:../admin_accounting.php');
            }
            else if($id>=1 && $id<=3){
                $this->connection();
                $sql=mysqli_query($this->connect," SELECT  `class_grp`, `tution`, `sports`, `cca`, `exam`, `special_subject`, `last_update` FROM `accounts` WHERE `id`= $id");
                if($sql)
                    {
                        return $fetch=mysqli_fetch_array($sql);
                    }
            }else{
                echo "<script>alert('Invalid Action');";
                header('location:../admin_accounting.php');
            }
        }
    
        //updatting class(class-grp) fees str
     function updatefeestr($grp,$tution,$sports,$cca,$exm,$spec)
        {   $this->connection();          
            $update=mysqli_query($this->connect,"UPDATE `accounts` SET `tution`='$tution',`sports`='$sports',`cca`='$cca',`exam`='$exm',
                                            `special_subject`= '$spec' WHERE `id`=$grp");
            if($update){
                echo "<script>alert('Updated Successfully !!!');location.href='../account/fee_structure.php'</script>";
            }else{
                echo "<script>alert('Please Try Again !!!')</script>";

            }
        }

        //redirects to students personal total fees details
      function studentView($sid)  {   
            $sid=intval($sid);
            $this->connection();
            $checkID=mysqli_query($this->connect,"SELECT   `current_class`,`FirstName`, `MiddleName`, `LastName` FROM `student_add` WHERE `student_id`=$sid");
            if(mysqli_num_rows($checkID)==1){
                echo "<script>location.href='account/student_fee.php?id=".$sid."'</script>";
            }else{
                echo "<script>alert('Student ID is Invalid !!!');location.href='admin_accounting.php'</script>";
            }
        }

        //students personal accounting details
        function studentFeesView($sid)
        {
            $this->connection();
            $sql=mysqli_query($this->connect,"SELECT  `current_class` FROM `student_add` WHERE `student_id`=$sid");
           if(mysqli_num_rows($sql)==1)
           {
               $stdDetails=mysqli_query($this->connect,"SELECT `student_id`, `FirstName`, `MiddleName`, `LastName`,`gender`,
                                             `nationality`, `student_email`, `student_contact`, `house_number`, `locality`, 
                                            `state`, `city`, `zip`, `fatherName`, `fatherContact`, `fatherEmail`, `motherName`, 
                                             `motherContact`, `guardianName`, `guardianContact`, `Facility`, `dateOfAdmission`, 
                                             `current_class` FROM `student_add` WHERE `student_id`=$sid");
                    if($stdDetails){
                            $fetch=mysqli_fetch_array($stdDetails);
                            return $fetch;
                    }else   return header("location:../admin_accounting.php");
            }else
                return header("location:../admin_accounting.php");
           }
        
           //get fcility fees informtion
          function facilityfees($fac) 
          {  $this->connection();
            $sql=mysqli_query($this->connect,"SELECT`fees`FROM `facility_fees` WHERE `facility`='$fac'");
           if(mysqli_num_rows($sql)==1){
               $fetch=mysqli_fetch_array($sql);
               return intval($fetch["fees"]);
           }else{
               return 0;
           }
         }
         
         //Student submit fees 
         function submitFees($sid,$tution,$exam,$sports,$cca,$spSub,$facility)
           { $this->connection();
            $facility=($facility=="")?0:$facility;
            $total=$tution+$exam+$sports+$cca+$spSub+$facility;
            $sql=mysqli_query($this->connect,"INSERT INTO `student-fees`(`student_id`, `tution`, `exam`, `sports`, `cca`, `special_subject`, `facility_fees`, `total_deposit`) 
                                                VALUES ($sid,$tution,$exam,$sports,$cca,$spSub,$facility,$total)");
                if($sql)
                {
                    echo "<script>alert('Amount Paid !!!');location.href='student_fee.php?id=".$sid."'</script>";
                }else{
                    echo '<script>alert("Please Try Again !!!")</script>';
                }

           }
        
           //checks if pending fees
           function checkPendingFees($sid,$total)
           {
               $this->connection();
               $sql=mysqli_query($this->connect,"SELECT `total_deposit` FROM `student-fees` WHERE `student_id`=$sid");
               if($sql){
                   $add=0;
                  while($fetch=mysqli_fetch_array($sql))
                          $add+=$fetch["total_deposit"];
                  if($add<$total)
                    return $total-$add;
                  else
                    return 0;
               }
           }

         //updating facility(HOSTEL/TRANSPORT) fees  
      public function changeFacilityFees($facility,$fees,$page)
      { $this->connection(); 
        $fees=intval($fees);
        $sql="UPDATE `facility_fees` SET `fees`=? WHERE `facility`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("is",$fees,$facility);
        if($stmt->execute())
            echo"<script>alert('".$facility." Fees is Updated to ".$fees."');location.href='".$page.".php';</script>";
        else
            echo"<script>alert('Please Try Again !!');location.href='".$page.".php';</script>";

        $stmt->close();
      }
      
        //shows payment history
    public function paymentHistoryTable($sid)
    {
        $this->connection(); 
        $query=mysqli_query($this->connect,"SELECT  `cnt`,`tution`, `sports`, `cca`, `exam`, `special_subject`, `facility_fees`, `total_deposit`, `paid_on`
                                             FROM `student-fees` WHERE `student_id`=$sid");
        if(mysqli_num_rows($query)>0)
        {?><div class='table-responsive'>
            <table class="table table-hover" >             
                    <thead class="thead-light">
                      <tr>
                         <th>SR.NO.</th>
                        <th>TUTION</th>
                        <th>SPORTS</th>     
                        <th>EXTRA CURR.</th> 
                        <th>EXAM</th>     
                        <th>SP. SUBJECT</th>     
                        <th>FACILITY</th>     
                        <th>TOTAL AMOUNT</th>     
                        <th>PAID ON</th>    
                      </tr>
                    </thead>
                    <tbody style="text-align: left;">
          <?php $i=1; while($fetch=mysqli_fetch_array($query))
                        {?>
                            <tr>
                                <td><?php print $i;?></td>
                                <td><?php print $fetch["tution"]?></td>
                                <td><?php print $fetch["sports"]?></td>
                                <td><?php print $fetch["cca"]?></td>
                                <td><?php print $fetch["exam"]?></td>
                                <td><?php print $fetch["special_subject"]?></td>
                                <td><?php print $fetch["facility_fees"]?></td>
                                <td><b><?php print $fetch["total_deposit"]?></b></td>
                                <td><?php print $fetch["paid_on"]?></td>
                            </tr>
                        <?php $i++;}echo "</tbody></table></div>";
        }else{
            print "<div align='center'  >";
            print "<p style='color:yellow'><strong>No Payment History available.</strong></p>";
            print file_get_contents("../assets/image/empty.svg");
            print '</div>';
        }
       
    }

    //returns remaining fees of studdent
    public function remianingStudentFees($sid,$class,$facility)
    {   
        $this->connection();
        $paid=mysqli_query($this->connect,"SELECT `tution`, `sports`, `cca`, `exam`, `special_subject`, `facility_fees` FROM `student-fees` WHERE `student_id`=$sid");//from student-fees tabl(include facility
        if(mysqli_num_rows($paid)>0){
                     $z=0;   $tution=0; $sports=0;$cca=0;$exm=0;$sps=0;$faf=0;// temp variables
        while($f1=mysqli_fetch_array($paid)){
                $tution += ($f1['tution'])?$f1['tution']:$z;
                $sports += ($f1['sports'])?$f1['sports']:$z;
                $cca+= ($f1['cca'])?$f1['cca']:$z;
                $exm+= ($f1['exam'])?$f1['exam']:$z;
                $sps+= ($f1['special_subject'])?$f1['special_subject']:$z;
                $faf+= ($f1['facility_fees'])?$f1['facility_fees']:$z;
        }
        $fac=$this->facilityfees($facility);//facility fees value
        $fetch =$this->getclassfees($class);//assigned fees by admin

        //substracting to get pending fees for each
        $t= intval($fetch['tution']-$tution);   //tution fees
        $sp= intval($fetch['sports']-$sports);  //sports fees
        $cc= intval($fetch['cca']-$cca);    // Curriculum  fees
        $ex=intval($fetch['exam']-$exm);    //exam fees
        $ss= intval($fetch['special_subject']-$sps);    //specialSubject fees
        $ff= intval($fac-$faf); //facilty fees

        return array ($t,$sp,$cc,$ex,$ss,$ff);
    }else{
        //otherwise return full fees details

       $fetch=$this->getclassfees($class);

       $t=intval($fetch['tution']);
       $sp=intval($fetch['sports']);
       $cc= intval($fetch['cca']);
       $ex=intval($fetch['exam']);
       $ss= intval($fetch['special_subject']);
       $fac=$this->facilityfees($facility);

       return array ($t,$sp,$cc,$ex,$ss,$fac);
    }
    }

      //Hostel ENTRY Functions
      public function ChangeHostelName($hid, $name)
        { $this->connection(); 
            $upd=mysqli_query($this->connect,"UPDATE `hostels` SET `hostel_name`='$name' WHERE `hostel_id`=$hid");
            if($upd)
                echo "<script>alert('Hostel Name Updated to ".$name."');location.href='hostel_details.php?ref=".$hid."'</script>";
            else
                 echo "<script>alert('Plese try Again !!!');location.href='hostel_details.php?ref=".$hid."'</script>";
        }
    
        //retuns hostel name
      public function getHostelName($hid){
        $this->connection(); 
           $name=mysqli_query($this->connect,"SELECT `hostel_name` FROM `hostels` WHERE `hostel_id` = $hid");
           $res=mysqli_fetch_array($name);
           print $res['hostel_name'];
       } 
       
       //list of student to be added in hostel dependin upon gender/class
       public function hostel_studentADD_list($hid){
                if($hid == 1){
                    $this->connection();          
                    $sql=mysqli_query($this->connect,"SELECT student_add.student_id, student_add.FirstName,student_add.MiddleName, student_add.LastName
                                        FROM student_add LEFT JOIN hostel_student ON student_add.student_id = hostel_student.student_id 
                                        WHERE hostel_student.student_id IS NULL and student_add.Facility='HOSTEL' AND 
                                        student_add.current_class >= 5 AND student_add.gender = 'Male' ");
                    print "<option value =''>----SELECT----</option>";
                    while($arr=mysqli_fetch_array($sql)){
                        print "<option value=".$arr[0].">".$arr[1]." ".$arr[2]." ".$arr[3]."</option>";
                    }
                }else if($hid == 3){
                    $this->connection();          
                    $sql=mysqli_query($this->connect,"SELECT student_add.student_id, student_add.FirstName,student_add.MiddleName, student_add.LastName
                                        FROM student_add LEFT JOIN hostel_student ON student_add.student_id = hostel_student.student_id 
                                        WHERE hostel_student.student_id IS NULL and student_add.Facility='HOSTEL' AND 
                                        student_add.current_class < 5 AND student_add.gender = 'Male' ");
                    print "<option value =''>----SELECT----</option>";
                    while($arr=mysqli_fetch_array($sql)){
                        print "<option value=".$arr[0].">".$arr[1]." ".$arr[2]." ".$arr[3]."</option>";
                    }
                }else if($hid == 2){
                    $this->connection();          
                    $sql=mysqli_query($this->connect,"SELECT student_add.student_id, student_add.FirstName,student_add.MiddleName, student_add.LastName
                                        FROM student_add LEFT JOIN hostel_student ON student_add.student_id = hostel_student.student_id 
                                        WHERE hostel_student.student_id IS NULL and student_add.Facility='HOSTEL' AND student_add.gender = 'Female' ");
                    print "<option value =''>----SELECT----</option>";
                    while($arr=mysqli_fetch_array($sql)){
                        print "<option value=".$arr[0].">".$arr[1]." ".$arr[2]." ".$arr[3]."</option>";
                    }
                }
        }

        //addnig student in particular hostel
        public function addStudentToHostel($sid,$hid)
            { $this->connection(); 
                $sid=intval($sid);
                $hid=intval($hid);
                $sql="INSERT INTO `hostel_student`(`student_id`, `hostel_id`) VALUES (?,?)";
                $stmt=$this->connect->prepare($sql);
                $stmt->bind_param("ii",$sid,$hid);

            if($stmt->execute())  
                      echo "<script> alert ('Student Added !!!');location.href='hostel_details.php?ref=".$hid."';</script>";  

            else
                echo "<script>alert('Plese try Again !!!');location.href='hostel_details.php?ref=".$hid."'</script>";
             $stmt->close();

        }  

        //list of stdnt in that hostel
        public function displayStudentInHostel($hid){
            $i = 1;
            $this->connection(); 
            $query=mysqli_query($this->connect,"SELECT student_add.FirstName,student_add.MiddleName,student_add.LastName,
                                student_add.fatherName,student_add.fatherContact,student_add.appliedClass,student_add.locality,student_add.state,
                                student_add.city,student_add.zip,hostel_student.hostel_id ,hostel_student.count
                                FROM student_add INNER JOIN  hostel_student ON student_add.student_id = hostel_student.student_id  
                                WHERE hostel_student.hostel_id = $hid");
           
           while($fetch=mysqli_fetch_array($query)){
               ?>
                <form method="post"><tr>
                <td><?php print $i; ?></td>
                <td><?php print $fetch[0]." ".$fetch[1]." ".$fetch[2];?></td>
                <td><?php print $fetch['fatherName'];?></td>
                <td><?php print $fetch['fatherContact'];?></td>
                <td><?php print $fetch['appliedClass'];?> </td>
                <td><?php print $fetch['locality'].",".$fetch['city'].",".$fetch['state'].", ".$fetch['zip']; ?></td>
                <td><input type="hidden" name="deleteStudent" value="<?php print $fetch['count']?>">
                <button type="submit" name="delete-student" class="btn btn-danger btn-sm">Remove</button> </td>
                </tr></form>
               
                <?php
                $i++;
            }
        }
        //remove student from hostel
        public function delete_Student($cnt,$hostel){
            //Removing Student from a particular Hostel
            $cnt=intval($cnt);
                $this->connection();   
                $sql="DELETE FROM `hostel_student` WHERE  `count` =?";
                $stmt=$this->connect->prepare($sql);
                $stmt->bind_param("i",$cnt);
                if($stmt->execute())
                   echo" <script> alert('Student Removed !!!');location.href='hostel_details.php?ref=".$hostel."'; </script>  ";  
      }       

        
        //STUDY MATERIAL related Fnctions 
       //adding material
        public function addMaterial($fileName, $fileError, $fileSize, $fileTmpName, $name, $subject, $type, $DOS, $class){
            $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));
            
            $allowed= array('jpg','jpeg','png','pdf','doc','docx','txt');
            
            if(in_array($fileActualExt,$allowed)){
              if($fileError === 0){
                if($fileSize < 1048576){
                    $fileNameNew=uniqid(''.true).".".$fileActualExt ;
                    
                    $fileDestination='../../uploads/study_materials/'.$class.'/'.$fileNameNew ;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $this->connection();   
                    $sql=mysqli_query($this->connect,"INSERT INTO `study_material`(`class`, `material_name`,
                                                     `subject`, `fileName`, `material_type`, `submission_Date`) 
                                                     VALUES ('$class','$name','$subject','$fileNameNew','$type','$DOS')");  
                    
                    echo "<script>alert('File Uploaded Successfully');location.href='class-materials.php?class=".$class."';</script>";
                }else{
                  echo "<script>document.getElementById('getMsg').innerHTML += 'Your File size is too Large !!';</script>";
                }
              }else{
                echo"<script>document.getElementById('getMsg').innerHTML += 'There was an Error uploading your file !!'</script>";
              }
            }else{
              echo "<script>document.getElementById('getMsg').innerHTML += 'You cannot upload this type of File !!';</script>";
            }
        }    

       //returns materials
        public function getMaterials($class){
            $this->connection(); 
            $query=mysqli_query($this->connect,"SELECT `cnt`,`class`, `material_name`, `subject`, `fileName`, `material_type`, 
            `creation_Date`, `submission_Date` FROM `study_material` WHERE `class`= $class ");
           if(mysqli_num_rows($query)>0){?>
                <div class="table-responsive">    
                <table class="table table-hover" style="font-size:15px;">             
                    <thead class="thead-dark">
                      <tr>
                         <th>Sr No.</th>
                        <th>Material</th>
                        <th>Subject</th>     
                        <th>Type</th> 
                        <th>Provided On</th>     
                        <th>Date Of Submission</th>     
                        <th>Action</th>     
                      </tr>
                    </thead>
                    <tbody style="text-align: left;">
           <?php $i = 1;
            while($fetch=mysqli_fetch_array($query)){
                $sub="";
                        if($fetch['submission_Date']=='0000-00-00 00:00:00' ){
                            $sub = "NONE";
                        }else if($fetch['submission_Date']== NULL){
                            $sub = "NONE";
                        }else{
                            $sub = $fetch['submission_Date'];
                        }
            ?><form method='post'>
                <tr>
                <td><?php print $i ?></td>
                <td><?php print $fetch['material_name'];?> </td>
                <td><?php print  $fetch['subject'];?></td>
                <td><?php print $fetch['material_type']; ?></td>
                <td><?php print $fetch['creation_Date']; ?></td>
                <td><?php print $sub ?> </td>
                <td><a href="../../uploads/study_materials/<?php echo $fetch["class"] ?>/<?php echo $fetch['fileName']?>" target="_blank" rel="noopener noreferrer">
                 <button type="button" class="btn btn-warning btn-sm">view</button></a><span style="margin-left:50px"></span>
                 <input type="hidden" name="delete-material" value="<?php print $fetch['cnt']?>">
                 <button type='submit' name='deleteMaterial' class='btn btn-danger btn-sm'>Remove</button> </td>
                 </tr>
                 </form>
               <?php
                $i++;}
                    echo " </tbody>
                    </table> 
            </div>";
            }
                else{
                    print "<div align='center'>";
                    print "<h4><strong>There is no entry available.</strong></h4>";
                    print file_get_contents("../assets/image/empty.svg");
                    print '</div>';
          }
            }
        
         //Removing material
        public function removeMaterial($val,$class){
            $this->connection();   

            $val=intval($val);
            $sql="SELECT `fileName`,`class` FROM `study_material` WHERE `cnt`=?";
            $stmt= $this->connect->prepare($sql);
            $stmt->bind_param("i",$val);
            $stmt->execute();
            $stmt->store_result();
             $stmt->bind_result($material,$cls);
            $stmt->fetch();

        if($stmt->num_rows == 1)
           {
                   $path="../../uploads/study_materials/".$cls."/".$material."";
                   echo $path;
               if(!file_exists($path)){
                    echo "<script>alert('No files to remove');location.href='class-materials.php?class=".$class."'; </script>";
                }else{
                    if(!unlink($path))
                    echo '<script>alert("Error while removing !!");location.href="class-materials.php?class='.$class.'";</script>';
                
                else{
                    $query="DELETE FROM `study_material` WHERE `cnt` = ?";
                    $stmt1=$this->connect->prepare($query);
                    $stmt1->bind_param("i",$val);

                    if($stmt1->execute()){
                        
                    echo "<script> alert('Material removed !!');location.href='class-materials.php?class=".$class."'; </script> ";  

                    }else{
                    echo "<script> alert('File doesn't exist !!');location.href='class-materials.php?class=".$class."'; </script> ";  

                    }     
                    $stmt1->close();             
                }
            }
            
            $stmt->close();
            }
        }
       
        //Exam scheduling methods
        
        //list of classes not having  exam schedule assigned
        public function classScheduleToAdd(){
            $this->connection(); 
            $class_fetch=mysqli_query($this->connect,"SELECT `classes` FROM `exam` WHERE `presence` = 0");
            if(mysqli_num_rows($class_fetch)>0){
            while($fetch=mysqli_fetch_array($class_fetch)){?>
                <option value="<?php print $fetch['classes'];?>"><?php print $fetch['classes']; ?></option>
           <?php } }else{
               echo "NONE";
           }
        }

        //adding exm schedule to class
        public function addExmSch($fileName, $fileError, $fileSize, $fileTmpName,$class){
            $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));
            
            $allowed= array('jpg','jpeg','png');
            
            if(in_array($fileActualExt,$allowed)){
              if($fileError === 0){
                if($fileSize < 1048576){
                    $fileNameNew=uniqid(''.true).".".$fileActualExt ;
                    
                    $fileDestination='../uploads/examSch/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                   
                    $this->connection();  
                    $sql=mysqli_query($this->connect,"UPDATE `exam` SET `presence`= 1,`file_name`='$fileNameNew' WHERE `classes`='$class'");  
                    if($sql){
                        echo "<script>alert('Uploaded Successfully');location.href='admin_examination.php';</script>";}
                        else {
                        echo "<script>alert('Error while Uploading!! Try again!')</script>";}
                    
                }else{
                  echo "<script>document.getElementById('getMsg').innerHTML += 'Your File size is too Large !!';</script>";
                }
              }else{
                echo"<script>document.getElementById('getMsg').innerHTML += 'There was an Error uploading your file !!'</script>";
              }
            }else{
              echo "<script>document.getElementById('getMsg').innerHTML += 'You cannot upload this type of File !!';</script>";
            }
          }

            //view exam schedule of particular class
          public function viewMySch(){
            $this->connection();   
            $results = mysqli_query($this->connect,"SELECT  `presence` FROM `exam` WHERE 1");
            $v=0;
            while($fetch=mysqli_fetch_row($results)){
                $v+=intval($fetch[0]);}
                if($v){?>
                <div class="table-responsive">    
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th >Sr.No.</th>
                                <th>Class</th>
                                <th>Class Teacher</th>
                                <th>Action</th></tr>
                        </thead>
                        <tbody><form method="GET">
                           <?php 
                            $view_tt=mysqli_query($this->connect,"SELECT exam.classes,time_table.class_teacher_id  FROM exam INNER JOIN
                                                              time_table ON exam.classes = time_table.classes WHERE exam.presence = 1 ");
                            $index=1;
                            while($get_tt=mysqli_fetch_array($view_tt)){
                            ?><tr>
                                <td><?php print $index ?></td>
                                <td><?php print $get_tt['classes'];?></td>
                                <td><?php print ($name=$this->getClassTeacher($get_tt['classes']))? $name:"Not Assigned Yet";?></td>
                                <td><a href="exam/view.php?class=<?php print $get_tt['classes']?>">
                                 <button type="button" class="btn btn-info"> VIEW</button></a></td>
                            </tr><?php $index++;}?>
                        </form></tbody>
                    </table></div>
               <?php }else{?><div align='center'>
                             <?php 
                             print "<p><strong>There is no entry available.</strong></p>";
                             print file_get_contents("../admin/assets/image/empty.svg"); ?>
                        </div>
               <?php }
          }

          //to view the selected class Examination Schedule
          public function examSchView($class){
              $this->connection();
              $imgres=mysqli_query($this->connect,"SELECT exam.file_name,time_table.classes FROM exam 
              INNER JOIN time_table ON exam.classes = time_table.classes WHERE exam.presence = 1 and exam.classes='$class'");
             if(mysqli_num_rows($imgres)==1){
                 while($get=mysqli_fetch_array($imgres)){?>
                 <div class="table-view">
                    <?php
                    if(!file_exists("../../uploads/examSch/". $get['file_name']."")){
                        $update=mysqli_query($this->connect,"UPDATE `exam` SET `presence`=0 WHERE `classes`= '$class'");
                        if($update){
                            header("location:../admin_examination.php");
                        }                      
                     }else {
                       echo '<img src="../../uploads/examSch/'. $get['file_name'].'" style="width:80%">';
                     }
                ?>
                       <div class="info-box">
                        Assigned Class Teacher: <b><?php print ($name=$this->getClassTeacher($get['classes']))? $name:"<i>Not Assigned Yet</i>"; ?></b> <br>
                        </div>
                        <div>
                    <a href="#" data-toggle="modal" data-target="#update-exam">
                            <button type="button" class="btn btn-warning">Update</button></a></br></br>
                    </div>
                  </div> 
                <?php }
             }else{?><div align='center'>
                <?php 
                    print "<p><strong>There is no entry available.</strong></p>";
                    print file_get_contents("../../admin/assets/image/empty.svg"); ?>
           </div>
        <?php }
        }

        public function updateExamSchedule($fileName, $fileError, $fileSize, $fileTmpName,$class)
        {                   
       $this->connection();  
       
       $fileExt = explode('.',$fileName);
           $fileActualExt = strtolower(end($fileExt));
           $allowed= array('jpg','jpeg','png');
           
           if(in_array($fileActualExt,$allowed)){

             if($fileError === 0){

               if($fileSize < 1048576){
                       // now remove old one first
                       $getFile=mysqli_query($this->connect,"SELECT `classes`, `file_name` FROM `exam` WHERE `classes`='$class'  AND `presence`=1");
                           if(mysqli_num_rows($getFile)===1){
                                   $result=mysqli_fetch_row($getFile);
                           $path="../../uploads/examSch/$result[1]";

                           if(!file_exists($path)){
                                   echo '<script>alert("File does not exist ");location.href="view.php?class='.$class.'";</script>';
                           }  
                           else{
                            if(!unlink($path)){
                                echo '<script>alert("Error while removing ");location.href="view.php?class='.$class.'";</script>';
                        }else{
                   // now add new one
                   $fileNameNew=uniqid(''.true).".".$fileActualExt ;
                   
                   $fileDestination='../../uploads/examSch/'.$fileNameNew;
                   move_uploaded_file($fileTmpName, $fileDestination);
                 
                   $sql=mysqli_query($this->connect,"UPDATE `exam` SET `presence`= 1,`file_name`='$fileNameNew' WHERE `classes`='$class'");  
                   
                   echo "<script>alert('".$class." Exam Schedule Updated Successfully');location.href='../admin_examination.php'</script>";
                }                
            }
        }else{
                echo '<script>alert("You cannot update this Exam Schedule");location.href="view.php?class='.$class.'"</script>';
            }
               }else{
                 echo "<script>document.getElementById('getMsg').innerHTML += 'Your File size is too Large !!';</script>";
               }
             }else{
               echo"<script>document.getElementById('getMsg').innerHTML += 'There was an Error uploading your file !!'</script>";
             }
           }else{
             echo "<script>document.getElementById('getMsg').innerHTML += 'You cannot upload this type of File !!';</script>";
           }
         }
         

        //TIME TABLE  methods

        public function getClassTeacher($class){//for timetable and exam only
            $this->connection();
            $sql=mysqli_query($this->connect,"SELECT staff_add.FirstName,staff_add.MiddleName, staff_add.LastName FROM staff_add 
                                LEFT JOIN time_table ON staff_add.staff_id = time_table.class_teacher_id WHERE time_table.classes='$class' ");
            if(mysqli_num_rows($sql)==1){
                $fetch=mysqli_fetch_array($sql);
                $name= $fetch["FirstName"].' '.$fetch["MiddleName"].' '.$fetch["LastName"];
                return $name;
            }
        }
        
        //adding timeTable
        public function addTimeTable($fileName, $fileError, $fileSize, $fileTmpName,$class){
            $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));
            
            $allowed= array('jpg','jpeg','png');
            
            if(in_array($fileActualExt,$allowed)){
              if($fileError === 0){
                if($fileSize < 1048576){
                    $fileNameNew=uniqid(''.true).".".$fileActualExt;
                    
                    $fileDestination='../uploads/time-table/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                  
                    $this->connection();  
                    $sql=mysqli_query($this->connect,"UPDATE `time_table` SET `present`= 1,`file_name`='$fileNameNew' WHERE `classes`='$class'");  
                    
                    echo "<script>alert('Time-Table Added Successfully');location.href='admin_timetable.php';</script>";
                }else{
                  echo "<script>document.getElementById('getMsg').innerHTML += 'Your File size is too Large !!';</script>";
                }
              }else{
                echo"<script>document.getElementById('getMsg').innerHTML += 'There was an Error uploading your file !!'</script>";
              }
            }else{
              echo "<script>document.getElementById('getMsg').innerHTML += 'You cannot upload this type of File !!';</script>";
            }
          }

        //table veiw of all timeTables
      public function getTimeTable(){
        $this->connection();   
        $results = mysqli_query($this->connect,"SELECT `present`,`classes`,`file_name` FROM `time_table` WHERE `present`=1");
        
            if(mysqli_num_rows($results)>0){?>
            <div class="table-responsive">    
                <table class="table table-bordered ">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sr.No.</th>
                            <th>Class</th>
                            <th>Class Teacher</th>
                            <th >Action</th></tr>
                    </thead>
                    <tbody><form method="GET">
                        <?php 
                        $view_tt=mysqli_query($this->connect,"SELECT `classes` FROM `time_table` WHERE `present`=1");
                        $index=1;
                        while($get_tt=mysqli_fetch_array($view_tt)){   
                        ?><tr>
                            <td><?php print $index ?></td>
                            <td><?php print $get_tt['classes'];?></td>
                            <td><?php print ($name=$this->getClassTeacher($get_tt['classes']))? $name:"Not Assigned";?></td>
                            <td><a href="time-table/view.php?class=<?php print $get_tt['classes']?>">
                             <button type="button" class="btn btn-info"> VIEW</button></a></td>
                        </tr><?php $index++;}?>
                    </form></tbody>
                </table></div>
           <?php }else{?><div align='center'>
                         <?php 
                         print "<p><strong>There is no entry available.</strong></p>";
                         print file_get_contents("../admin/assets/image/empty.svg"); ?>
                    </div>
           <?php }
         }

         //view timetable function
      public function viewMyTimeTable($class){
            $this->connection();
            $imgres=mysqli_query($this->connect,"SELECT `file_name`, `class_teacher_id`,`classes`  FROM `time_table` WHERE `classes`='$class' and `present`=1");
            if(mysqli_num_rows($imgres)>0){
                while($get=mysqli_fetch_array($imgres)){?>
                <strong><p align="center" style="color:#FF0000" id="getMsg"></p></strong>
                <div class="table-view">
                <?php
                    if(!file_exists("../../uploads/time-table/". $get['file_name']."")){
                        $update=mysqli_query($this->connect,"UPDATE `time_table` SET `present`=0 WHERE `classes`= '$class'");
                        if($update){
                            header("location:../admin_timetable.php");
                        }                      
                     }else {
                       echo '<img src="../../uploads/time-table/'. $get['file_name'].'" style="width:100%">';
                     }
                ?>
                    <div class="info-box">
                    Assigned Class Teacher: <b><?php print ($name=$this->getClassTeacher($get['classes']))? $name:"Not Assigned Yet";?></b> <br>
                    </div>
                <div>
                    <a href="#" data-toggle="modal" data-target="#update-timetable">
                            <button type="button" class="btn btn-warning">Update</button></a></br></br>
                    </div>
                </div> 
            <?php }
        }else{?><div align='center'>
            <?php 
            print "<p><strong>There is no entry available.</strong></p>";
            print file_get_contents("../assets/image/empty.svg"); ?>
       </div>
        <?php }
        }


        //check if updated 
        //updating timetable
     public function updateTimeTable($fileName, $fileError, $fileSize, $fileTmpName,$class){
                 
       $this->connection();  
       
        $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed= array('jpg','jpeg','png');
            
            if(in_array($fileActualExt,$allowed)){

              if($fileError === 0){

                if($fileSize < 1048576){
                        // now remove old one first
                        $getFile=mysqli_query($this->connect,"SELECT `classes`, `file_name` FROM `time_table` WHERE `classes`='$class'  AND `present`=1");
                            if(mysqli_num_rows($getFile)===1){
                                    $result=mysqli_fetch_row($getFile);
                            }else{
                                echo '<script>alert("You cannot update this Time Table ");location.href="view.php?class='.$class.'"</script>';
                            }

                            $path="../../uploads/time-table/$result[1]";
                            if(!unlink("$path")){
                                    echo '<script>alert("Error while Updating this Time Table ");location.href="view.php?class='.$class.'"</script>';

                            }else{
                    // now add new one

                    $fileNameNew=uniqid(''.true).".".$fileActualExt ;
                    
                    $fileDestination='../../uploads/time-table/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                  
                    $sql=mysqli_query($this->connect,"UPDATE `time_table` SET `present`= 1,`file_name`='$fileNameNew' WHERE `classes`='$class'");  
                    
                    echo "<script>alert('".$class." Time Table Updated Successfully');location.href='../admin_timetable.php'</script>";
                     }
                }else{
                  echo "<script>document.getElementById('getMsg').innerHTML += 'Your File size is too Large !!';</script>";
                }
              }else{
                echo"<script>document.getElementById('getMsg').innerHTML += 'There was an Error uploading your file !!'</script>";
              }
            }else{
              echo "<script>document.getElementById('getMsg').innerHTML += 'You cannot upload this type of File !!';</script>";
            }
          }
        

     //returns list of classes whose TimeTable has not been added yet
      public function availableClassToAdd(){
        $this->connection(); 
            $class_fetch=mysqli_query($this->connect,"SELECT `classes` FROM `time_table` WHERE `present` = 0");
            if(mysqli_num_rows($class_fetch)>0){
            while($fetch=mysqli_fetch_array($class_fetch)){?>
                <option value="<?php print $fetch['classes'];?>"><?php print $fetch['classes']; ?></option>
        <?php }}
        }

        //notice queries
        //validating
        public function validateNoticeID($nid)
        {   $this->connection(); 
            $res=mysqli_query($this->connect,"SELECT `count` FROM `notice` WHERE `count`=$nid");
            if(mysqli_num_rows($res)==1)
                return true;
            else return false;
        }

        //adding new notice
        public function make_notice($type,$notice){
            $this->connection(); 
            $add=mysqli_query($this->connect,"INSERT INTO `notice`( `type`, `notice_body`) VALUES('$type','$notice')");
            if($add) {
                echo"<script>alert('Submitted!!');location.href='admin_notice.php'</script>";
               }else{
                   echo"<script>alert('Please Try Again!!!')</script>";
               } 
            }
            // all notice view
        public function getAllNotice(){
            $this->connection(); 
            $notice=mysqli_query($this->connect,"SELECT `count`,`type`, `notice_body`, `created_on` FROM `notice` ORDER BY count DESC ");
            while($fetch=mysqli_fetch_array($notice)){?>
            <div class="notice-heading"><h4><?php print $fetch['type']; ?></h4></div>
            <div class="notice-box">
            <small class="notice-date">CREATED ON : <?php print $fetch['created_on']; ?></small>
            <p><small><?php echo substr($fetch['notice_body'], 0,300 ).". . . . . . . ."; ?></small></p> 
           <div align="right"><a href="notice/full_view.php?id=<?php echo $fetch['count'];?>"><button class="btn btn-sm btn-danger">Read More .  .</button></a></div>
            </div>
            <?php
            }
        }

        //view particular notice full
        public function viewFullNotice($nid){
           $this->connection();
           $body=mysqli_query($this->connect,"SELECT `count`, `type`, `notice_body`, `created_on`,`visibility` FROM `notice` WHERE `count`=$nid ");
           if(mysqli_num_rows($body)==1)
            {
             $get=mysqli_fetch_array($body);?>
           <div class="notice-heading" align="center"><h4><?php print $get['type']; ?></h4></div><br>
            <div class="notice-box">
            <small class="notice-date">CREATED ON : <?php print $get['created_on']; ?></small>
            <p><?php echo $get['notice_body'];?></p> 
            <form method="POST">
            <a href="editNotice.php?noticeId=<?php echo $nid;?>"><button type="button" class="btn btn-warning">Edit </button></a>
            <span style="margin:0 25px"></span>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
            
            <?php echo ($get['visibility'])? '<button class="float-right btn btn-info" name="unsee" value="'.$get['count'].'">DON\'T SHOW</button>' : '<button  value="'.$get['count'].'" name="see" class="float-right btn btn-primary">SHOW</button>' ?>
            </form></div>      
           <?php }}

            //making notice invisible 
           public function markInvisible($getID){
            $this->connection();
           $update=mysqli_query($this->connect,"UPDATE `notice` SET `visibility` = 0 WHERE `notice`.`count` =$getID") ;
           if($update)
            echo "<script>alert('It will not be visible to Every one !!!');location.href='full_view.php?id=".$getID."'</script>";
            else
             echo "<script>alert('Please Try afetr Sometime !!!');location.href='full_view.php?id=".$getID."'</script>";
            
           }

            //making notice visible
           public function makeVisible($getID){
            $this->connection();
           $update=mysqli_query($this->connect,"UPDATE `notice` SET `visibility` = 1 WHERE `notice`.`count` =$getID") ;
           if($update)
            echo "<script>alert('It will be visible to Every one !!!');location.href='full_view.php?id=".$getID."'</script>";
            else
             echo "<script>alert('Please Try afetr Sometime !!!');location.href='full_view.php?id=".$getID."'</script>";
            
           }
        //make changes to notice
       public function editMyNotice($nid){
        $this->connection();
        $body=mysqli_query($this->connect,"SELECT  `type`, `notice_body`, `created_on` FROM `notice` WHERE `count`=$nid");
        return $get=mysqli_fetch_array($body);
       }
    
       //updating notice
       public function updateNotice($body,$nid){
        $this->connection();
        $c=mysqli_query($this->connect,"UPDATE `notice` SET `notice_body`='$body' WHERE `count`=$nid");
        if($c){
            echo "<script>alert('updated Successfully');location.href='full_view.php?id=".$nid."'</script>";
        }else{
            echo "<script>alert('Caught an Error!!!');</script>";
        }
       }

       //deleting notice
       public function deleteNotice($nid){
           $this->connection();
           $check=mysqli_query($this->connect,"DELETE FROM `notice` WHERE `count`=$nid");
           if($check){
               echo"<script>alert('Removed Succesfully');location.href='../admin_notice.php'</script>";
           }
       }

           //TRANSPORT ROUTING  
           //validating
        public function validateRoute($route)
        {
            $this->connection(); 
            $res=mysqli_query($this->connect,"SELECT `route_no` FROM `routes` WHERE `route_no`=$route");
            if(mysqli_num_rows($res)==1)
                return true;
            else return false;
        }

        //tmp route no
        public function getRouteNum(){
            $this->connection(); 
            $res=mysqli_query($this->connect,"SELECT `route_no` FROM `routes` WHERE 1");
            if(mysqli_num_rows($res)== 0){
                print 1;
            }
            else{ while(($fetch=mysqli_fetch_array($res)) && (mysqli_num_rows($res)>0)) 
                {   
                    $val=$fetch[0] ; 
                }
                    print $val+1;
            }
        }
        
        //add new route
        public function addNewRoute($name,$road1,$road2,$road3,$driverName,$driverContact){
            $this->connection(); 
            $contact=intval($driverContact);
            $sql="INSERT into `routes`(`name`,`road1`, `road2`, `road3`, `driver_name`, `driver_contact`) VALUES(?,?,?,?,?,?)";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("sssssi",$name,$road1,$road2,$road3,$driverName,$contact);
            if($stmt->execute())
                     echo"<script>alert('A new Route added successfully');location.href='admin_transport.php';</script>"; 
            else
                    echo"<script>alert('Pleasse Try Again !!!');location.href='admin_transport.php';</script>"; 
            $stmt->close();
        }

        //   geting route name 
       public function routeName($ref)
       {
           $this->connection(); 
        $query=mysqli_query($this->connect,"SELECT `name` FROM `routes` WHERE `route_no`='$ref'");
        $get=mysqli_fetch_array($query);
              print "Route : ".$get['name']."";
        }

        //displays Route Informations
        public function routeInfo($ref_id){           
            $this->connection(); 
         $query=mysqli_query($this->connect,"SELECT  `name`, `road1`, `road2`, `road3`, `dateOfAddtion`, `driver_name`, `driver_contact` FROM `routes` WHERE `route_no`='$ref_id'");
        $results=mysqli_fetch_array($query);
              print "Route name : <b>".$results[0]."</b></br>";
              print "Direction :  <b>".$results[1]." <small>-> </small> ".$results[2]." <small>-> </small> ".$results[3]."</b><br>";
              print "Driver Name : <b>".$results[5]."</b><br>";
              print "Driver Contact : <b>".$results[6]."</b>";
              print "<span style='float:right'>Date of Addition : ".date("d-m-Y", strtotime($results[4]))."</span>";                                                                                                    
        }
    
        //Displays students List who are taking that route bus
        public function transport_student_list($id){
            $id=intval($id);
            $this->connection(); 
            $query=mysqli_query($this->connect,"SELECT student_transport.count,student_add.FirstName,student_add.MiddleName,student_add.LastName,
                                student_add.fatherName,student_add.fatherContact,student_add.current_class,student_transport.route_id 
                                FROM student_add INNER JOIN  student_transport ON student_add.student_id = student_transport.student_id  
                                WHERE student_transport.route_id = $id ");
           if(mysqli_num_rows($query)>0)
           {$i = 1;
           while($fetch=mysqli_fetch_array($query)){?>
            <form method="POST">
                <tr>
                <td><?php print $i;?></td>
                <td><?php print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];?></td>
                <td>CLass <?php print $fetch['current_class']; ?></td>                
                <td><?php print $fetch['fatherName'];?></td>
                <td><?php print $fetch['fatherContact'];?></td>
                <td><input type="hidden" name="deleteStudent" value="<?php print $fetch['count'];?>"/>
                     <button type='submit' name='delete-student' class='btn btn-danger'>Remove</button> </td>                
                </tr></form>
               <?php $i++;
            }
        }}

        //function to add student in that particular route
     public function addStudentToRoute($nameID,$routeID){
           
        $this->connection();    
        $nameID=intval($nameID);
        $routeID=intval($routeID);
        $sql="INSERT INTO `student_transport`(`student_id`, `route_id`) VALUES (?,?)";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("ii",$nameID,$routeID);
        if($stmt->execute())
            echo "<script> alert ('Submitted Successfully');location.href='transport_student.php?id=".$routeID."';</script>";    
        else
         echo "<script> alert ('Please try Again');location.href='transport_student.php?id=".$routeID."';</script>";    
}
        
        //this function remove student from transportation facility
        public function removethisStudentFrmRoute($stdrouteID,$route)
        {
            $this->connection();    
            $sql="DELETE FROM `student_transport` WHERE `count`=?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("i",$stdrouteID);
        
         if($stmt->execute())
             echo "<script>alert('This student is Removed !! ');location.href='transport_student.php?id=".$route."';</script>";
         else
             echo "<script>alert('Please Try Again !! ');location.href='transport_student.php?id=".$route."';</script>";
            
           $stmt->close();  
        }
    
        //displays select option containing student who opted for transport facility but havent been alloted a route bus  
        public function transport_studentADD_list(){
             $this->connection();          
            $sql=mysqli_query($this->connect,"SELECT student_add.student_id, student_add.FirstName,student_add.MiddleName, student_add.LastName
                                FROM student_add LEFT JOIN student_transport ON student_add.student_id = student_transport.student_id 
                                WHERE student_transport.student_id IS NULL and student_add.Facility='TRANSPORT'");
            print "<option value =''>----SELECT----</option>";
            while($arr=mysqli_fetch_array($sql)){
                print "<option value=".$arr['student_id'].">".$arr['FirstName']." ".$arr['MiddleName']." ".$arr['LastName']."</option>";
            }
        }
     
        //route table view
        public function getRouteList(){  
            $i=1;        
            $this->connection();          
            $sql=mysqli_query($this->connect,"SELECT `name`,`road1`, `road2`, `road3`,`route_no` FROM `routes` WHERE 1");   

            while($fetch=mysqli_fetch_array($sql)){?>
            <form method="post">
                <tr><td><?php   print $i;?></td>
                    <td><?php   print $fetch['name'];?></td>
                    <td><?php   print $fetch['road1'];?></td>
                    <td><?php   print $fetch['road2'];?></td>
                    <td><?php   print $fetch['road3'];?></td>
                    <td> <a href="transport/transport_student.php?id=<?php echo $fetch['route_no']?>"><button type='button' class='btn btn-custom'>View Details</button></a></td>  
                    <td><a href="transport/transport_routeEdit.php?id=<?php echo $fetch['route_no']?>"><button type="button" class="btn btn-warning btn-sm">EDIT</button></a></td>    
                </tr>
            </form>
                <?php  $i++;}  
        }
                
        // route viw page 
        public function routeEdit($rno)
        {
            $this->connection();
            $edit=mysqli_query($this->connect,"SELECT `route_no`, `name`, `driver_name`, `driver_contact`, `road1`, `road2`, `road3`, `dateOfAddtion` FROM `routes` WHERE `route_no`=$rno");
            $fetch=mysqli_fetch_array($edit);
           return $fetch;
        }

        //update route details
        public function updateDetailsOfRoute($rn,$name,$r1,$r2,$r3,$driverName,$driverContact)
        {
            $rn=intval($rn);
            $contact=intval($driverContact);
            $sql="UPDATE `routes` SET `name`=?,`road1`=?,`road2`=?,`road3`=?, `driver_name`=?,`driver_contact`=? WHERE `route_no`=?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("sssssii",$name,$r1,$r2,$r3,$driverName,$contact,$rn);
            if($stmt->execute()){
                echo "<script>alert('Details Updated Successfully !!! ');location.href='../admin_transport.php'</script>";
            }else{
                echo "<script>alert('Please Try Again !!! ');location.href='../transport/transport_routeEdit.php?id=".$rn."'</script>";
            }
          $stmt->close();
        }
        //delete route
        public function removeThisRoute($rno)
        {
            $this->connection();
            $rno=intval($rno);
            $sql="DELETE FROM `routes` WHERE `route_no`=?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("i",$rno);
            if($stmt->execute())
            {
                $stmt->close();
                $rem_std=mysqli_query($this->connect,"DELETE FROM `student_transport` WHERE `route_id`=$rno");
                if($rem_std)
                    echo "<script>alert('Route ".$rno." removed !!!');location.href='../admin_transport.php'</script>";
                else
                    echo "<script>alert('Please Try Again !!! ');location.href='../transport/transport_routeEdit.php?id=".$rn."'</script>";
                            
            }else{
                echo "<script>alert('Please Try Again !!! ');location.href='../transport/transport_routeEdit.php?id=".$rn."'</script>";

            }
        }
        //LIBRARY FUNCTIONS 
        //fine get function
       public function getLibFine(){
           $this->connection();
           $sq=mysqli_query($this->connect,"SELECT `rate_per` FROM `lib_fine` WHERE 1");
           if(mysqli_num_rows($sq)){
               $fetch=mysqli_fetch_array($sq);
               return $fetch['rate_per'];
           }else return 0;
       }
       //fine updation
       public function updateLibFine($value){
        $this->connection();
        $sql_update=mysqli_query($this->connect,"UPDATE `lib_fine` SET `rate_per`= $value WHERE 1");
        if($sql_update){
            echo "<script>alert('Fine update with ".$value."');location.href='admin_library.php';</script>";
        }else{
            echo "<script>alert('Please Try again !!');location.href='admin_library.php';</script>";
        }
       }
       
       //this function updates fine of evry candiadate
       function updateEveryStudentFine()
       {
           $this->connection();
           $fine=$this->getLibFine();
           $getdetail=mysqli_query($this->connect,"SELECT  `srn`, `book_id`, `student_id`, `returnStatus`, `returnDate`, `return_made_on`,`fine`
                                                    FROM `lib_student_bookstatus` WHERE `returnStatus`= 0 ");
            if($getdetail){
                while($fetch=mysqli_fetch_array($getdetail))
                {
                    $now = time(); // or your date as well
                    $your_date = strtotime($fetch['returnDate']);
                    $datediff = $now - $your_date;
                    $days=(($d=round($datediff / (60 * 60 * 24)) -1) < 0)? 0:$d;

                    $total=$days*$fine;
                    $sid=intval($fetch['student_id']);
                    $no=intval($fetch['srn']);
                    $bid=$fetch['book_id'];

                    $upd=mysqli_query($this->connect,"UPDATE `lib_student_bookstatus` SET `fine`= $total WHERE `student_id`=$sid and
                                                     `returnStatus`= 0 and `srn`= $no and `book_id`='$bid'");
                    if($upd){
                        echo "<script>alert('Fines Updated Successfully !!!');location.href='admin_library.php'</script>;";
                    }else{
                        echo "<script>alert('Error Occured !!!');location.href='admin_library.php'</script>;";
                    }
                }
            }else{
                 echo "<script>alert('Please Try again !!');location.href='admin_library.php';</script>";
            }
       }

       
       //adding new book to book bank
        public function addNewBook($bid,$bname,$sub,$copies,$publication,$author,$YOP,$pubCon)
        {
            $this->connection();
            $sql="SELECT `book_id` FROM `lib_addbook` WHERE`book_id`=?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("s",$bid);
            $stmt->execute();
            $stmt->store_result();
        //check if already exist if NOt then ADD
        if($stmt->num_rows > 0){
            echo "<script>alert('This Book Id is Already registered !!');location.href='book_add.php'</script>";
            $stmt->close();}
        else{
            $this->connection();
                $copies=intval($copies);
                $YOP=intval($YOP);
                $qry="INSERT INTO `lib_addbook`(`book_id`, `book_name`, `subject`, `copies`, `yearOfpublicn`,`publication`, `author`, `publisherContact`) VALUES
                                 (?,?,?,?,?,?,?,?)";
                $stmt2=$this->connect->prepare($qry);
                $stmt2->bind_param("sssiisss",$bid,$bname,$sub,$copies,$YOP,$publication,$author,$pubCon);
                
                if($stmt2->execute())
                echo "<script>alert('Book Added Successfully!!');location.href='../admin_library.php';</script>";
                else
                echo "<script>alert('Error while Submitting your Request!! Retry');location.href='book_add.php'</script>";
                
                $stmt2->close();
        }
       }
        
       public function validateBookcnt($bcnt)
       {
           $this->connection();
           $bcnt=intval($bcnt);
           $sql="SELECT `cnt` FROM `lib_addbook` WHERE `cnt`=?";
           $stmt=$this->connect->prepare($sql);
           $stmt->bind_param("i",$bcnt);
           $stmt->execute();
           $stmt->store_result();
           if($stmt->num_rows == 1)
               return true;
           else    
               return false;
           $stmt->close();
        }
       
       

        //book list
        public function getBookBankList(){
            $this->connection();
            $getbooklist=mysqli_query($this->connect,"SELECT `cnt`,`book_id`, `book_name`, `subject`, `copies`, `publication`, `author` FROM `lib_addbook` WHERE 1");
            if(mysqli_num_rows($getbooklist)>0){?>
                <div class="table-responsive" >
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>Subject</th>
                            <th>Author</th>
                            <th>Copies</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <form method="POST">
                        <tbody style="text-align: left;">
                <?php 
                        $i=1;
                        while($give=mysqli_fetch_array($getbooklist)){?>
                        <tr>
                            <td><?php print $i; ?></td>
                            <td><?php print $give['book_id'];?></td>
                            <td><?php print $give['book_name'];?></td>
                            <td><?php print $give['subject'];?></td>
                            <td><?php print $give['author']?></td>
                            <td><?php print $give['copies'];?></td>
                            <td>                         
                              <a href="library/book_edit.php?id=<?php echo $give['cnt'];?>">
                                <button type="button" style="float:center" class="btn btn-warning">Edit</button>  
                              </a>                     
                            </td>
                        </tr>
                        <?php $i++;}?>
                        </tbody>  
                        </form> 
                    </table>  
                </div>           
           <?php }else{
                print "<h5 style='color:red'>There is no entry available.</h5></br>";
                 print file_get_contents("../admin/assets/image/empty.svg");
                     }
         }

         //all stdent issues list
        public function getissuedBookList()
        {         $this->connection();
            $bookIsuuedList=mysqli_query($this->connect,"SELECT b.book_id,b.book_name ,s.student_id,s.FirstName, s.MiddleName,s.LastName, lbs.class,lbs.issueDate,lbs.fine,lbs.returnStatus   
                                                        FROM student_add s INNER JOIN lib_student_bookstatus lbs on s.student_id = lbs.student_id
                                                      INNER JOIN lib_addbook b  on lbs.book_id = b.book_id WHERE lbs.returnStatus=0");
            if(mysqli_num_rows($bookIsuuedList)>0){?>
                <div class="table-responsive" >
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th width="10%">BID</th>
                            <th>Book Name</th>
                            <th width="8%">SID</th>
                            <th>Student Name</th>
                            <th width="12%" >Class</th>
                            <th>Issued On</th>
                            <th>Fine</th>
                        </tr>
                        </thead>
                        <form method="POST">
                        <tbody style="text-align: left;">
                <?php 
                        $i=1;
                        while($give=mysqli_fetch_array($bookIsuuedList)){?>
                        <tr>
                            <td width="10%"><?php print $give['book_id'];?></td>
                            <td><?php print $give['book_name'];?></td>
                            <td  width="8%"><?php print $give['student_id'];?></td>
                            <td><?php print $give['FirstName']." ".$give['MiddleName']." ".$give['LastName']?></td>
                            <td width="12%"><?php print $give['class'];?></td>
                            <td><?php print $give['issueDate'];?></td>
                            <td><?php print ($give['fine'])?$give['fine']." /-":"No fine";?></td>
                        </tr>
                        <?php $i++;}?>
                        </tbody>  
                        </form> 
                    </table>  
                </div>           
           <?php }else{
                print "<h5 style='color:red'>There is no entry available.</h5></br>";
                 print file_get_contents("../admin/assets/image/empty.svg");
                     }
        }

        //validating student ID
        public function validateStudentID($sid){
            $this->connection();
            $val=mysqli_query($this->connect,"SELECT `student_id` FROM student_add WHERE `student_id`=$sid");
            if(mysqli_num_rows($val))
                return true;
            else    return false;
        }

        //getting particular book details 
        public function editbookdetails($bid)
        {
            $this->connection();
            $sql_edit=mysqli_query($this->connect,"SELECT `book_id`, `book_name`, `subject`, `copies`, `yearOfpublicn`, `publication`, 
                                    `author`, `publisherContact`, `addedOn` FROM `lib_addbook` WHERE `cnt`='$bid'");
            if(mysqli_num_rows($sql_edit))
            {
                return mysqli_fetch_array($sql_edit);
            }else{
                header("location:../admin_library.php");
            }
                        }

         //updating book details
        public function updateBookInfo($bid,$bname,$sub,$copies,$publication,$author,$YOP,$pubCon,$changeId)
        {
            $this->connection();
            $copies=intval($copies);
            $YOP=intval($YOP);
            $changeId=intval($changeId);
            $sql="UPDATE `lib_addbook` SET `book_id`=?,`book_name`=?,`subject`=?,`copies`=?,`yearOfpublicn`=?,`publication`=?,`author`=?,
                                                    `publisherContact`=? WHERE `cnt`= ?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("sssiisssi",$bid,$bname,$sub,$copies,$YOP,$publication,$author,$pubCon,$changeId);
            if($stmt->execute())
            {echo "<script>alert('Details Updated !'),location.href='../admin_library.php'</script>";}
           else
            {echo "<script>alert('Please Try again !'),location.href='../admin_library.php'</script>";}
            $stmt->close();
         }
             
          //deleting book
        public function RemoveThisBook($bookId)
          {
            $this->connection();
            $check=mysqli_query($this->connect,"DELETE FROM `lib_addbook` WHERE `cnt`=$bookId");
            if($check){  echo"<script>alert('Removed Succesfully');location.href='../admin_library.php'</script>";  }
            else{ echo "<script>alert('Please Try Again!!');location.href='../admin_library.php</script>";}
            }
            
        //check if ID exist then rediect it to bok_issue.php page where details of that ID'd student will be shown
       public function checkStudentId($stuid) {
            $this->connection();
            $query=mysqli_query($this->connect,"SELECT  `FirstName` FROM `student_add` WHERE `student_id` = '$stuid'");
            if(mysqli_num_rows($query)==1)
            {
                echo "<script>location.href='library/book_issue.php?id=".$stuid."'</script>";
            }else{
                echo"<script>alert('Student ID is Invalid/Not Registered !!');</script>"; 
            }
        }
      
        //check pending fine
        public function checkpendingFINES($sid)
          {     
               $this->connection();
                $query=mysqli_query($this->connect,"SELECT `fine` FROM `lib_student_bookstatus` WHERE `student_id`= $sid");
                $fine=0;
                while($row=mysqli_fetch_array($query)){
                    $fine+=$row['fine'];
                }
                return $fine;
         }

         //showing student info in libb
        public function student_inf($sid)
         {
            $this->connection();
            $query=mysqli_query($this->connect,"SELECT `student_id`,`FirstName`, `MiddleName`, `LastName`, `student_email`, `student_contact`,
                                            `current_class` FROM `student_add` WHERE `student_id`= $sid");
            while($get=mysqli_fetch_array($query))
            {  
                echo"<div class='col-md-4'> <div class='container student-details' style='margin-top:25px'>
                    <h6 style='color:#ffffff'>Student ID : ".$get['student_id']."</h6>
                    <h5 style='color:#ffffff'><i>".$get['FirstName']." ".$get['MiddleName']." ".$get['LastName']."</i></h5>
                    <p><small>".$get['student_email']."</small></p>
                    <p>Contact:"." ".$get['student_contact']."</p>
                    <p>Class:"." ".$get['current_class']."</p>";

                if($this->checkpendingFINES($sid))
                {   echo "<p><i>Pending</i> :<span style='margin-left:5px;color:#81f5ff;font-weight:bold;font-size:20px !important;'> &#8377; ". $this->checkpendingFINES($sid) ."</span></p>";
                    echo "<a href='#' data-toggle='modal' data-target='#payFine-confirmation'>
                         <button class='btn btn-outline-warning btn-sm' name='pay-all' id='pay-all'><span>PAY ALL</span></button></a>";
                                           }
             echo"</div></div>";                        
                }
        }

    //adding book to student
    public function addbookToStudent($sid,$bid,$return_date)
    {
        $this->connection();
        $checkIfbookExistsInLib=mysqli_query($this->connect,"SELECT`book_id`,`copies`FROM `lib_addbook` WHERE `book_id`='$bid'");
        if(mysqli_num_rows($checkIfbookExistsInLib)==1){
            $get=mysqli_query($this->connect,"SELECT `current_class` FROM `student_add` WHERE `student_id`= $sid");
            if($get){
                $val=mysqli_fetch_row($get); 
                $class=$val[0];
                if($class){
                        $add_book=mysqli_query($this->connect,"INSERT INTO `lib_student_bookstatus`(`book_id`, `student_id`, `class`, `returnDate`)
                                                 VALUES ('$bid','$sid','$class','$return_date')");
                        mysqli_query($this->connect,"UPDATE `lib_addbook` SET copies = copies-1 WHERE `book_id`= '$bid'");
                    
                     if($add_book)
                                echo "<script>alert('Book ".$bid." added to student ID : ".$sid."  !!');location.href='../library/book_issue.php?id=".$sid."'</script>";
                    else
                            echo "<script>alert('Error while Submitting!! Try Again')</script>";}
                    else
                            echo "<script>alert('Error Ocuured!! Try Again')</script>";         
         } else
                echo "<script>alert('Something Went Wrong!! Try Again')</script>";
        }  else {
               echo" <script>alert('This Book is Not Available !!');location.href='../library/book_issue.php?id=".$sid."'</script>";
        }
  }

  //book issue list
    public function getPreviousBookIssueInfo($sid){
        $this->connection();
                $query=mysqli_query($this->connect,"SELECT `book_id`, `issueDate`, `returnStatus`, `returnDate`, `fine`
                                                     FROM `lib_student_bookstatus` WHERE `student_id`= $sid ORDER BY srn DESC");
        echo " <div class='col-md-7' align='center'><h5 style='color:#ffffff'>Previous Book Issues</h5>";
        if(mysqli_num_rows($query) > 0){ ?>
           <div class="table-responsive">   
                <table class='table' style='background:#fff'>
                        <thead>
                                <tr> <th>Book ID</th><th>Issue Date</th><th>Return Date</th><th>Status</th><th>Fine</th></tr>
                        </thead>
                            <tbody>
        <?php    $i=1;       
            while($row=mysqli_fetch_array($query)){?>                   
                        <tr>
                            <td><?php print $row['book_id']?></td>
                            <td><?php print $row['issueDate']?></td>
                            <td><?php print $row['returnDate']?></td>
                            <td><?php print ($row['returnStatus'])?"<b style='color:green'>Returned</b>":"<i style='color:red'>Not Returned</i>" ?></td>
                            <td><?php print $row['fine']?></td>
                        </tr>                    
       <?php    $i++; }?></tbody></table></div>
        <?php  }else echo "<b><i>No Previous Records Available!!!</i></b>";
    }

    //pay fine
    public function payAllfine($sid,$pg)
    {
        $this->connection();
                $fine=mysqli_query($this->connect,"UPDATE `lib_student_bookstatus` SET `fine`= 0 WHERE `student_id`=$sid");
                echo ($fine)?"<script>alert('Fine Removed');location.href='../library/".$pg."?id=".$sid."'</script>": "<script>alert('Error Please try Again!!');location.href='../library/".$pg."?id=".$sid."'</script>";
    }

    //list of non-returned books of particualr student
    public function nonRetrndBookList($sid)
    {
        $this->connection();
        $list=mysqli_query($this->connect,"SELECT  `book_id` FROM `lib_student_bookstatus` WHERE `returnStatus`=0 and `student_id`=$sid");
       if(mysqli_num_rows($list)>0)
       {    echo "<select class='form-control' name='makeReturn' required><option value=''>Select One</option>";
           while($book=mysqli_fetch_row($list))
           {
               echo  "<option value='".$book[0]."'>".$book[0]."</option>";

           }
           echo "</select><br><button type='submit' name='MakeSubmsn' class='btn btn-warning btn-sm'>RETURN BOOK</button>";
        }else{
           echo "<script>alert('This Student Has No Books To Return');location.href='../admin_library.php'</script>";
        }
    }

    //return book function
    public function ReturnBook($sid)
    {
        $this->connection();
        $std=mysqli_query($this->connect,"SELECT `student_id` FROM `lib_student_bookstatus` WHERE `student_id`=$sid and `returnStatus`=0");
        if((mysqli_fetch_row($std)))
            echo "<script>location.href='library/book_return.php?id=".$sid."'</script>";
        else
            echo "<script>alert('This Student has no Pending Books !!!');location.href='admin_library.php'</script>";
    }
    public function ReturnThisBook($bid,$sid)
    { $this->connection();
        $rtrn=mysqli_query($this->connect,"UPDATE `lib_student_bookstatus` SET `returnStatus`=1 WHERE `book_id`='$bid' and `student_id`= $sid");
        mysqli_query($this->connect,"UPDATE `lib_addbook` SET copies = copies+1 WHERE `book_id`= '$bid'");
        if($rtrn)
            echo"<script>alert('Return of Book ".$bid." is Successfull !!');location.href='../library/book_return.php?id=".$sid."'</script>";
        else
            echo "<script>alert('Please Try Again !!!');location.href='../library/book_return.php?id=".$sid."'</script>";
    }

    //counting unresolved enquiries
    public function enquiryCount()
    {
        $this->connection();
        $enq=mysqli_query($this->connect,"SELECT  `sender_id` FROM `enquiry` WHERE `resolve`=0");
        if($c=(mysqli_num_rows($enq)>0))
            return mysqli_num_rows($enq);
        else
            return 0;
    }

    // validating enquiry ID
    public function validateEnqID($id)
    {      
        $this->connection();
        $enq=mysqli_query($this->connect,"SELECT `eid` FROM `enquiry` WHERE `eid`=$id");
        if(mysqli_num_rows($enq)==1)
            return true;
        else
            return false;
    }

    //view all enquires
    public function getEnquiry()
    {
        $this->connection();
        $enq=mysqli_query($this->connect,"SELECT `eid`, `enq_title`, `sender_type`, `sender_id`, `sender_name`, 
                    `body`,`admin_comment`,`resolve`, `date_of_enq` FROM `enquiry` WHERE 1");
        if(mysqli_num_rows($enq)>0)
        { while($fetch=mysqli_fetch_array($enq)){
            $words = explode(" ", $fetch["sender_name"]);
            $acronym = "";

            foreach ($words as $w) {
            $acronym .= $w[0];
            }
           echo '<div class="container Box">
           <span class="title">Reason: '.$fetch["enq_title"].'</span><span class="type float-right">FROM : <strong>'.$fetch['sender_type'].'</strong></span>';  
           echo ($fetch['resolve']==0)?'<span class="badge badge-info status">UNRESLOVED</span>':'<span class="badge badge-success float-right">RESLOVED</span>';
           echo'<div class="media">
                <div class="media-left user">'.strtoupper($acronym).'</div>
                <div class="media-body">';
             echo   '<h4 class="media-heading">'. $fetch["sender_name"].'<span class="float-right"><small>Posted on: <i>'.$fetch["date_of_enq"].'</i></small></span></h4>
                    <p>'. substr($fetch['body'], 0,400 ).". . . . . . . .".'</p>';
      
              if($fetch['admin_comment']){
                echo '<div class="media">
                <div class="media-left admin">A</div>
                  <div class="media-body">
                    <h4 class="media-heading">ADMIN <small><i>February 19, 2016</i></small></h4>
                    <p>'.$fetch['admin_comment'].'</p>
                  </div>
              </div>';}
             echo'</div></div><a href="enquiry/edit.php?eid='.$fetch['eid'].'"><button class="btn btn-sm btn-primary float-right">READ....</button></a></div>';
            }
        }
        else if(mysqli_num_rows($enq)==0)
        {
            echo "<div align='center'>
                    <h4>Enquiry Section</h4>";
                                                            
                             print "<p><strong>There is no entry available.</strong></p>";
                             print file_get_contents("../admin/assets/image/empty.svg"); 
                       print" </div>";
        }
    }

    //returns particular enquiry
    public function EnqID($id)
    {
        $this->connection();
        $sql=mysqli_query($this->connect,"SELECT `eid`, `enq_title`, `sender_type`, `sender_id`, `sender_name`, `body`,`admin_comment`,
                                        `resolve`, `date_of_enq` FROM `enquiry` WHERE `eid`=$id");
        if(mysqli_num_rows($sql)==1)
           {    $values=mysqli_fetch_array($sql);
                return $values;}
        else 
            return false;
    }

    //returns resonse made by admin date
  public function responseDate($eid){
    $this->connection();
    $sql=mysqli_query($this->connect,"SELECT `reponse_on` FROM `enquiry` WHERE `eid`=$eid");
    if(mysqli_num_rows($sql)==1)
       {    $value=mysqli_fetch_row($sql);

           if($value[0]!=null) 
               echo "Resolved On:".$value[0];
            else{
                $date = new DateTime();
                $result = $date->format('d-m-Y ');
                if ($result) {
                    echo "Today is : ".($result);
                } else { // format failed
                    echo "Relove Today";
                }
            }
  }}

    //updates/add cooment made on particular enquiry
    public function updateAdminComment($eid,$cbody)
    {$date = new DateTime();
        $result = $date->format('Y-m-d');
        $this->connection();
        $sql=mysqli_query($this->connect,"UPDATE `enquiry` SET `admin_comment`= '$cbody',`reponse_on`='$result' WHERE `eid`=$eid");
        if($sql)
            echo "<script>alert('Your Comment is Updated with Date ".$result."');location.href='edit.php?eid=".$eid."'</script>";
        else
            echo "<script>alert('Please try again !!');location.href='edit.php?eid=".$eid."'</script>";
    }

  //ATTENDENCE  METHODS
 
  public function studentAttendanceByClass($class)
  {
    $this->connection();
    $sql=mysqli_query($this->connect,"SELECT student_add.student_id,student_add.FirstName,student_add.MiddleName,student_add.LastName
             FROM student_add INNER JOIN attendance ON student_add.student_id = attendance.sid WHERE student_add.current_class=$class");
    if(mysqli_num_rows($sql)>0){

                    $current_date =date("Y-m-d",time());//todays date

            while($fetch=mysqli_fetch_array($sql))
            {
                echo"<tr>";
                echo "<td>".$fetch['student_id']."</td>";
                echo "<td>".$fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];
                echo '<input type="hidden" name="student_id[]" value="'.$fetch["student_id"].'" /></td>';
                echo '<td>'.((!$this->ifMarkedStudentAttendance($fetch['student_id'],$current_date))?' <label class="radio-inline">
                        <input type="radio" name="attend_status'.$fetch['student_id'].'" value="A" checked/>ABSENT</label>
                    <label class="radio-inline">
                        <input type="radio" name="attend_status'.$fetch['student_id'].'" value="P"/>PRESENT</label>':
                (($this->ifStudentPresentToday($fetch['student_id'],$current_date))?'<span class="badge badge-success">PRESENT</span>':'<span class="badge badge-warning">ABSENT</span>')).'</td>';                    
            
                echo "</tr>";

          }

    }else{
        print "<div align='center'  >";
            print "<p style='color:yellow'><strong>No Students in this Class.</strong></p>";
            print file_get_contents("../assets/image/empty.svg");
            print '</div>';
    }
  }
  //if student marked today then show badges
  public function ifStudentPresentToday($sid,$date){
    $sql="SELECT `sid` FROM `attendance` WHERE `sid`=? AND `attended_on`=? AND `attend`=?";
    $stmt=$this->connect->prepare($sql);
    $status="P";
    $stmt->bind_param("iss",$sid,$date,$status);
    $stmt->execute();
    $stmt->store_result();
    //return if true if already exist else false
    return ($stmt->num_rows == 1)?true:false;  
  }      

  //if attendence takedn today to enable or disable submit  btn
  function markedToday($date,$class){
    $this->connection();
    $class=intval($class);

    $sql="SELECT `attended_on` FROM `attendance` WHERE `attended_on`=? AND `student_class`=?";
    $stmt=$this->connect->prepare($sql);
    $stmt->bind_param("si",$date,$class);
    $stmt->execute();
    $stmt->store_result();
    //return if true if already exist else false
    return ($stmt->num_rows > 0)?true:false;  
   
  }
  //if attendence of particular student not taken on Todays Date
  public function ifMarkedStudentAttendance($sid,$date){
    $this->connection();
    $sid=intval($sid);

    $sql="SELECT `sid` FROM `attendance` WHERE `sid`=? AND `attended_on`=?";
    $stmt=$this->connect->prepare($sql);
    $stmt->bind_param("is",$sid,$date);
    $stmt->execute();
    $stmt->store_result();
    //return if true if already exist else false
    return ($stmt->num_rows == 1)?true:false;  
   
  }


  public function setAttendence($sid,$status,$date,$faculty,$class){
    $this->connection();
    $class=intval($class);
    //fetching previous information record 'no.of present and total_days of attendence'
    $sql="SELECT `total_present`, `total_days` FROM `attendance` WHERE `sid`=?";
    $stmt = $this->connect->prepare($sql);
    $stmt->bind_param("i",intval($sid));
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($present,$total);
    $stmt->fetch();
    
    //check if present today 
    $today=($status=="P")?1:0;

    $today_present=$present+$today;
    $total_days=$total+1;

    $query="UPDATE `attendance` SET `attend`=?,`total_present`=?,`total_days`=?,`attended_by`=?,`attended_on`=?  WHERE `sid`=?";
    $stmt2 = $this->connect->prepare($query);
    $stmt2->bind_param("siissi", $status,$today_present,$total_days, $faculty, $date,$sid);
    echo ($stmt2->execute())?'<script>location.href="class_attendance.php?class='.$class.'";`document.getElementById("attendance_submit").disabled = true;`</script>':'<script>alert("ERROR")</script>'; 
   
    $stmt->close();
    $stmt2->close();
    }

    //checking if sid is in attendance table
    public function checkIfStudentIDexist($sid)
    {$this->connection();
        $sid=intval($sid);
    
        $sql="SELECT `sid` FROM `attendance` WHERE `sid`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("i",$sid);
        $stmt->execute();
        $stmt->store_result();
        //return if true if already exist else false
        return ($stmt->num_rows == 1)?true:false;  
    }

    public function thisClassAttendanceRecord($class)
    {
        $this->connection();
        $class=intval($class);
        $sql="SELECT student_add.student_id, student_add.FirstName,student_add.MiddleName,student_add.LastName,student_add.current_class, 
                attendance.total_present,attendance.total_days FROM student_add INNER JOIN attendance ON 
                student_add.student_id = attendance.sid WHERE attendance.student_class=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("i",$class);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id,$firstName,$middleName,$lastName,$class,$present,$total);
      
        if($stmt->num_rows >0){
            while ($stmt->fetch()){
                print "<tr><td>".$id."</td>"; 
                print "<td>".$firstName." ".$middleName." ".$lastName."</td>"; 
                print "<td> Class ".$class."</td>" ;
                print "<td>".$present."</td>" ;
                print "<td>".$total."</td>" ;
                print "<td>".round(($present/($total==0?1:$total ))*100)."%</td></tr>" ;
            }
        }
        $stmt->close();
    }
    
    public function getStudentAttedanceRecord($sid)
    {
        $this->connection();
        $sid=intval($sid);
        $sql="SELECT `sid`, `student_class`,  `total_present`, `total_days` FROM `attendance` WHERE `sid`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("i",$sid);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $class,$present,$total);
        $stmt->fetch();

        print "<td>".$id."</td>"; 
        print "<td> Class ".$class."</td>" ;
        print "<td>".$present."</td>" ;
        print "<td>".$total."</td>" ;
        print "<td>".(($present/($total==0?1:$total ))*100)."%</td>" ;
    }

    public function EditStudentAttendance($sid)
    {
        $this->connection();
        $sid=intval($sid);
        $sql="SELECT `total_present`, `total_days` FROM `attendance` WHERE `sid`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("i",$sid);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($present,$total);
        $stmt->fetch();

        print '<label>Total Working Days : </label>'.$total.'<br>';
        print '<label for="Present">Present For :</label><input type="number" min=0 max="'.$total.'" class="form-control col-md-6" value="'.$present.'" name="changeP">';     
        $stmt->close();
    }

    public function updatePresentDays($val,$sid){
        $this->connection();
        $val=intval($val);
        if($val < 0){
            echo '<script>alert("Invalid Input");</script>';
            return;
        }else{
        $sid=intval($sid);
        
        $sql="UPDATE `attendance` SET `total_present`=? WHERE `sid`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("ii",$val,$sid);
        echo ($stmt->execute())?'<script>alert("Changed to '.$val.'");location.href="student_attendance.php?sid='.$sid.'";</script>': '<script>alert("Error !!!")</script>';
    }}


    //password validations//

    public function checkAdminPwd($usertyp,$pwd){
        $this->connection();
        $sql="SELECT `user_password` FROM `user_list` WHERE `user_type`=? AND `user_password`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("ss",$usertyp,$pwd);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($password);
        $stmt->fetch();
        
        if ($stmt->num_rows == 1){   
                
                $_SESSION['pwd']= $password;      
                echo "<script>location.href='setting/myInfo.php';</script>";

        }  else {
            echo '<script>alert("Invalid Password !!");location.href="admin_setting.php"</script>';
        }
        $stmt->close();
    }
    public function aPersonalInfo($adm,$admpwd)
    {
        $this->connection();
        $sql="SELECT  `user_id`, `user_password` FROM `user_list` WHERE `user_id`=? AND `user_password`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("ss",$adm,$admpwd);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userID,$password);
        $stmt->fetch();
        if ($stmt->num_rows == 1){  
            $res= array($userID,$password);
            return $res;
         }else{
            echo "<script>alert('Invalid Access');location.href='admin_setting.php';</script>";
         }

    }
    
    public function updateAdmin($password,$admin){
        $this->connection();

        $sql="UPDATE `user_list` SET `user_password`=? WHERE `user_type`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("ss",$password,$admin);
        if($stmt->execute()){
            unset($_SESSION["pwd"]);
            echo '<script>alert("Updated Successfully !!!");location.href="../"</script>';
        }
        $stmt->close();
    }

    public function checkAndGoTO($userType,$userId)
    {
        $this->connection();

        $userId=intval($userId);
        $sql="SELECT  `user_type`,`user_id` FROM `user_list` WHERE `user_type`=? AND `user_id`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("si",$userType,$userId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($utype,$uid);
        $stmt->fetch();
        if ($stmt->num_rows == 1){
            $_SESSION['TUTYPE']=$utype;
            $_SESSION['TUID']=$uid;
            echo '<script>location.href="setting/userSetting.php";</script>';
            $stmt->close();
        }else{
            echo "<script>alert('Invalid Input');location.href='admin_setting.php';</script>";

        }
    }  
    public function getThisUserLoginInfo($utype,$uid)
    {
        $this->connection();
        $uid=intval($uid);

        $sql="SELECT `user_id`, `user_type`, `user_password`, `allow_access` FROM `user_list` WHERE `user_id`=? AND `user_type`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("is",$uid,$utype);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id,$user_type,$user_password,$access);
        $stmt->fetch();
        if ($stmt->num_rows == 1){
            $res = array($user_id,$user_type,$user_password,$access);
            return $res;
        }else{
            return false;
        }
        $stmt->close();
    }
    public function updateThisUserLoginInfo($UTYPE,$UID,$UPWD, $access){
        $this->connection();
        $UID=intval($UID);
        $sql="UPDATE `user_list` SET `user_password`=?,`allow_access`=? WHERE `user_id`=? AND `user_type`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("siis",$UPWD, $access,$UID,$UTYPE);
        if($stmt->execute())
        {
            unset($_SESSION['TUTYPE']);
            unset($_SESSION['TUID']);
            
            echo '<script>alert("Updated Successfully !!!");location.href="../admin_setting.php";</script>';
        }else{
            echo '<script>alert("Please Try Again!!!");</script>';

        }
        $stmt->close();
    }
    
    public function getNotAssig_StudentList()
    {
        $this->connection();
        $sql=mysqli_query($this->connect,"SELECT student_add.student_id,student_add.FirstName,student_add.MiddleName,student_add.LastName FROM student_add
                                        WHERE  NOT EXISTS  (SELECT user_id FROM  user_list  WHERE  user_list.user_id= student_add.student_id AND user_list.user_type='STUDENT' )");
        if(mysqli_num_rows($sql)>0){
                while($fetch = mysqli_fetch_array($sql))
                {
                    echo '<option value="'.$fetch['student_id'].'">'.$fetch['FirstName'].' '.$fetch['MiddleName'].''.$fetch['LastName'].'</option>';
                }
        }
        else{
            return "NONE";
        }
     }

     public function getNotAssig_StaffList()
     {
         $this->connection();
         $sql="SELECT staff_add.staff_id,staff_add.FirstName,staff_add.MiddleName,staff_add.LastName FROM staff_add
              WHERE  NOT EXISTS  (SELECT user_id FROM  user_list  WHERE  user_list.user_id= staff_add.staff_id AND user_list.user_type='STAFF' )";
         $sql_run=mysqli_query($this->connect,$sql);
         if(mysqli_num_rows($sql_run))
         {  
             while($get=mysqli_fetch_array($sql_run))
             {
                 echo '<option value="'.$get['staff_id'].'">'.$get['FirstName'].' '.$get['MiddleName'].' '.$get['LastName'].'</option>';
             }
         } else{
            return "NONE";
        }
     }

     public function giveAccess($userType,$userID)
     {
        $userID=intval($userID);
        $password="012345";     $access=1;
         $this->connection();
         $sql="INSERT INTO `user_list`( `user_id`, `user_type`, `user_password`, `allow_access`) VALUES (?,?,?,?)";
         $stmt=$this->connect->prepare($sql);
         $stmt->bind_param("issi",$userID,$userType,$password,$access);
        if($stmt->execute())
        {
                echo '<script>alert("Member successfully Added !!");location.href="admin_setting.php";</script>';
        }else{
            echo '<script>alert("Please Try Again !!!");</script>';
        }
     }
}$database= new database();
?>