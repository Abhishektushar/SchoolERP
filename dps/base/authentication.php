<?php 
  class Authentication {
      //connection
      public $connect;  //for connection
      
    public function connection() {

        return $this->connect=mysqli_connect('localhost','root','','dps');
     }
 //Authenticating user
        public function userLogin($uid,$utype,$pwd){
            $this->connection();    
                       
              if($utype=="ADMIN")
              {   
                  $sql="SELECT `user_id`, `user_type` FROM `user_list` WHERE `user_id`=? and `user_type`= ?
                                         and `user_password`=? ";   
                  $stmt=$this->connect->prepare($sql);
                  $stmt->bind_param("sss",$uid,$utype,$pwd);
                  $stmt->execute();
                  $stmt->store_result();
                  $stmt->bind_result($userID,$userType);
                  $stmt->fetch();
                  
                if($stmt->num_rows == 1){
                    $_SESSION['admin']= $userID;   
                    $_SESSION['utype']= $userType;   
                    header("location:admin/");   
                    
                    $stmt->close();
                }else
                    echo"<script>alert('Your ID/Password does not exist');location.href='index.php';</script>";
               }                                    
               //when STUDENT Logs In
               elseif ($utype=="STUDENT") {
                $sql="SELECT `user_id`, `user_type` FROM `user_list` WHERE `user_id`=? AND `user_type`= ? AND `user_password`=? AND `allow_access`=1"; 

                $stmt=$this->connect->prepare($sql);
                $stmt->bind_param("sss",$uid,$utype,$pwd);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($userID,$userType);
                $stmt->fetch();
                
                if($stmt->num_rows == 1){
                  $stmt->close();
                  $sql="SELECT student_add.student_id,student_add.FirstName,student_add.LastName,student_add.current_class,student_add.Facility,
                        user_list.user_type FROM student_add INNER JOIN user_list ON student_add.student_id = user_list.user_id WHERE user_list.user_type=? AND user_list.user_id=?";
                  
                $stmt=$this->connect->prepare($sql);
                $stmt->bind_param("ss",$userType,$userID);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($sid,$first,$last,$class,$facility,$userType);
                $stmt->fetch();
                if($stmt->num_rows == 1){

                  $_SESSION['studentId']= $sid;   
                  $_SESSION['firstName']=$first;
                  $_SESSION['lastName']=$last;
                  $_SESSION['class']=$class;
                  $_SESSION['facility']=$facility;
                  $_SESSION['student']=$userType;
              
                  header("location:student/");    
                  $stmt->close();                 
                }
                  
              }else
                  echo"<script>alert('Your ID/Password does not exist');location.href='index.php'</script>";
             } 
             elseif ($utype=="STAFF") {
               $sql="SELECT `user_id`, `user_type` FROM `user_list`  WHERE `user_id`=? and `user_type`=? AND `user_password`=? AND `allow_access`=1";
              
               $stmt=$this->connect->prepare($sql);
                $stmt->bind_param("sss",$uid,$utype,$pwd);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($userID,$userType);
                $stmt->fetch();
                if($stmt->num_rows == 1){

                  $sql2="SELECT `staff_id`, `FirstName`, `LastName`,`position`, `post_assigned`, `class_assigned` FROM `staff_add` WHERE `staff_id`= ?";

                  $stmt2=$this->connect->prepare($sql2);
                  $stmt2->bind_param("s",$userID);
                  $stmt2->execute();
                  $stmt2->store_result();
                  $stmt2->bind_result($uId,$firstName,$lastName,$post,$post_assigned,$classes);
                  $stmt2->fetch();
                  if($stmt2->num_rows == 1){
                    $_SESSION['staff']=$userType;//for every staff member this will be initialized
                    $_SESSION['staffId']=$uId;
                    $_SESSION['first']=$firstName;
                    $_SESSION['last']=$lastName;
                    $_SESSION['post']=$post;
                    $_SESSION['post_assigned']=$post_assigned;
                    $_SESSION['classes']=$classes;

               $stmt->close();
                    $uId=intval($uId);
                    $sql="SELECT `classes` FROM `time_table` WHERE `class_teacher_id`=?";
                    $stm=$this->connect->prepare($sql);
                    $stm->bind_param("i",$uId);
                    $stm->execute();
                    $stm->store_result();
                    $stm->bind_result($classT);
                    $stm->fetch();
                    if($stm->num_rows == 1){
                      $x=explode(' ',$classT);  $classTeacherof=intval($x[1]);//extarcting integral value from class
                      $_SESSION['class_teacher']=$classTeacherof;//class teacher class
                    }else{
                      $_SESSION['class_teacher']=NULL;
                    }
                    $stmt2->close();
                    $stm->close();
                  header("location:staff/"); 
                  }
                }else{
                  echo"<script>alert('Your ID/Password does not exist');location.href='index.php'</script>";
                }
              } 
             
    }
  }
  $authentication= new authentication();
  ?>