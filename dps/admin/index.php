<?php 
session_start();
require("../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../");
?>
<?php include "includes/htmlHead.php";?>
    <title>Admin Panel</title>

<?php include "includes/metaCSSjs.php"?>

<style>
    .Box{
            background-color:#75daad ;
            border-radius:10px 10px;
            box-shadow:
            0 2.8px 2.2px rgba(0, 0, 0, 0.034),
            0 6.7px 5.3px rgba(0, 0, 0, 0.048),
            0 12.5px 10px rgba(0, 0, 0, 0.06),
            0 22.3px 17.9px rgba(0, 0, 0, 0.072),
            0 41.8px 33.4px rgba(0, 0, 0, 0.086),
            0 100px 80px rgba(0, 0, 0, 0.12)
            ;
            
            height:150px;
            min-width:180px;
            padding:3% 1%;
            margin: 10px 20px;
            justify-content:center;
            text-align:center;
            color: #ffffff;
       }
       .fas{
           color:#ffffff;
           margin-bottom:5px;
       }
       .container{
        margin:50px auto;
        width: 90%;
        height:auto;
        position: relative;
        align-items: center;
        justify-content: center;    
             }
            svg{
                width:75px;
                height:75px;
            }
        #pending{
            float:right;
            }
</style>
<div class="wrapper">
    <!-- Sidebar Holder -->
        <?php include "includes/sidebar.php"?>
    <!-- Page Content Holder -->
    <div id="content">
        <?php include "includes/upperNav.php"?>
        <?php if( $count=$database->enquiryCount()) {           
         print '<a href="admin_enquiry.php"><button type="button" class="btn btn-warning btn-sm" id="pending">
                    ENQUIRY <span class="badge badge-light">'.$count.'</span>
                 </button></a>';
                }?>
        <div class="container" align="center">
            <div class="row">
                <div class="col-sm-2 Box"><a href="admission/index.php"><svg class="bi bi-person-plus-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7.5-3a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
                    </svg><br>ADMISSION</a>
                </div>
                <div class="col-sm-2 Box"><a href="admin_student.php"><i class="fas fa-user-friends fa-4x"></i><br>STUDENT DETAILS</a></div>
                <div class="col-sm-2 Box"><a href="admin_staff.php"><i class="fas fa-user-tie fa-4x" ></i><br>STAFF DETAILS</a></div>
                <div class="col-sm-2 Box"><a href="admin_study_materials.php">
                    <svg class="bi bi-book-half" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3.214 1.072C4.813.752 6.916.71 8.354 2.146A.5.5 0 018.5 2.5v11a.5.5 0 01-.854.354c-.843-.844-2.115-1.059-3.47-.92-1.344.14-2.66.617-3.452 1.013A.5.5 0 010 13.5v-11a.5.5 0 01.276-.447L.5 2.5l-.224-.447.002-.001.004-.002.013-.006a5.017 5.017 0 01.22-.103 12.958 12.958 0 012.7-.869zM1 2.82v9.908c.846-.343 1.944-.672 3.074-.788 1.143-.118 2.387-.023 3.426.56V2.718c-1.063-.929-2.631-.956-4.09-.664A11.958 11.958 0 001 2.82z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M12.786 1.072C11.188.752 9.084.71 7.646 2.146A.5.5 0 007.5 2.5v11a.5.5 0 00.854.354c.843-.844 2.115-1.059 3.47-.92 1.344.14 2.66.617 3.452 1.013A.5.5 0 0016 13.5v-11a.5.5 0 00-.276-.447L15.5 2.5l.224-.447-.002-.001-.004-.002-.013-.006-.047-.023a12.582 12.582 0 00-.799-.34 12.96 12.96 0 00-2.073-.609z" clip-rule="evenodd"/>
                    </svg><br>STUDY MATERIALS</a>
                </div>
            <!-- </div>
            <div class="row"> -->
                <div class="col-sm-2 Box"><a href="admin_accounting.php">
                    <svg class="bi bi-pie-chart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M15.985 8.5H8.207l-5.5 5.5a8 8 0 0013.277-5.5zM2 13.292A8 8 0 017.5.015v7.778l-5.5 5.5zM8.5.015V7.5h7.485A8.001 8.001 0 008.5.015z"/>
                    </svg><br>ACCOUNTING</a>
                </div>
                <div class="col-sm-2 Box"><a href="admin_transport.php"><svg class="bi bi-arrow-up-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M10.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L11 3.707 8.354 6.354a.5.5 0 11-.708-.708l3-3zm-9 7a.5.5 0 01.708 0L5 12.293l2.646-2.647a.5.5 0 11.708.708l-3 3a.5.5 0 01-.708 0l-3-3a.5.5 0 010-.708z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M5 2.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V3a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                    </svg><br>TRANSPORT</a>
                </div>
                <div class="col-sm-2 Box"><a href="admin_timetable.php"><svg class="bi bi-table" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                    <path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M15 4H1V3h14v1z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M5 15.5v-14h1v14H5zm5 0v-14h1v14h-1z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M15 8H1V7h14v1zm0 4H1v-1h14v1z" clip-rule="evenodd"/>
                    <path d="M0 2a2 2 0 012-2h12a2 2 0 012 2v2H0V2z"/>
                    </svg><br>TIME TABLE</a>
                </div>
                <div class="col-sm-2 Box"><a href="admin_library.php">
                    <svg class="bi bi-person-lines-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7 1.5a.5.5 0 01.5-.5h2a.5.5 0 010 1h-2a.5.5 0 01-.5-.5zm-2-3a.5.5 0 01.5-.5h4a.5.5 0 010 1h-4a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h4a.5.5 0 010 1h-4a.5.5 0 01-.5-.5zm2 9a.5.5 0 01.5-.5h2a.5.5 0 010 1h-2a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                    </svg><br>LIBRARY</a>
                </div>
            <!-- </div>
            <div class="row"> -->
                <div class="col-sm-2 Box"><a href="admin_examination.php"><svg class="bi bi-calendar" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                    <path fill-rule="evenodd" d="M14 0H2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 7a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm-9 3a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm-9 3a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg><br>EXAMINATION</a>
                </div>
                <div class="col-sm-2 Box"><a href="admin_attendance.php">
                    <svg class="bi bi-person-check-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm9.854-2.854a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0l-1.5-1.5a.5.5 0 01.708-.708L12.5 7.793l2.646-2.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                    </svg><br>ATTENDENCE</a>
                </div>
                <div class="col-sm-2 Box"><a href="admin_hostel.php"><svg class="bi bi-house" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                    <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 00.5.5h9a.5.5 0 00.5-.5V7h1v6.5a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 012 13.5zm11-11V6l-2-2V2.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 011.414 0l6.647 6.646a.5.5 0 01-.708.708L8 2.207 1.354 8.854a.5.5 0 11-.708-.708L7.293 1.5z" clip-rule="evenodd"/>
                    </svg><br>HOSTEL</a>
                </div>
                <div class="col-sm-2 Box"><a href="admin_notice.php"><svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/>
                    </svg><br>POST NOTICE</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    });
</script>
      <?php include "includes/lowerHtml.php"?>

