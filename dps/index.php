<?php
session_start();
require "base/authentication.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Login</title>
     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="assets/js/fontawesome.js" crossorigin="anonymous"></script>
    
<style>
    body{
        background-image: url('images/loginbg.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;  
        background-size: cover;
    }
	.heading{
        background-color: BLUE;
    }

	.form{
		background-image: url("images/formbg.jpg");
        width: 600px;
        height:400px;
		border-style: dotted;
  		border: 5px solid yellow;  
		padding: 45px;
		margin: 10% auto;
	
	}
    button{
        margin:3%;
    }
    #focusedInput{
        width:70%;
    }
    #home{
        margin:20px;
    }
   
</style>

</head>
<body >
<a href="../"><button id="home" type="button" class="btn btn-sm btn-default">BACK TO HOME</button></a>
        <div class="form" >
        <div class="container-fluid text-left">
            <form  class="form-horizontal" method="POST">
                    <div class="form-group">
                        <div class="col-md-10">
                            <label>Username:</label>
                            <input type="text" name="username" placeholder="Enter Username" class="form-control" id="focusedInput" required></input>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10">
                            <label>Password:</label>
                            <input type="password" name="pwd" placeholder="Enter password" class="form-control" id="focusedInput" required></input>
                        </div>
                    </div>
                            <br>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>User Type:</label><br>
                                   <select class="form-control col-sm-8" name="user" required>
                                        <option value="">SELECT</option>
                                        <option value="STUDENT">STUDENT</option>
                                        <option value="ADMIN">ADMIN</option>
                                        <option value="STAFF">STAFF</option>
                                   </select>                   
                        </div>
                        <button type="submit" name="login_btn" value="login" class="btn btn-success">Submit</button> 
                    </div >

                </form>
            </div>
        </div>
    </body>
</html> 
<?php
    if (isset($_POST['login_btn'])){
        if(!empty($_POST["username"]) && !empty($_POST["pwd"]) && !empty("user"))
         {        
        $uname=strip_tags($_POST['username']);
        $pwd=strip_tags($_POST['pwd']);
        $utype=strip_tags($_POST['user']);
        $authentication->userLogin($uname,$utype,$pwd);
        }
        else{
            echo "<script>document.getElementById('errMsg').innerHTML = 'Some Field(s) are Empty !!!';</script>";
        }
    }   
?>
