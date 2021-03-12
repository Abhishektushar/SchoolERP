<?php 
session_start();
require("../../base/database.php");
if((!isset($_SESSION['admin'] ) ))  
    header("location:../../");
?>
<?php if((!isset($_SESSION['TUTYPE']))  || (!isset($_SESSION['TUID'])))
    header("location:../admin_setting.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Information</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
    <style>

.jumbotron{
    width:80%;
    margin:auto;
    background: #2BC0E4;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #EAECC6, #2BC0E4);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #EAECC6, #2BC0E4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.myfields{
    width:300px;
    margin:auto;
}
.myfields input{
    margin-bottom:20px;

}
.btn{
    margin-top:20px;
}
.myfields{
    width:300px;
    margin:auto;
}
.myfields input{
    margin-bottom:20px;
}
</style>
</head>

<body>
    <div class="wrapper">
        <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid" align="center">
                        <a href="../admin_setting.php">
                       <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
                        </a>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                        <h2 style="margin:0  31% !important;text-align: center;font-size:4.5vh">Delhi Public School</h2>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </nav> 
            <div class="jumbotron" align="center">  
                <?php $res=($database->getThisUserLoginInfo($_SESSION['TUTYPE'],$_SESSION['TUID'])); ?>
                        <h4><?php ($_SESSION['TUTYPE']=="STUDENT")?$database->getStudentName($_SESSION['TUID']):$database->getStaffName($_SESSION['TUID']);?></h4>
                         <form method="POST">
                         <div class="myfields">
                         <label for="id">USER ID</label>
                        <input type="text" class="form-control" value="<?php print $res[0]; ?>"disabled >
                        <label for="id">USER TYPE</label>
                        <input type="text" class="form-control" value="<?php print $res[1]; ?>" disabled >
                        <label for="id">PASSWORD</label>
                        <input type="text" class="form-control" value="<?php print $res[2]; ?>" name="upwd" >
                        <label for="id">ACCESS </label>
                        <select name="access" class="form-control" >
                            <option value="<?php print($res[3])?"YES":"NO"?>"><?php print($res[3])?"YES":"NO"?></option>
                            <option value="<?php print($res[3])?"NO":"YES"?>"><?php print($res[3])?"NO":"YES"?></option>
                        </select>
                         </div>
                         <button class="btn btn-warning" name="update" type="submit">UPDATE</button>
                         </form>
             </div>                                         
</div>
</div>
</body>     
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../assets/js/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="../assets/js/popper.min.js"  crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</html>
<?php
if(isset($_POST['update'])){
    $userPwd=$_POST["upwd"];
    $access=($_POST['access']=="YES")?1:0;
    
    $database->updateThisUserLoginInfo($_SESSION['TUTYPE'],$_SESSION['TUID'],$userPwd, $access);
}
?>