<?php
    class StudentDatabase{
      public $connect;  //for connection

      // DB Connect
		public function connection() {
		  
            return $this->connect=mysqli_connect('localhost','root','','dps');
         }


     //returns student Fullname
     public function myName($id){
        $this->connection();   
        $sql="SELECT `FirstName`, `MiddleName`, `LastName` FROM `student_add` WHERE student_id = ?";       
        
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($first,$middle,$last);
        $stmt->fetch();

       if($stmt->num_rows == 1) { 
            print $first." ".$middle." ".$last;}
        $stmt->close();
        }

    //returns all the details of the stduent
    public function myDetails($id){
        $this->connection();          
        $sql=mysqli_query($this->connect,"SELECT * FROM `student_add` WHERE student_id = '$id'");
        if(mysqli_num_rows($sql)==1){
            $fetch=mysqli_fetch_array($sql); 
            return $fetch;
        }else{
            header("location:../");
        }
    } 

      //student info updation method
      public function updateMyDetails($sid,$firstName,$middleName,$lastName,$DOB,$bloodGrp,$gender,$nationality,$religion,$category,$student_email,$student_contact,$house_number,$locality,$state,$city,$zip,$fatherName,$fatherOccupation,$fatherContact,$fatherEmail,$motherName,$motherOccupation,$motherContact,$guardianName,$guardianContact,$guardianOccupation,$guardianEmail)    
      {
           $this->connection();
           $sql="UPDATE `student_add` SET `FirstName`=?,`MiddleName`=?,`LastName`=?,`DOB`=?,`bloodGrp`=?,`gender`=?,`nationality`=?,`religion`=?,
                `category`=?,`student_email`=?,`student_contact`=?,`house_number`=?,`locality`=?,`state`=?,`city`=?,`zip`=?,`fatherName`=?,
                `fatherOccupation`=?,`fatherContact`=?,`fatherEmail`=?,`motherName`=?,`motherOccupation`=?,`motherContact`=?,`guardianName`=?,
                `guardianContact`=?,`guardianOccupation`=?,`guardianEmail`=? WHERE `student_id`= ?";
         
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("ssssssssssissssississsisissi",$firstName,$middleName,$lastName,$DOB,$bloodGrp,$gender,$nationality,$religion,$category,$student_email,$student_contact,$house_number,$locality,$state,$city,$zip,$fatherName,$fatherOccupation,$fatherContact,$fatherEmail,$motherName,$motherOccupation,$motherContact,$guardianName,$guardianContact,$guardianOccupation,$guardianEmail,$sid);
              
      if($stmt->execute())
          echo "<script>alert('Updated Successfully !!!');location.href='myprofile.php';</script>" ;
      else
            echo "<script>alert('Please try Again !!!');location.href='edit_details.php';</script>" ;  
      } 

      public function myAttendance($sid)
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
        print "<td>".round(($present/($total==0?1:$total ))*100)."%</td>" ;
    }

        //shows payment history
        public function myPayments($sid)
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
                                    <td><?php print $fetch["total_deposit"]?></td>
                                    <td><?php print $fetch["paid_on"]?></td>
                                </tr>
                            <?php $i++;}echo "</tbody></table></div>";
            }else{
                print "<div align='center'  >";
                print "<p style='color:yellow'><strong>No Payment History available.</strong></p>";
                print file_get_contents("assets/image/empty.svg");
                print '</div>';
            }
           
        }

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

         //get fcility fees informtion
         function facilityfees($fac) 
         {  $this->connection();
           $sql=mysqli_query($this->connect,"SELECT`fees`FROM `facility_fees` WHERE `facility`='$fac'");
          if(mysqli_num_rows($sql)>0){
              $fetch=mysqli_fetch_array($sql);
              return intval($fetch["fees"]);
          }else{
              return 0;
          }
        }

        //returns remaining fees of studdent
    public function myDues($sid,$class,$facility)
    {   
        $this->connection();
        $paid=mysqli_query($this->connect,"SELECT `tution`, `sports`, `cca`, `exam`, `special_subject`, `facility_fees` FROM `student-fees` WHERE `student_id`=$sid");//from student-fees tabl(include facility
        if(mysqli_num_rows($paid)>0){
                     $z=0;$tution=0; $sports=0;$cca=0;$exm=0;$sps=0;$faf=0;// temp variables
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
        $t= intval($fetch['tution']-$tution);
        $sp= intval($fetch['sports']-$sports);
        $cc= intval($fetch['cca']-$cca);
        $ex=intval($fetch['exam']-$exm);
        $ss= intval($fetch['special_subject']-$sps);
        $ff= intval($fac-$faf);

        return array ($t,$sp,$cc,$ex,$ss,$ff);
    }else{//return full fees details

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

    //Study materials
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
        ?><tr>
            <td><?php print $i ?></td>
            <td><?php print $fetch['material_name'];?> </td>
            <td><?php print  $fetch['subject'];?></td>
            <td><?php print $fetch['material_type']; ?></td>
            <td><?php print $fetch['creation_Date']; ?></td>
            <td><?php print $sub ?> </td>
            <td><a href="../uploads/study_materials/<?php echo $fetch["class"] ?>/<?php echo $fetch['fileName']?>" target="_blank" rel="noopener noreferrer">
             <button type="button" class="btn btn-warning btn-sm">view</button></a><span style="margin-left:50px"></span>
         </td>
             </tr>
            
           <?php
            $i++;}
                echo " </tbody>
                </table> 
        </div>";
        }
            else{
                print "<div align='center'>";
                print "<h4><strong>There is no Material Provided.</strong></h4>";
                print file_get_contents("assets/image/empty.svg");
                print '</div>';
              }
        }

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
        //view timetable function
      public function viewMyTable($c){//$c is class integral val
          $class="Class ".$c;
        $this->connection();
        $imgres=mysqli_query($this->connect,"SELECT `file_name`, `class_teacher_id`,`classes`  FROM `time_table` WHERE `classes`='$class' and `present`=1");
        if(mysqli_num_rows($imgres)>0){
            while($get=mysqli_fetch_array($imgres)){?>
            <strong><p align="center" style="color:#FF0000" id="getMsg"></p></strong>
            <div class="table-view">
             <img src="../uploads/time-table/<?php print $get['file_name'];?>" style="width:100%">
                <div class="info-box">
                Assigned Class Teacher: <b><?php print ($name=$this->getClassTeacher($get['classes']))? $name:"Not Assigned Yet";?></b> <br>
                </div>
            
            </div> 
        <?php }
    }else{?><div align='center'>
        <?php 
        print "<p><strong>There is no entry available.</strong></p>";
        print file_get_contents("assets/image/empty.svg"); ?>
   </div>
    <?php }
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
                        
                    </tr>
                    <?php $i++;}?>
                    </tbody>  
                    </form> 
                </table>  
            </div>           
       <?php }else{
            print "<h5 style='color:red'>There is no entry available.</h5></br>";
             print file_get_contents("assets/image/empty.svg");
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

        //previous Issues
        public function getPreviousBookIssueInfo($sid){
            $this->connection();
                    $query=mysqli_query($this->connect,"SELECT `book_id`, `issueDate`, `returnStatus`, `returnDate`, `fine`
                                                         FROM `lib_student_bookstatus` WHERE `student_id`= $sid ORDER BY srn DESC");
           if(mysqli_num_rows($query) > 0){ ?>
               <div class="table-responsive">   
                    <table class='table' >
                            <thead class="thead-light">
                                    <tr> <th>Book ID</th><th>Issue Date</th><th>Return Date</th><th>Status</th><th>Fine</th></tr>
                            </thead>
                                <tbody>
            <?php    $i=1;       
                while($row=mysqli_fetch_array($query)){?>                   
                            <tr>
                                <td><?php print $row['book_id']?></td>
                                <td><?php print $row['issueDate']?></td>
                                <td><?php print $row['returnDate']?></td>
                                <td><?php print ($row['returnStatus'])?"Returned":"Not Returned" ?></td>
                                <td><?php print $row['fine']?></td>
                            </tr>                    
           <?php    $i++; }?></tbody></table></div>
            <?php  }else echo "<b><i>No Previous Records Available!!!</i></b>";
        }
    
    //to view the selected class Examination Schedule
    public function examSchView($class){
            $this->connection();
            $imgres=mysqli_query($this->connect,"SELECT exam.file_name,time_table.classes FROM exam 
            INNER JOIN time_table ON exam.classes = time_table.classes WHERE exam.presence = 1 and exam.classes='$class'");
           if(mysqli_num_rows($imgres)==1){
               while($get=mysqli_fetch_array($imgres)){?>
               <div class="table-view">
                  <img src="../uploads/examSch/<?php print $get['file_name'];?>" style="width:80%">
                     <div class="info-box">
                      Assigned Class Teacher: <b><?php print ($name=$this->getClassTeacher($get['classes']))? $name:"<i>Not Assigned Yet</i>"; ?></b> <br>
                      </div>
                </div> 
              <?php }
           }else{?><div align='center'>
              <?php 
                  print "<p><strong>No Exam Schedule Available.</strong></p>";
                  print file_get_contents("assets/image/empty.svg"); ?>
         </div>
      <?php }
      }

      function getHostelId($sid){
          $this->connection();

          $sql=mysqli_query($this->connect,"SELECT hostels.hostel_id FROM hostels INNER JOIN hostel_student 
                            ON hostel_student.hostel_id = hostels.hostel_id WHERE hostel_student.student_id= $sid");
        if(mysqli_num_rows($sql)==1){
            $fetch=mysqli_fetch_array($sql);

            return $fetch["hostel_id"];
        }
      }
       
      function getHostelName($hid)
    {
        $this->connection();
        $sql=mysqli_query($this->connect,"SELECT  `hostel_name` FROM `hostels` WHERE `hostel_id`= $hid");
        if(mysqli_num_rows($sql)==1){
            $fetch=mysqli_fetch_array($sql);

            return $fetch["hostel_name"];
        }
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
       
       if(mysqli_num_rows($query)>0){
           while($fetch=mysqli_fetch_array($query)){
           ?><tr>
            <td><?php print $i; ?></td>
            <td><?php print $fetch[0]." ".$fetch[1]." ".$fetch[2];?></td>
            <td><?php print $fetch['fatherName'];?></td>
            <td><?php print $fetch['fatherContact'];?></td>
            <td><?php print $fetch['appliedClass'];?> </td>
            <td><?php print $fetch['locality'].",".$fetch['city'].",".$fetch['state'].", ".$fetch['zip']; ?></td>
            </tr>
           
            <?php
            $i++;
        }}
    }

    public function getAllNotice(){
        $this->connection(); 
        $notice=mysqli_query($this->connect,"SELECT `count`,`type`, `notice_body`, `created_on` FROM `notice`  WHERE `visibility`=1 ORDER BY count DESC");
        while($fetch=mysqli_fetch_array($notice)){?>
        <div class="container">
        <div class="notice-heading"><h4><?php print $fetch['type']; ?></h4></div>
        <div class="notice-box">
        <small class="notice-date">CREATED ON : <?php print $fetch['created_on']; ?></small>
        <p><?php echo $fetch['notice_body'];?></p>  
        </div></div>
        <?php
        }
    }

    function getTransportId($sid)
    {
        $this->connection(); 
        $sid = intval($sid);
        $query=mysqli_query($this->connect,"SELECT routes.route_no  FROM  routes INNER join student_transport 
                        on routes.route_no=student_transport.route_id where student_transport.student_id=$sid");
        if(mysqli_num_rows($query)==1){
            $fetch=mysqli_fetch_row($query);
            return $fetch[0];
        }
    }

   //route information
      public function routeInfo($ref_id)
      {           
        $this->connection(); 
        $query=mysqli_query($this->connect,"SELECT  `name`, `road1`, `road2`, `road3`, `dateOfAddtion`, `driver_name`, `driver_contact`  FROM `routes` WHERE `route_no`='$ref_id'");
        $results=mysqli_fetch_array($query);
        print "Route name : <b>".$results[0]."</b></br>";
        print "Direction :  <b>".$results[1]." <small>-> </small> ".$results[2]." <small>-> </small> ".$results[3]."</b><br>";
        print "Driver Name : <b>".$results[5]."</b><br>";
        print "Driver Contact : <b>".$results[6]."</b>";
        print "<span style='float:right'>Date of Addition : ".date("d-m-Y", strtotime($results[4]))."</span>";  
    }

    //Displays students List who are taking that route bus
    public function transport_student_list($id){
                
        $this->connection(); 
        $query=mysqli_query($this->connect,"SELECT student_transport.count,student_add.FirstName,student_add.MiddleName,student_add.LastName,
                            student_add.fatherName,student_add.fatherContact,student_add.current_class,student_transport.route_id 
                            FROM student_add INNER JOIN  student_transport ON student_add.student_id = student_transport.student_id  
                            WHERE student_transport.route_id = '$id' ");
    if(mysqli_num_rows($query)>0)
    {$i = 1;
    while($fetch=mysqli_fetch_array($query)){
            print "<tr>";
            print "<td>".$i."</td><td>".$fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'].
            "</td><td> Class ".$fetch['current_class']."</td><td>".$fetch['fatherName']."</td><td>".$fetch['fatherContact']."</td>";               
            print "</tr>";
            $i++;
        }}
    }

   
        //view all enquires
    public function myEnquiries($sid,$sType)
    {
        $this->connection();
        $enq=mysqli_query($this->connect,"SELECT `eid`, `enq_title`, `sender_type`, `sender_id`, `sender_name`, 
                    `body`,`admin_comment`,`resolve`, `date_of_enq` FROM `enquiry` WHERE `sender_id`=$sid AND `sender_type`='$sType'");
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
                    <p>'.$fetch["body"].'</p>';
      
              if($fetch['admin_comment']){
                echo '<div class="media">
                <div class="media-left admin">A</div>
                  <div class="media-body">
                    <h4 class="media-heading">ADMIN <small><i>February 19, 2016</i></small></h4>
                    <p>'.$fetch['admin_comment'].'</p>
                  </div></div>';}
              
             echo'</div></div>';
             if($fetch['resolve']==0){
            echo '<form method="POST">
             <input type="hidden" name="enquiry_info" value="'.$fetch["eid"].'"/>
             <button type="submit" name="resolve" class="btn btn-sm btn-warning float-right">MARK RESOLVED</button></form>';}
             echo '</div>';
            }
        }else{?><div align='center'>
            <?php 
            print "<p><strong>There is no entry available.</strong></p>";
            print file_get_contents("assets/image/empty.svg"); ?>
       </div>
        <?php }
    }

    public function MarkEnquiryResolved($eid,$stype,$sid)
    {
        $this->connection();
        $sql="UPDATE `enquiry` SET `resolve`=1 WHERE `eid`=? AND `sender_type`=? AND`sender_id`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("isi",$eid,$stype,$sid);
        if($stmt->execute())
            echo '<script>alert("Marked Resolve !!!!");location.href="myenquiry.php";</script>';
        else
            echo '<script>alert("Please Try after Sometime !!!!");location.href="myenquiry.php";</script>';

    }

    public function addThisEnquiry($title,$body,$senderType,$senderId,$name)
    {
        $this->connection();
        $sql="INSERT INTO `enquiry`( `enq_title`, `sender_type`, `sender_id`, `sender_name`, `body`) VALUES (?,?,?,?,?)";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("ssiss",$title,$senderType,$senderId,$name,$body);
        if($stmt->execute())
        echo '<script>alert("Your Request is Submitted !!");location.href="myenquiry.php";</script>';
    else
        echo '<script>alert("Please Try after sometime !!!!");location.href="myenquiry.php";</script>';
    }

    //pASSWORD RELATED METHODS
    public function checkOldPassword($oldp,$utyp,$uid)
    {
       $this->connection();
        $sql="SELECT  `user_password` FROM `user_list` WHERE `user_id`=? AND`user_type`=? AND `allow_access`=1 AND `user_password`=?";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("iss",$uid,$utyp,$oldp);
        $stmt->execute();
        $stmt->store_result();
        $stmt->fetch();

       if($stmt->num_rows == 1)
                  return true;
        else
                return false;
    }

    public function passwordReset($oldp,$newp,$confP,$utyp,$uid)
    {
        if($newp === $confP ){
         
        if($this->checkOldPassword($oldp,$utyp,$uid)){
       $this->connection();
       $sql="UPDATE `user_list` SET `user_password`=? WHERE `user_type`=? AND `user_id`=?";
       $stmt=$this->connect->prepare($sql);
       $stmt->bind_param("ssi",$newp,$utyp,$uid);

                if($stmt->execute())
                echo '<script>alert("Password Changed Successfully!!");location.href="setting.php";</script>';
                    else
                echo '<script>alert("Please Try after sometime !!!");location.href="setting.php";</script>';
        }
        else{
            echo '<script>alert("Your Password is incorrect !! Contact ADMIN to reset !!!");location.href="setting.php"</script>';
        }
    }
        else {
        echo '<script>alert("Both password should be same !!!");location.href="setting.php"</script>';
            
        }
    }
  }$studentdatabase= new StudentDatabase();