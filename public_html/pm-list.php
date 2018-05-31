<?php
	require_once('../inc/pm.class.php');
	
	session_start();
	
	$sessionId = $_SESSION['user_id'];
	$sessionUser = $_SESSION['username'];
	
	if(!isset($_SESSION['user_id']))
	{
		header('location: /ropogu(local)/public_html/ropogu.php');
		exit;
	}
	
	$pm = new pm();
	
	$letters = $pm->displayLetters($sessionId, "unseen");
	$letterCount = count($letters);
	
	$allLetters = $pm->displayLetters($sessionId, null);
	$unseenLetters = $pm->displayLetters($sessionId,"unseen");
	
	include_once('../tpl/pm-list.tpl.php');
?>