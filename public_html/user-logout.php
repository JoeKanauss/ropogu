<?php
	session_start();
	
	$_SESSION = array();
	
	header('location: /ropogu(local)/ropogu.php');
	exit;
?>