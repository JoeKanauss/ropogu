<?php
require_once('../inc/user.class.php');
require_once('../inc/pm.class.php');

session_start();

$user = new user();

$userDataArray = array();

$userErrorsArray = array();

$pm = new pm();

if(isset($_SESSION['user_id']))
{
	$sessionUser = $_SESSION['username'];
	$sessionId = $_SESSION['user_id'];

	$user->load($sessionId);
	$userDataArray = $user->data;
	
	$userId = $userDataArray['user_id'];
	$userPass = $userDataArray['password'];

	$letters = $pm->displayLetters($sessionId, "unseen");

	$letterCount = count($letters);
	
	if($letterCount == 0)
	{
		$letterCount = "";
	}

	if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0)
	{
		$user->load($_REQUEST['user_id']);
		$userDataArray = $user->data;
	}

	if(isset($_POST['save']))
	{
		$userDataArray = $_POST;
		$userDataArray['user_id'] = $userId;
		$userDataArray['password'] = $userPass;
		
		//var_dump($userDataArray); die;
	
		//sanitize
		$user->sanitize($userDataArray);
		$user->set($userDataArray);
	
		//validate
		if($user->validate())
		{
			//save
			if($user->save())
			{
				$user->saveImage($_FILES['user_image']);
			
				$user->savePipPic($_FILES['rpp-pic']);
			
				header('location: /ropogu(local)/public_html/user-logged.php?user_id='.$userDataArray['user_id']);
				exit;
			}
			else
			{
				$userErrorsArray[] = "Save failed";
			}
		}
		else
		{
			$userDataArray = $user->data;
		
			$userErrorsArray = $user->errors;
		}
	}
	
	if(isset($_POST['cancel']))
	{
		header('location: /ropogu(local)/public_html/user-logged.php?user_id='.$sessionId);
		exit;
	}
}
if(isset($_POST['cancel']))
	{
		header('location: /ropogu(local)/public_html/ropogu.php');
		exit;
	}

require_once('../tpl/user-edit.tpl.php');
?>