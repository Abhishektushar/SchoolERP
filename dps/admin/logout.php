<?php
session_start();

if (!isset($_SESSION['admin'])){
	header('location: ../');
}
session_destroy();
header('location: ../');
?>