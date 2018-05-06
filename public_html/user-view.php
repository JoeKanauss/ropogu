<?php
require_once('../inc/user.class.php');
require_once('../inc/post.class.php');

$user = new user();
$userDataArray = array();

$post = new post();
session_start();

if(isset($_SESSION['username']))
{
	$sessionUser = $_SESSION['username'];
 	$sessionId = $_SESSION['user_id'];
	$sessionFamilioli = $_SESSION['familioli']; 
}
else
{
	$sessionUser = "";
	$sessionId = "";
	$sessionFamilioli = "";
}




if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] > 0)
{
	$user->load($_REQUEST['user_id']);
	$userDataArray = $user->data;
	
	if($sessionId == $_REQUEST['user_id'])
	{
		header('location: user-logged.php');
		exit;
	}
}

//if the "add to familioli" button is set,
if(isset($_REQUEST['addToFamilioli']))
{
	//echo "Hooray!<br><br>";
	$newFamilioli = $user->addUserToFamilioli($_REQUEST['user_id'], $sessionId);
	$_SESSION['familioli'] = $newFamilioli;
	
	header('Refresh:0');
	exit;
}

 if(isset($_REQUEST['deleteFromFamilioli']))
{
	$newFamilioli = $user->deleteFromFamilioli($_REQUEST['user_id'], $sessionId);
	$_SESSION['familioli'] = $newFamilioli;
	
	header('Refresh:0');
	exit;
} 

$userViewPosts = $post->displayPosts(null, null, $userDataArray['user_id']);

require_once('../tpl/user-view.tpl.php');
?>