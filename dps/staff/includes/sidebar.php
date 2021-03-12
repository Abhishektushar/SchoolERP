    <nav id="sidebar">            

           <ul class="list-unstyled components">
                <p class="username"><a href="index.php"><?php echo $_SESSION['first']." ".$_SESSION['last']?></a></p>
                <hr>
              
                <li>
                    <a href="students.php">Student</a>
                </li>
                <li> 
                    <a href="Profile.php">My Profile</a>
                </li>
               
             <?php  if(isset($_SESSION['post_assigned'])){
             if($_SESSION['post_assigned']==="Asst. Teacher"){
             echo '<li>
                   <a href="study_materials.php">Study Material</a>
               </li>';}} ?>
                
            <?php if($_SESSION['post']==="Transport Officer")
            { echo '<li>
                    <a href="transport.php">Transport</a>
                </li>';}?>

            <?php if($_SESSION['post']==="Warden")
            {echo '<li>
                    <a href="Hostel.php">Hostel</a>
                </li>';}?>
                
    <?php  if($_SESSION['post_assigned']==="Librarian" || $_SESSION['post_assigned']==="Asst. Teacher" )
           { echo '<li>
                    <a href="library.php">Library</a>
                </li>';
                }?>
    <?php if( isset($_SESSION['post'])){
        if ($_SESSION['post']=="Lab Assistant"){
                echo '<li>
                    <a href="library.php">Library</a>
                </li>';
                echo '<li>
                           <a href="timetable.php">Time Table</a>
                        </li>';
                echo '<li>
                    <a href="examination.php">Examination</a>
                </li>';
    }}?>
                
  <?php if($_SESSION['post_assigned']==="Librarian" || $_SESSION['post_assigned']==="Asst. Teacher" )
            {echo '<li>
                    <a href="timetable.php">Time Table</a>
                </li>'; }?>    
            
                <?php if($_SESSION['post_assigned']==="Asst. Teacher" )
             {echo '<li>
                    <a href="examination.php">Examination</a>
                </li>';}?>
                
           <?php if($_SESSION['post_assigned']==="Asst. Teacher")
            { echo '<li>
                    <a href="attendance.php">Attendance</a>
                  </li>';}?>
               
                <li>
                    <a href="notice.php">Notice</a>
                </li>
                <li>
                    <a href="Enquiry.php">Enquiry</a>
                </li>
            </ul>

          <a href="setting.php"> <span class="chngp"><svg class="bi bi-gear" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                </svg></span>
            </a> 
            <a href="logout.php"> <span class="chngp"><svg class="bi bi-box-arrow-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.354 11.354a.5.5 0 0 0 0-.708L1.707 8l2.647-2.646a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708 0z"/>
                <path fill-rule="evenodd" d="M11.5 8a.5.5 0 0 0-.5-.5H2a.5.5 0 0 0 0 1h9a.5.5 0 0 0 .5-.5z"/>
                <path fill-rule="evenodd" d="M14 13.5a1.5 1.5 0 0 0 1.5-1.5V4A1.5 1.5 0 0 0 14 2.5H7A1.5 1.5 0 0 0 5.5 4v1.5a.5.5 0 0 0 1 0V4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5H7a.5.5 0 0 1-.5-.5v-1.5a.5.5 0 0 0-1 0V12A1.5 1.5 0 0 0 7 13.5h7z"/>
                </svg></span>
            </a> 
        </nav>
