<!-- Query form -->

<div class="col-sm-5">
<div class="container-fluid text-center">
	<form  class="form-horizontal" method="POST">
	<h2 align="center">QUERY FORM</h2>
    
    <div class="form-group">
			<label class="control-label col-sm-2" for="name">Name:</label>
			<div class="col-sm-10">
				<input type="text" name="name" class="form-control" id="name" placeholder="your name">
			</div>
		</div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10"> 
        <input type="email" name="email" class="form-control" id="email" placeholder=" email@domain.com">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="contact">Contact:</label>
      <div class="col-sm-10"> 
        <input type="text" name="contact" class="form-control" id="contact" placeholder="your phone number">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="city">City:</label>
      <div class="col-sm-10">
        <input type="text" name="city" class="form-control" id="city" placeholder="your city">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="city">Enquiry:</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="enquiry" form="usrform">	
        </textarea>
      </div>
    </div>
    
    <div class="form-group"> 
      <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submitq" class="btn btn-success">Submit
      </button>
      </div>
    </div>

	</form>
	</div>
</div>

<!-- PHP code for database connection-->

<?php
$c=mysqli_connect("localhost","root","","school");
if(isset($_POST["submitq"])) 
    {    
    $name=$_POST["name"];
    $email=$_POST["email"];
    $contact=$_POST["contact"];
    $city=$_POST["city"];
    $enquiry=$_POST['enquiry'];

    $sql="insert into `query` values('$name','$email','$contact','$city','$enquiry')";
    mysqli_query($c,$sql);
    }   
    
?>