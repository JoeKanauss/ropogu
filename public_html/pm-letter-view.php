<?php
	require_once('../inc/pm.class.php');
	
	session_start();
	
	$sessionId = $_SESSION['user_id'];
	
	$pm = new pm();
	
	if(isset($_REQUEST['pm_id']) && ($_REQUEST['pm_id'] > 0))
	{
			$pm->load($_REQUEST['pm_id']);
			$pmDataArray = $pm->data;
		
			if($pmDataArray['to_id'] == $sessionId)
			{
				$pm->letterHasBeenSeen($_REQUEST['pm_id']);
			}
			else
			{
				header('location: user-list.php');
				exit;
			}
	}


	include_once('../tpl/pm-letter-view.tpl.php');
?>