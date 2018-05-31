<?php
require_once('../inc/user.class.php');
require_once('../inc/pm.class.php');

$user = new user();

$userDataArray = array();

$userErrorsArray = array();

if(isset($_REQUEST['login']))
{
	$userDataArray = $_POST;

	$user->sanitize($userDataArray);
	$user->set($userDataArray);
	

	$userId = $user->checkLogin($userDataArray['username'], $userDataArray['password']);
		
	if($userId)
	{
		session_start();
		$_SESSION['user_id'] = $userId;
		$sessionId = $_SESSION['user_id'];
		$user->load($sessionId);
		$userDataArray = $user->data;
		$_SESSION['username'] = $userDataArray['username'];
		$sessionUser = $_SESSION['username'];
		$_SESSION['familioli'] = $userDataArray['familioli'];
		
		
		header('location: /ropogu(local)/public_html/user-logged.php');
		exit;
	}
	else
	{
		echo "username and password do not match";
	}
}

require_once('../tpl/ropogu.tpl.php');
?>