<?php
session_start();

if (!isset($_SESSION['staff'])){
	header('location: ../');
}
if((!isset($_SESSION['staff'] ) && (!isset($_SESSION['post'])) && (!isset($_SESSION['staffId'])) ))  
	header("location:../");
	
session_destroy();
header('location: ../');
?>