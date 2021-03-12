<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<?php include "../includes/htmlHead.php" ?>    
    <title>Admission</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
    <style>
        .addBox{
            background-color:#08ffc8 ;
            border-radius:10px 10px;
            box-shadow:
            0 2.8px 2.2px rgba(0, 0, 0, 0.034),
            0 6.7px 5.3px rgba(0, 0, 0, 0.048),
            0 12.5px 10px rgba(0, 0, 0, 0.06),
            0 22.3px 17.9px rgba(0, 0, 0, 0.072),
            0 41.8px 33.4px rgba(0, 0, 0, 0.086),
            0 100px 80px rgba(0, 0, 0, 0.12)
            ;
            height:200px;
            width: 250px;
            padding:10px;
            margin: 30px;
          
        }
        .icon{
                margin:15%;
        }
        p{
            font-weight:bold;
            color:#FFFFFF;
            margin:15px;
        } 
        .container{
            margin-top:100px;
            display:flex;
            justify-content:center;
        }
        .staff{
            background-color:#5fdde5  !important;
        }
    
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
      
        <?php include "sidebar.php"?>

        <!-- Page Content Holder -->
        <div id="content">
            <?php include "upperNav.php" ?>
            <div class="container" align="center">
                <div class="addBox">
                   <a href="admission_student.php"> 
                    <div class="icon" align="center"><i class="fas fa-user-plus fa-5x"></i><p>ADD STUDENT</p></div></a>
                </div>
                
                <div class="addBox staff">
                    <a href="admission_staff.php">
                        <div class="icon" align="center"><i class="fas fa-user-tie fa-5x"></i><p>ADD STAFF</p></div>
                    </a>
                </div>
            </div>
    </div>

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
</body>

</html>