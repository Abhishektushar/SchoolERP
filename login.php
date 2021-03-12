<!DOCTYPE HTML>
<html>
	<head>
		<title>ABH Solutions! Login Here</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">
		<!-- Header -->
		<?php include_once "main/header.php"?>
		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<header class="align-center">
						<h2>Log IN &#59;&#41;</h2>
						<p>Enter details below to login.</p>
					</header>
					<!-- Elements -->						
						<div class="row 100%" >
							<div class="6u 12u$(medium) centerForm" >
					<!-- Form -->
						<form method="post" action="#">
							<div class="row uniform">
								<div class="6u 12u$(xsmall)">
									<input type="text" name="UserId" id="UserId" value="" placeholder="User Id" />
								</div>
								<div class="6u$ 12u$(xsmall)">
									<input type="password" name="Password" id="password" value="" placeholder="Password" />
								</div>
								<!-- Break -->
								<div class="12u$">
									<div class="select-wrapper">
										<select name="demo-category" id="demo-category">
											<option value="">---Select Your School---</option>
											<option value="1">Delhi Public School</option>
											<option value="2">Meerut Public School</option>
										</select>
									</div>
								</div>
								<!-- Break -->
								<div class="4u 12u$(small)">
									<input type="radio" name="user" value="student" id="student">
									<label for="student">Student</label>
								</div>
								<div class="4u 12u$(small)">
									<input type="radio" name="user" value="staff" id="staff">
									<label for="staff">Staff</label>
								</div>
								<div class="4u$ 12u$(small)">
									<input type="radio" name="user" value="admin" id="admin">
									<label for="admin">Admin</label>

								</div>
								<div>
									<input type="submit" value="Login" style="float:left">	
								</div>
							</div>
						</form>
		</div>
		</div>
	</div>
</section>
	
		

<?php include_once "main/myfooterElement.php" ?>
