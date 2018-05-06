<?php
	require_once('../inc/pm.class.php');
	
	session_start();
	
	$sessionId = $_SESSION['user_id'];
	
	$pm = new pm();
	
	$allLetters = $pm->displayLetters($sessionId, null);
	$unseenLetters = $pm->displayLetters($sessionId,"unseen");
	
	include_once('../tpl/pm-list.tpl.php');
?>