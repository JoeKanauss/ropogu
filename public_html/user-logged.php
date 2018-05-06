<?php
require_once('../inc/user.class.php');
require_once('../inc/post.class.php');
require_once('../inc/pm.class.php');

session_start();

$user = new user();
$post = new post();
$pm = new pm();

$sessionUser = $_SESSION['username'];
$sessionId = $_SESSION['user_id'];

$user->load($sessionId);
$userDataArray = $user->data;

$letters = $pm->displayLetters($sessionId, "unseen");

$letterCount = count($letters);
	
if($letterCount == 0)
{
	$letterCount = "";
}

//$postMessages = $post->displayUserPosts($sessionId);


if(isset($_REQUEST['post-message']))
{
	
	$_REQUEST['post_user'] = $sessionId;
	
	$_REQUEST['date'] = date('Y-m-d H:i:s');
	
	$postDataArray = $_REQUEST;
	
	//sanitize
	$post->sanitize($postDataArray);
	$post->set($postDataArray);
	
	//validate
	if($post->validate())
	{
	
		//save
		if($post->save())
		{	
			header('location: /ropogu(local)/public_html/user-view.php?user_id='.$sessionId);
			exit;
		}
		else
		{
			$postErrorsArray[] = "Save failed";
		}
	}
	else
	{
		$postDataArray = $post->data;
		
		$postErrorsArray = $post->errors;
	}
	
}
$sessionPosts = $post->displayPosts($_SESSION['user_id'],"session");
$allPosts = $post->displayPosts($_SESSION['user_id'],"all");
$familioliPosts = $post->displayPosts($_SESSION['user_id'],"familioli");


require_once('../tpl/user-logged.tpl.php');
?>