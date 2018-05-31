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
	$pm = new pm();
	
	$sessionUserId = $_SESSION['user_id'];
	
	if(isset($_REQUEST['pm_id']) && ($_REQUEST['pm_id'] > 0))
	{
		$pm->load($_REQUEST['pm_id']);
		$pmData = $pm->data;
		$letterSender = $pm->findLetterSender($pmData['from_id']);
		array_push($pmData, $letterSender);
		
		if($sessionUserId == $pmData['to_id'])
		{	
			if(isset($_POST['deletePm']))
			{
				if($_POST['delete']=="yes")
				{
					$pm->delete($_REQUEST['pm_id']);
					
					header('location: user-logged.php');
					exit;
				}
				else
				{
					header('location: user-logged.php');
					exit;
				}
			}
			
		}
		else
		{
			header('location: user-logged.php');
			exit;
		}
	}
	else
	{
		header('location: user-logged.php');
		exit;
	}

	require_once('../tpl/pm-delete.tpl.php');
?>