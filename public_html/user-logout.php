<?php
	session_start();
	
	$_SESSION = array();
	
	header('location: ./ropogu.php');
	exit;
?>