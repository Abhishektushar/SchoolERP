<!DOCTYPE HTML>

<html>
	<head>
		<title>ABH Solutions! Join Us</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style>
		.uniform{
			height:80px !important;
		}
		</style>
	</head>
	<body class="subpage">

		<!-- Header -->
		<?php include_once "main/header.php"?>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner myForms">
					<header class="align-center">
						<h2>Join US &#59;&#41;</h2>
						<p>Fill up the forms below to join.</p>
					</header>

					<!-- Elements -->
						<h3 id="elements" align= "center"><b>Form</b></h3>
						<div class="row 100% " >
							<div class="6u 12u$(medium) centerForm" >
					<!-- Form -->

						<form method="post" action="#">
							<div class="row uniform">
								<div class="6u 12u$(xsmall)">
									<input type="text" name="demo-name" id="demo-name" value="" placeholder="Full Name" />
								</div>
								<div class="6u$ 12u$(xsmall)">
									<input type="email" name="demo-email" id="demo-email" value="" placeholder="Email" />
								</div>
								<!-- Break -->
								<div class="12u$">
									<div class="select-wrapper">
										<select name="demo-category" id="demo-category">
											<option value="">- Category -</option>
											<option value="1">Primary School</option>
											<option value="1">Middle School</option>
											<option value="1">High School</option>
											<option value="1">College</option>
										</select>
									</div>
								</div>
								<!-- Break -->
								<div class="4u 12u$(small)">
									<input type="radio" id="demo-priority-low" name="demo-priority" checked>
									<label for="demo-priority-low">Low Priority</label>
								</div>
								<div class="4u 12u$(small)">
									<input type="radio" id="demo-priority-normal" name="demo-priority">
									<label for="demo-priority-normal">Normal Priority</label>
								</div>
								<div class="4u$ 12u$(small)">
									<input type="radio" id="demo-priority-high" name="demo-priority">
									<label for="demo-priority-high">High Priority</label>
								</div>
								<!-- Break -->
								<div class="6u 12u$(small)">
									<input type="checkbox" id="demo-copy" name="demo-copy">
									<label for="demo-copy">Email me a copy of this message</label>
								</div>
								<div class="6u$ 12u$(small)">
									<input type="checkbox" id="demo-human" name="demo-human" checked>
									<label for="demo-human">I am a human and not a robot</label>
								</div>
								<!-- Break -->
								<div class="12u$">
									<textarea name="demo-message" id="demo-message" placeholder="Enter your message" rows="6"></textarea>
								</div>
								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input type="submit" value="Send Message" /></li>
										<li><input type="reset" value="Reset" class="alt" /></li>
									</ul>
								</div>
							</div>
						</form>
					</div>
		</div>
                </div></section>
		

<?php include_once "main/myfooterElement.php" ?>
