<?php
    Class StaffDatabse{
    public $connect;  //connection var

    // DB Connect
        public function connection() {
        
            return $this->connect=mysqli_connect('localhost','root','','dps');
        }
  public function getStudentList($role)
  {
      $this->connection();

      if($role=="Warden"){
        $sql=mysqli_query($this->connect,"SELECT `FirstName`, `MiddleName`, `LastName`, `gender`, `current_class`, `student_contact`, `house_number`,
        `locality`, `city`, `state`, `zip`, `fatherName`,`fatherContact`,`student_id` FROM `student_add` WHERE `Facility`='HOSTEL'");
        if(mysqli_num_rows($sql)>0){
            $i=1;
            while($fetch=mysqli_fetch_array($sql)){
                ?> <tr>
                    <td width="5%"><?php   print $i;?></td>
                    <td width="15%"><?php   print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];?></a></td>
                    <td width="10%"><?php   print $fetch['gender'];?></td>
                    <td width="12%"><?php   print $fetch['student_contact'];?></td>
                    <td width="10%"><?php   print "Class ".$fetch['current_class'];?></td>
                    <td width="23%"><?php   print $fetch['house_number'].", ".$fetch['locality'].", ".$fetch['city'].", ".$fetch['state'].", PIN- ".$fetch['zip'];?></td>
                    <td width="15%"><?php   print $fetch['fatherName'];?></td>
                    <td width="12%"><?php   print $fetch['fatherContact'];?></td>
                </tr>
                <?php  $i++;  
                }}
        }elseif($role=="Transport Officer"){
            $sql=mysqli_query($this->connect,"SELECT `FirstName`, `MiddleName`, `LastName`, `gender`, `current_class`, `student_contact`, `house_number`,
            `locality`, `city`, `state`, `zip`, `fatherName`,`fatherContact`,`student_id` FROM `student_add` WHERE `Facility`='TRANSPORT'");
            if(mysqli_num_rows($sql)>0){
                $i=1;
                while($fetch=mysqli_fetch_array($sql)){
                    ?> <tr>
                        <td width="5%"><?php   print $i;?></td>
                        <td width="15%"><?php   print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];?></a></td>
                        <td width="10%"><?php   print $fetch['gender'];?></td>
                        <td width="12%"><?php   print $fetch['student_contact'];?></td>
                        <td width="10%"><?php   print "Class ".$fetch['current_class'];?></td>
                        <td width="23%"><?php   print $fetch['house_number'].", ".$fetch['locality'].", ".$fetch['city'].", ".$fetch['state'].", PIN- ".$fetch['zip'];?></td>
                        <td width="15%"><?php   print $fetch['fatherName'];?></td>
                        <td width="12%"><?php   print $fetch['fatherContact'];?></td>
                    </tr>
                    <?php  $i++;  
                    }}         
          }if($role=="Lab Assistant"){
            $sql=mysqli_query($this->connect,"SELECT `FirstName`, `MiddleName`, `LastName`, `gender`, `current_class`, `student_contact`, `house_number`,
            `locality`, `city`, `state`, `zip`, `fatherName`,`fatherContact`, FROM `student_add` WHERE `Facility`='HOSTEL'");
            if(mysqli_num_rows($sql)>0){
                $i=1;
                while($fetch=mysqli_fetch_array($sql)){
                    ?> <tr>
                        <td width="5%"><?php   print $i;?></td>
                        <td width="15%"><?php   print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];?></a></td>
                        <td width="10%"><?php   print $fetch['gender'];?></td>
                        <td width="12%"><?php   print $fetch['student_contact'];?></td>
                        <td width="10%"><?php   print "Class ".$fetch['current_class'];?></td>
                        <td width="23%"><?php   print $fetch['house_number'].", ".$fetch['locality'].", ".$fetch['city'].", ".$fetch['state'].", PIN- ".$fetch['zip'];?></td>
                        <td width="15%"><?php   print $fetch['fatherName'];?></td>
                        <td width="12%"><?php   print $fetch['fatherContact'];?></td>
                    </tr>
                    <?php  $i++;  
                    }}
            }
    }

    public function getStudentListWithClass($staffID){
       $this->connection();
       $staffID=intval($staffID);
      
       $sql=mysqli_query($this->connect,"SELECT student_add.FirstName,student_add.MiddleName ,student_add.LastName,student_add.student_contact,student_add.current_class,
                                        student_add.gender,student_add.house_number,student_add.locality,student_add.city,student_add.state,student_add.zip,
                                        student_add.fatherName,student_add.fatherContact FROM student_add
                                    INNER JOIN staff_add ON FIND_IN_SET( student_add.current_class, staff_add.class_assigned) > 0
                                    WHERE staff_add.staff_id = $staffID");
        if(mysqli_num_rows($sql)>0){
            $i=1;
            while($fetch=mysqli_fetch_array($sql)){
                ?> <tr>
                <td width="5%"><?php   print $i;?></td>
                <td width="15%"><?php   print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];?></a></td>
                <td width="10%"><?php   print $fetch['gender'];?></td>
                <td width="12%"><?php   print $fetch['student_contact'];?></td>
                <td width="10%"><?php   print "Class ".$fetch['current_class'];?></td>
                <td width="23%"><?php   print $fetch['house_number'].", ".$fetch['locality'].", ".$fetch['city'].", ".$fetch['state'].", PIN- ".$fetch['zip'];?></td>
                <td width="15%"><?php   print $fetch['fatherName'];?></td>
                <td width="12%"><?php   print $fetch['fatherContact'];?></td>
            </tr>
            <?php  $i++;  
            }
        }
    }

    //FULL name
    public function StaffName($id){
        $this->connection();          
        $sql=mysqli_query($this->connect,"SELECT `FirstName`, `MiddleName`, `LastName` FROM `staff_add` WHERE staff_id = '$id'");
        if(mysqli_num_rows($sql)==1)
        $fetch=mysqli_fetch_array($sql); 
            print $fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName'];
    }

       //details of staff
       public function StaffDetails($id){
        $this->connection();          
        $sql=mysqli_query($this->connect,"SELECT * FROM `staff_add` WHERE staff_id = '$id'");
        if(mysqli_num_rows($sql)==1){
            $fetch=mysqli_fetch_array($sql); 
            return $fetch;
        }else{
            header("location:../");
        }
         }

         //updation in staff details
         public function updateMYDetails($staffID,$firstName,$middleName,$lastName,$DOB,$blood_grp,$nationality,
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
                echo '<script>alert("Your Details Have been Updated !!!");location.href="Profile.php"</script>';
            }else
                echo '<script>alert("Please Try Again!!!");location.href="EditDetails.php"</script>';
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
            $acronym .= (($w[0]!=" ")?$w[0]:$w[1]);
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
            echo '<script>alert("Marked Resolve !!!!");location.href="Enquiry.php";</script>';
        else
            echo '<script>alert("Please Try after Sometime !!!!");location.href="Enquiry.php";</script>';

    }

    public function addThisEnquiry($title,$body,$senderType,$senderId,$name)
    {
        $this->connection();
        $sql="INSERT INTO `enquiry`( `enq_title`, `sender_type`, `sender_id`, `sender_name`, `body`) VALUES (?,?,?,?,?)";
        $stmt=$this->connect->prepare($sql);
        $stmt->bind_param("ssiss",$title,$senderType,$senderId,$name,$body);
        if($stmt->execute())
        echo '<script>alert("Your Request is Submitted !!");location.href="Enquiry.php";</script>';
    else
        echo '<script>alert("Please Try after sometime !!!!");location.href="Enquiry.php";</script>';
    }

    //transportation Admin Methods
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

    //add new route
    public function addNewRoute($name,$road1,$road2,$road3,$driverName,$driverContact,$post){
        $this->connection(); 
        if($post=="Transport Officer"){
            $contact=intval($driverContact);
            $sql="INSERT into `routes`(`name`,`road1`, `road2`, `road3`, `driver_name`, `driver_contact`) VALUES(?,?,?,?,?,?)";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("sssssi",$name,$road1,$road2,$road3,$driverName,$contact);
            if($stmt->execute())
                     echo"<script>alert('A new Route added successfully');location.href='transport.php';</script>"; 
            else
                    echo"<script>alert('Pleasse Try Again !!!');location.href='transport.php';</script>"; 
            $stmt->close();
        }
      
      }
  //validating
        public function validateRoute($route)
        {
            $this->connection(); 
            $route=intval($route);
            $sql="SELECT `route_no` FROM `routes` WHERE `route_no`=?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("i",$route);
            $stmt->execute();
            $stmt->store_result();
            $stmt->fetch();
            if($stmt->num_rows == 1)
                return true;
            else
                return false;
    
        }
      //updating facility(HOSTEL/TRANSPORT) fees  
      public function changeFacilityFees($facility,$fees,$page,$post)
      { 
          if($post=="Transport Officer" || $post="Warden" ){
            $fees=intval($fees);
            $this->connection(); 
            $sql="UPDATE `facility_fees` SET `fees`=? WHERE `facility`=?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("is",$fees,$facility);
            if($stmt->execute())
                echo"<script>alert('".$facility." Fees is Updated to ".$fees."');location.href='".$page.".php';</script>";
            else
                echo"<script>alert('Please Try Again !!');location.href='".$page.".php';</script>";

            $stmt->close();       
          }
       }

    //route table view
    public function getRouteList($post){  
        if($post=="Transport Officer")
        {$i=1;        
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
            <?php  $i++;} } 
    }
      // route viw page 
      public function routeEdit($rno,$post)
      {
         if($post="Transport Officer")
         {
              $this->connection();
          $edit=mysqli_query($this->connect,"SELECT `route_no`, `name`, `driver_name`, `driver_contact`, `road1`, `road2`, `road3`, `dateOfAddtion` FROM `routes` WHERE `route_no`=$rno");
          $fetch=mysqli_fetch_array($edit);
            return $fetch;
      }}

       //update route details
       public function updateDetailsOfRoute($rn,$name,$r1,$r2,$r3,$driverName,$driverContact,$post)
       {
        if($post="Transport Officer")
        {$this->connection();
            $rn=intval($rn);
            $contact=intval($driverContact);
            $sql="UPDATE `routes` SET `name`=?,`road1`=?,`road2`=?,`road3`=?, `driver_name`=?,`driver_contact`=? WHERE `route_no`=?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("sssssii",$name,$r1,$r2,$r3,$driverName,$contact,$rn);
            if($stmt->execute()){
                echo "<script>alert('Details Updated Successfully !!! ');location.href='../transport.php'</script>";
            }else{
                echo "<script>alert('Please Try Again !!! ');location.href='../transport/transport_routeEdit.php?id=".$rn."'</script>";
            }
          $stmt->close();
       }}
        //delete route
       public function removeThisRoute($rno,$post)
        {
            if($post=="Transport Officer")
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
                    echo "<script>alert('Route ".$rno." removed !!!');location.href='../transport.php'</script>";
                else
                    echo "<script>alert('Please Try Again !!! ');location.href='transport_routeEdit.php?id=".$rn."'</script>";
                            
            }else{
                echo "<script>alert('Please Try Again !!! ');location.href='transport_routeEdit.php?id=".$rn."'</script>";

            }}
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
          public function routeInfo($ref_id,$post){
           
            if($post=="Transport Officer") 
            {  $this->connection(); 
                $query=mysqli_query($this->connect,"SELECT  `name`, `road1`, `road2`, `road3`, `dateOfAddtion`, `driver_name`, `driver_contact` FROM `routes` WHERE `route_no`='$ref_id'");
                $results=mysqli_fetch_array($query);
                      print "Route name : <b>".$results[0]."</b></br>";
                      print "Direction :  <b>".$results[1]." <small>-> </small> ".$results[2]." <small>-> </small> ".$results[3]."</b><br>";
                      print "Driver Name : <b>".$results[5]."</b><br>";
                      print "Driver Contact : <b>".$results[6]."</b>";
                      print "<span style='float:right'>Date of Addition : ".date("d-m-Y", strtotime($results[4]))."</span>";  
           }}

           //Displays students List who are taking that route bus
        public function transport_student_list($id,$post){
            if($post="Transport Officer")
            {
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
            } }}
       
    }
 //this function remove student from transportation facility
 public function removethisStudentFrmRoute($stdrouteID,$route,$post)
 {
     if($post="Transport Officer")
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
 }
    //displays select option containing student who opted for transport facility but havent been alloted a route bus  
    public function transport_studentADD_list($post){
        if($post=="Transport Officer"){
            $this->connection();          
    $sql=mysqli_query($this->connect,"SELECT student_add.student_id, student_add.FirstName,student_add.MiddleName, student_add.LastName
                        FROM student_add LEFT JOIN student_transport ON student_add.student_id = student_transport.student_id 
                        WHERE student_transport.student_id IS NULL and student_add.Facility='TRANSPORT'");
    print "<option value =''>----SELECT----</option>";
    while($arr=mysqli_fetch_array($sql)){
        print "<option value=".$arr['student_id'].">".$arr['FirstName']." ".$arr['MiddleName']." ".$arr['LastName']."</option>";
    }}
    }
     //function to add student in that particular route
     public function addStudentToRoute($nameID,$routeID,$post){
           
        if($post=="Transport Officer"){
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
             
             $stmt->close();
    }}//trasposration Methods end here

    //Hostel Methods start hre
    public function getHostelName($hid,$post){
        if($post=="Warden")
        {  $this->connection(); 
           $name=mysqli_query($this->connect,"SELECT `hostel_name` FROM `hostels` WHERE `hostel_id` = $hid");
           $res=mysqli_fetch_array($name);
           print $res['hostel_name'];
       } }
        //Hostel name change Method
        public function ChangeHostelName($hid, $name,$post)
        {
            if($post=="Warden")
            { $this->connection(); 
                $hid=intval($hid);
                $sql="UPDATE `hostels` SET `hostel_name`=? WHERE `hostel_id`=?";
                $stmt=$this->connect->prepare($sql);
                $stmt->bind_param("si",$name,$hid);

            if($stmt->execute())
                echo "<script>alert('Hostel Name Updated to ".$name."');location.href='hostel_details.php?ref=".$hid."'</script>";
            else
                echo "<script>alert('Plese try Again !!!');location.href='hostel_details.php?ref=".$hid."'</script>";
             $stmt->close();

        }}
        public function hostel_studentADD_list($hid,$post){
            if($post=="Warden")
            {
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
            }}
    }

    //addnig student in particular hostel
    public function addStudentToHostel($sid,$hid,$post){
        if($post=="Warden")
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
    }

        public function displayStudentInHostel($hid,$post){
            if($post=="Warden")
            {$i = 1;
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
            }}
        }

         //remove student from hostel
         public function delete_Student($cnt,$hostel,$post){
            //Removing Student from a particular Hostel
            if($post=="Warden")
            {
                $cnt=intval($cnt);
                $this->connection();   
                $sql="DELETE FROM `hostel_student` WHERE  `count` =?";
                $stmt=$this->connect->prepare($sql);
                $stmt->bind_param("i",$cnt);
                if($stmt->execute())
                   echo" <script> alert('Student Removed !!!');location.href='hostel_details.php?ref=".$hostel."'; </script> ";  
                else
                   echo" <script> alert('Please Try Again Or Contact Admin   !!!');location.href='hostel_details.php?ref=".$hostel."'; </script> ";  
   
            }}    
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
        if($newp == $confP ){
         
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

    //MATERIAL REALTED METHODS
    //adding material
    public function addMaterial($fileName, $fileError, $fileSize, $fileTmpName, $name, $subject, $type, $DOS, $class,$postAssigned){
        if($postAssigned=="Asst. Teacher")
        {$fileExt = explode('.',$fileName);
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
        }}
    }    

    //time atble
    public function getMyClassTimeTable($classes)
    {
        $this->connection();
        $sql="SELECT time_table.classes,time_table.count, staff_add.FirstName,staff_add.MiddleName,staff_add.LastName,time_table.file_name 
                     FROM time_table INNER JOIN staff_add on staff_add.staff_id=time_table.class_teacher_id WHERE count IN (".$classes.")";
        $view=mysqli_query($this->connect,$sql);
        if(mysqli_num_rows($view)>0){?>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Sr.</th>
                    <th scope="col">Class</th>
                    <th scope="col">Class Teacher</th>
                    <th scope="col">View</th>
                    </tr>
                </thead>
                <?php   $i=1;
            while($fetch=mysqli_fetch_array($view)){?>
               <tr>
                    <td><?php print $i;?></th>
                    <td><?php print $fetch['classes'];?></td>
                    <td><?php print "<b>".$fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName']."</b>";?></td>
                    <td> <a href="timeTable/view.php?class=<?php print $fetch['count']?>">
                             <button type="button" class="btn btn-sm btn-info"> VIEW</button></a></td>
                </tr>
        <?php $i++;}         
        echo' </tbody>
        </table>';            
    }}
    
         //view timetable function
         public function viewMyTable($class_count){
             $class_count=intval($class_count);

            $this->connection();
            $imgres=mysqli_query($this->connect,"SELECT `file_name`, `class_teacher_id`,`count`  FROM `time_table` WHERE `count`=$class_count and `present`=1");
            if(mysqli_num_rows($imgres)==1){
                while($get=mysqli_fetch_array($imgres)){?>
                <strong><p align="center" style="color:#FF0000" id="getMsg"></p></strong>
                <div class="table-view">
                 <img src="../../uploads/time-table/<?php print $get['file_name'];?>" style="width:100%">
                    </div> 
            <?php }
        }else{?><div align='center'>
            <?php 
            print "<p><strong>There is no entry available.</strong></p>";
            print file_get_contents("../assets/image/empty.svg"); ?>
       </div>
        <?php }
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
        //exam
        public function viewClassExamSch($classes)
        {
            $this->connection();
            $sql="SELECT exam.classes,exam.count, staff_add.FirstName,staff_add.MiddleName,staff_add.LastName from exam inner join time_table on
                 exam.count = time_table.count inner join staff_add on time_table.class_teacher_id = staff_add.staff_id
               where exam.count in (".$classes.")";
            $view=mysqli_query($this->connect,$sql);
            if(mysqli_num_rows($view)>0){?>
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Sr.</th>
                        <th scope="col">Class</th>
                        <th scope="col">Class Teacher</th>
                        <th scope="col">View</th>
                        </tr>
                    </thead>
                    <?php   $i=1;
                while($fetch=mysqli_fetch_array($view)){?>
                   <tr>
                        <td><?php print $i;?></th>
                        <td><?php print $fetch['classes'];?></td>
                        <td><?php print "<b>".$fetch['FirstName']." ".$fetch['MiddleName']." ".$fetch['LastName']."</b>";?></td>
                        <td> <a href="exam/view.php?class=<?php print $fetch['count']?>">
                                 <button type="button" class="btn btn-sm btn-info"> VIEW</button></a></td>
                    </tr>
            <?php $i++;}         
            echo' </tbody>
            </table>';            
             }
    }
    public function examSchView($class_count){
        $this->connection();
        $imgres=mysqli_query($this->connect,"SELECT  `file_name` FROM `exam` WHERE `count`= $class_count");
       if(mysqli_num_rows($imgres)==1){
           while($get=mysqli_fetch_array($imgres)){?>
           <div class="table-view">
              <img src="../../uploads/examSch/<?php print $get['file_name'];?>" style="width:80%">
                
            </div> 
          <?php }
       }else{?><div align='center'>
          <?php 
              print "<p><strong>There is no entry available.</strong></p>";
              print file_get_contents("../../assets/image/empty.svg"); ?>
     </div>
  <?php }
  }
        
    
     //Removing material
    public function removeMaterial($val,$class,$postAssigned){
        if($postAssigned=="Asst. Teacher")
        {
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

//LIBRARY ADMIN
    //lib methods associated with lib-adm
     //book list
     public function getBookBankList($postAssigned){
      if( $postAssigned === "Librarian"){  $this->connection();
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
                          <a href="library_/book_edit.php?id=<?php echo $give['cnt'];?>">
                            <button type="button" style="float:center" class="btn btn-sm btn-warning">Edit</button>  
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
             print file_get_contents("assets/image/empty.svg");
                 } }
        }

        
         //all stdent issues list
         public function getissuedBookList($postAssigned)
         {  
            if( $postAssigned === "Librarian")
             {       $this->connection();
             $bookIsuuedList=mysqli_query($this->connect,"SELECT b.book_id,b.book_name ,s.student_id,s.FirstName, s.MiddleName,s.LastName, lbs.class,lbs.issueDate,lbs.fine,
                             lbs.returnStatus FROM student_add s INNER JOIN lib_student_bookstatus lbs on s.student_id = lbs.student_id
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
                  print file_get_contents("assets/image/empty.svg");
                      }}
         }
 
          //fine get function
       public function getLibFine($postAssigned){
        if( $postAssigned === "Librarian")
        {
            $this->connection();
        $sq=mysqli_query($this->connect,"SELECT `rate_per` FROM `lib_fine` WHERE 1");
        if(mysqli_num_rows($sq)){
            $fetch=mysqli_fetch_array($sq);
            return $fetch['rate_per'];
        }else return 0;}
    }

      //check if ID exist then rediect it to bok_issue.php page where details of that ID'd student will be shown
      public function checkStudentId($stuid,$postAssigned) {
        if( $postAssigned === "Librarian")
        { $this->connection();
            $stuid=intval($stuid);
            $sql="SELECT  `FirstName` FROM `student_add` WHERE `student_id` = ?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("i",$stuid);
            if($stmt->execute()){
                $stmt->store_result();
                 if($stmt->num_rows == 1)
                     echo "<script>location.href='library_/book_issue.php?id=".$stuid."'</script>";
             }else
             echo"<script>alert('Student ID is Invalid/Not Registered !!');</script>";
        }
        $stmt->close();
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

     //return book function
     public function ReturnBook($sid,$postAssigned)
     {
        if( $postAssigned === "Librarian")
        {
         $this->connection();
         $std=mysqli_query($this->connect,"SELECT `student_id` FROM `lib_student_bookstatus` WHERE `student_id`=$sid and `returnStatus`=0");
         if((mysqli_fetch_row($std)))
             echo "<script>location.href='library_/book_return.php?id=".$sid."'</script>";
         else
             echo "<script>alert('This Student has no Pending Books !!!');location.href='library.php'</script>";
     }}

      //fine updation
      public function updateLibFine($value,$postAssigned){
        if( $postAssigned === "Librarian")
        {$this->connection();
        $sql_update=mysqli_query($this->connect,"UPDATE `lib_fine` SET `rate_per`= $value WHERE 1");
        if($sql_update){
            echo "<script>alert('Fine update with ".$value."');location.href='library.php';</script>";
        }else{
            echo "<script>alert('Please Try again !!');location.href='library.php';</script>";
        }}
       }

       //this function updates fine of evry candiadate
       function updateEveryStudentFine($postAssigned)
       {
        if( $postAssigned === "Librarian")

        { $this->connection();
           $fine=$this->getLibFine($postAssigned);
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
                        echo "<script>alert('Fines Updated Successfully !!!');location.href='library.php'</script>;";
                    }else{
                        echo "<script>alert('Error Occured !!!');location.href='library.php'</script>;";
                    }
                }
            }else{
                 echo "<script>alert('Please Try again !!');location.href='library.php';</script>";
            }}
       }

       //adding new book to book bank
       public function addNewBook($postAssigned,$bid,$bname,$sub,$copies,$publication,$author,$YOP,$pubCon){
        if( $postAssigned === "Librarian")
        
        {           
            $this->connection();
            $sql="SELECT `book_id` FROM `lib_addbook` WHERE`book_id`=?";
            $stmt=$this->connect->prepare($sql);
            $stmt->bind_param("s",$bid);
            $stmt->execute();
            $stmt->store_result();
        //check if already exist if NOt then ADD
        if($stmt->num_rows >0){
            echo "<script>alert('This Book Id is Already registered !!');location.href='book_add.php'</script>";
            $stmt->close();
        }
            else{
                $this->connection();
                $copies=intval($copies);
                $YOP=intval($YOP);
                $qry="INSERT INTO `lib_addbook`(`book_id`, `book_name`, `subject`, `copies`, `yearOfpublicn`,`publication`, `author`, `publisherContact`) VALUES
                                 (?,?,?,?,?,?,?,?)";
                $stmt2=$this->connect->prepare($qry);
                $stmt2->bind_param("sssiisss",$bid,$bname,$sub,$copies,$YOP,$publication,$author,$pubCon);
                
                if($stmt2->execute())
                echo "<script>alert('Book Added Successfully!!'),location.href='../library.php'</script>";
                else
                echo "<script>alert('Error while Submitting your Request!! Retry');location.href='book_add.php'</script>";
                $stmt2->close();
        }}
    }

    public function validateBookcnt($bcnt,$postAssigned)
    {
        if( $postAssigned === "Librarian")
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
            header("location:../library.php");
        }
    }

    public function updateBookInfo($postAssigned,$bid,$bname,$sub,$copies,$publication,$author,$YOP,$pubCon,$changeId)
    {
        if( $postAssigned === "Librarian")
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
                    echo '<script>alert("Book Details Updated Successfully !!!");location.href="../library.php"</script>';
            else
                echo '<script>alert("Please Try again !!!");location.href="../library.php"</script>';
            $stmt->close();
        }

    }
    //deleting book
    public function RemoveThisBook($bookId,$postAssigned)
    {
        if( $postAssigned === "Librarian")
        {
        $this->connection();
        $check=mysqli_query($this->connect,"DELETE FROM `lib_addbook` WHERE `cnt`=$bookId");
        if($check){  echo"<script>alert('Removed Succesfully');location.href='../library.php'</script>";  }
        else{ echo "<script>alert('Please Try Again!!');location.href='../library.php</script>";}
        }}

     //validating student ID
     public function validateStudentID($sid){
        $this->connection();
        $val=mysqli_query($this->connect,"SELECT `student_id` FROM student_add WHERE `student_id`=$sid");
        if(mysqli_num_rows($val))
            return true;
        else    return false;
    }

    //book issue list of a prticular stdnt
    public function getPreviousBookIssueInfo($sid,$postAssigned){
        if( $postAssigned === "Librarian")
               {$this->connection();
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
                            <td><?php print ($row['returnStatus'])?"Returned":"Not Returned" ?></td>
                            <td><?php print $row['fine']?></td>
                        </tr>                    
       <?php    $i++; }?></tbody></table></div>
        <?php  }else echo "<b><i>No Previous Records Available!!!</i></b>";
    }}

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
                                echo "<script>alert('Book ".$bid." added to student ID : ".$sid."  !!');location.href='../library_/book_issue.php?id=".$sid."'</script>";
                    else
                            echo "<script>alert('Error while Submitting!! Try Again')</script>";
                    }
                    else
                            echo "<script>alert('Error Ocuured!! Try Again')</script>";         
         } else
                echo "<script>alert('Something Went Wrong!! Try Again')</script>";
        }  else {
               echo" <script>alert('This Book is Not Available !!');location.href='../library_/book_issue.php?id=".$sid."'</script>";
        }
  }

   //pay fine
   public function payAllfine($sid,$pg)
   {
       $this->connection();
               $fine=mysqli_query($this->connect,"UPDATE `lib_student_bookstatus` SET `fine`= 0 WHERE `student_id`=$sid");
               echo ($fine)?"<script>alert('Fine Removed');location.href='../library_/".$pg."?id=".$sid."'</script>": "<script>alert('Error Please try Again!!');location.href='../library_/".$pg."?id=".$sid."'</script>";
   }

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
           echo "<script>alert('This Student Has No Books To Return');location.href='../library.php'</script>";
        }
    }

    public function ReturnThisBook($bid,$sid)
    { $this->connection();
        $rtrn=mysqli_query($this->connect,"UPDATE `lib_student_bookstatus` SET `returnStatus`=1 WHERE `book_id`='$bid' and `student_id`= $sid");
        mysqli_query($this->connect,"UPDATE `lib_addbook` SET copies = copies+1 WHERE `book_id`= '$bid'");
        if($rtrn)
            echo"<script>alert('Return of Book ".$bid." is Successfull !!');location.href='../library_/book_return.php?id=".$sid."'</script>";
        else
            echo "<script>alert('Please Try Again !!!');location.href='../library_/book_return.php?id=".$sid."'</script>";
    }


    //when a non-librarian entity access lib
    public function getAllBookList()
    {
        $this->connection();
        $sql=mysqli_query($this->connect,"SELECT `book_id`, `book_name`, `subject`, `copies`, `yearOfpublicn`, `publication`, `author` FROM `lib_addbook` WHERE 1");
        if(mysqli_num_rows($sql)>0){?>
        <div class="table-responsive">
            <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Sr.</th>
                <th scope="col">BookID</th>
                <th scope="col">Name</th>
                <th scope="col">Subject</th>
                <th scope="col">Copies</th>
                <th scope="col">Publication</th>
                <th scope="col">Author</th>
                </tr>
            </thead>
            <tbody id="bookTab">
                <?php 
                   $i=1;
                    while($fetch=mysqli_fetch_array($sql)){?>
                        <tr>
                            <th scope="row"><?php print $i;?></th>
                            <td><?php print $fetch['book_id'];?></td>
                            <td><?php print $fetch['book_name'];?></td>
                            <td><?php print $fetch['subject'];?></td>
                            <td><?php print $fetch['copies'];?></td>
                            <td><?php print $fetch['yearOfpublicn'];?></td>
                            <td><?php print $fetch['publication'];?></td>
                            <td><?php print $fetch['author'];?></td>
                         
                        </tr>
                   <?php
                    $i++;}
                ?>
            </tbody>
            </table>
        </div>
       <?php }else{
            print "<div align='center'>";
                print "<p style='color:yellow'><strong>No Book Records Available.</strong></p>";
                print file_get_contents("assets/image/empty.svg");
                print '</div>';
        }
    }

//ATTENDANCE

    public function studentAttendanceByClass($class,$postAssigned)
    {
        if($postAssigned=="Asst. Teacher")
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
    echo ($stmt2->execute())?'<script>location.href="attendance.php";`document.getElementById("attendance_submit").disabled = true;`</script>':'<script>alert("ERROR")</script>'; 
   
    $stmt->close();
    $stmt2->close();
    }

    public function myClassAttendanceRecord($class,$postAssigned)
    {
        if($postAssigned=="Asst. Teacher")
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
    }}
 }$staffdatabase = new StaffDatabse();