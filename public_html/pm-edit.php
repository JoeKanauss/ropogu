<?php
require_once('../inc/pm.class.php');
require_once('../inc/user.class.php');
	
session_start();

$user = new user();
$pm = new pm();

$sessionUser = $_SESSION['username'];
$sessionId = $_SESSION['user_id'];

if(!isset($_SESSION['user_id']))
{
	header('location: /ropogu(local)/public_html/ropogu.php');
	exit;
}

$user->load($sessionId);
$userDataArray = $user->data;

$letters = $pm->displayLetters($sessionId, "unseen");

$letterCount = count($letters);
	
if($letterCount == 0)
{
	$letterCount = "";
}
	
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
					header('location: /ropogu(local)/public_html/user-logged.php?user_id='.$sessionId);
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