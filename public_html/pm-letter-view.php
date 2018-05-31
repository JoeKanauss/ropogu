<?php
	require_once('../inc/pm.class.php');
	
	session_start();
	
	$sessionId = $_SESSION['user_id'];
	$sessionUser = $_SESSION['username'];
	
	$pm = new pm();
	
	$letters = $pm->displayLetters($sessionId, "unseen");
	$letterCount = count($letters);
	
	if(isset($_REQUEST['pm_id']) && ($_REQUEST['pm_id'] > 0))
	{
			if($pm->load($_REQUEST['pm_id']))
			{
				$pmDataArray = $pm->data;
				$letterSender = $pm->findLetterSender($pmDataArray['from_id']);
				array_push($pmDataArray, $letterSender);
				
				if($pmDataArray['to_id'] == $sessionId)
				{
					$pm->letterHasBeenSeen($_REQUEST['pm_id']);
				}
				else
				{
					header('location: /ropogu(local)/public_html/user-logged.php?user_id='.$sessionId);
					exit;
				}
			}
			else
			{
				header('location: /ropogu(local)/public_html/user-logged.php?user_id='.$sessionId);
				exit;
			}
	}
	else
	{
		header('location: /ropogu(local)/public_html/user-logged.php?user_id='.$sessionId);
		exit;
	}


	include_once('../tpl/pm-letter-view.tpl.php');
?>