<?php
	require_once('../inc/user.class.php');
	require_once('../inc/pm.class.php');
	
	session_start();
	$sessionId = $_SESSION['user_id'];
	$sessionUsername = $_SESSION['username'];
	
	if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0)
	{
		$user = new user();
		
		$user->load($_REQUEST['user_id']);
		$userDataArray = $user->data;
		
		$pm = new pm();
		
		
		
		if(isset($_POST['sendPm']))
		{
			$pmDataArray = $_POST;
			$pmDataArray['from_id'] = $sessionId;
			$pmDataArray['to_id'] = $_REQUEST['user_id'];
			$pmDataArray['seen'] = 0;
			$pmDataArray['date'] = date('Y-m-d H:i:s');
			
			//sanitize
			$pm->sanitize($pmDataArray);
			$pm->set($pmDataArray);
	
			//validate
			if($pm->validate())
			{
				//save
				if($pm->save())
				{
					header('location: /ropogu(local)/tpl/pm-confirm.tpl.php');
					exit;
				}
				else
				{
					$pmErrorsArray[] = "Save failed";
				}
			}
			else
			{
				$pmDataArray = $pm->data;
				$pmErrorsArray = $pm->errors;
			}
		}
	}
	else{
		header('location: user-list.php');
		exit;
	}

	include_once('../tpl/pm-edit.tpl.php');
?>