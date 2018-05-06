<?php
require_once('../inc/user.class.php');

$user = new user();

$userDataArray = array();

$userErrorsArray = array();

if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0)
{
	$user->load($_REQUEST['user_id']);
	$userDataArray = $user->data;
}

if(isset($_POST['save']))
{
	$userDataArray = $_POST;
	
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
			
			header('location: /ropogu(local)/public_html/user-login.php');
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

require_once('../tpl/user-edit.tpl.php');
?>