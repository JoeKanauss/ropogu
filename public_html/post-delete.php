<?php 
require_once('../inc/post.class.php');
require_once('../inc/pm.class.php');
require_once('../inc/user.class.php');

session_start();
	
$post = new post();
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
	
	if(isset($_REQUEST['post_id']) && ($_REQUEST['post_id'] > 0))
	{
		$post->load($_REQUEST['post_id']);
		$postData = $post->data;
		
		//var_dump($postData['post_user']); die;
		
		if($sessionId == $postData['post_user'])
		{
			if(isset($_POST['deletePost']))
			{
				if($_POST['delete']=="yes")
				{
					$post->delete($_REQUEST['post_id']);
					
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

	require_once('../tpl/post-delete.tpl.php');
?>