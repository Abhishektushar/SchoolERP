<?php 
session_start();
require("../../base/database.php");
if(!isset($_SESSION['admin']))  
    header("location:../../");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add Book Bank</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="../assets/js/solid.js"  crossorigin="anonymous"></script>
    <script defer src="../assets/js/fontawesome.js" crossorigin="anonymous"></script>
<style>
.jumbotron{
  background: #acb6e5;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #86fde8, #acb6e5);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #86fde8, #acb6e5); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
</style>
</head>
<body>
  

    <!-- Page Content Holder -->
  <div class="wrapper">
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" align="center">
          <a href="../admin_library.php">
          <button type="button" class="btn btn-default btn-sm">&#8592 Back</button>
          </a>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
          <h3 style="margin:0  33% !important;text-align: center;">Delhi Public School</h3>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                </li> 
              </ul>
            </div>
          </div>
      </nav> 
        
          <div class="jumbotron"  style="width : 80%;margin: auto;font-size: 14px;">
             <h3 align="center">Add New Book</h3></br></br>
<!-- Add Book form Content -->
            <div class="container" align="center">
                <form id="bookForm" method="POST">
                  <div class="form-row">
                      <span class="form-group col-md-2"></span>
                      <div class="form-group col-md-4">
                      <label for="bookId"><i>Book ID</i></label>
                      <input type="text" class="form-control" id="bookId" name="bookId" placeholder="Assign Book ID" required>
                      </div>
                  
                      <div class="form-group col-md-4">
                      <label for="bookName"> <i>Book Name</i> </label>
                      <input type="text" class="form-control" id="bookName" name="bookName" placeholder="Name" required>
                      </div>
                      <span class="form-group col-md-2"></span>
                  </div> 

                  <div class="form-row">
                      <span class="form-group col-md-2"></span>
                      <div class="form-group col-md-4">
                      <label for="bookSubject"> <i>Subject</i></label>
                          <input type="text"  class="form-control" id="bookSubject" name="bookSubject" placeholder="Book Subject" required>
                      </div>
                  
                      <div class="form-group col-md-4">
                      <label for="copies"><i>Copies</i></label>
                          <input type="number" class="form-control" id="copies" name="copies" min="0" max="1000" oninput="this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Number of Copies" required >
                      </div>
                      <span class="form-group col-md-2"></span>
                  </div>
                  <br><div class="line"></div> 
                  <div class="form-row">
                      <span class="form-group col-md-2"></span>
                      <div class="form-group col-md-4">
                        <label for="publication"><i>Publication</i></label>
                          <input type="text" name="publication"  class="form-control" id="publication" placeholder="Publication Name" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="author"><i>Author</i></label>
                          <input type="text" name="author"  class="form-control" id="author" placeholder="Book Author" required>
                      </div>
                      

                      <span class="form-group col-md-2"></span>
                  </div>

                      <div class="form-row">
                      <span class="form-group col-md-2"></span>
                      <div class="form-group col-md-4"><label for="dateOfPublish"><i>Year Of Publish</i></label>
                      <input type="text" class="form-control" id="DOP" name="DOP" maxlength="4" oninput="this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="YYYY" required>
                      </div>
                      
              
                      <div class="form-group col-md-4">
                      <label for="publisherContact"><i>Publisher Contact</i></label>
                          <input type="email" name="publisherContact"  class="form-control" id="publisherContact" maxlength="30" placeholder="Publisher's Email" required>
                      </div>
                      <span class="form-group col-md-2"></span>
                  </div>
                </div>
                <div class="line"></div>
                 <br>
                <div class="container" align="center">
                    <button type="submit" id="addBook" name="addBook" class="btn btn-primary">SUBMIT</button>
                        <span class="form-group col-md-2"></span>
                    <button type="button" id="resetDetails" name="" onclick="resetFunction()" value="Reset" class="btn btn-success">RESET</button>
                </div> 
            </form> 
            </div>           
<!--End of Form Content -->
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

    <script type="text/javascript">
      
        function resetFunction() {        
          var ask = confirm("Are you sure You want to reset?");
          if (ask == true) {
            document.getElementById("bookForm").reset();
            document.documentElement.scrollTop = 0;
          } else {
             document.documentElement.scrollTop = 0;
          }
        }
  
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

    </script>
  </html>
  <?php
  if(isset($_POST['addBook'])){

      $bid=strip_tags($_POST['bookId']);
      $bname=strip_tags($_POST['bookName']);
      $sub=strip_tags($_POST['bookSubject']);
      $copies=strip_tags($_POST['copies']);
      $publication=strip_tags($_POST['publication']);
      $author=strip_tags($_POST['author']);
      $YOP=strip_tags($_POST['DOP']);
      $pubCon=strip_tags($_POST['publisherContact']);

  $database->addNewBook($bid,$bname,$sub,$copies,$publication,$author,$YOP,$pubCon);
}
  ?>