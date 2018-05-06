<?php 
	require_once('../inc/post.class.php');
	
	session_start();
	
	$post = new post();
	
	$sessionUserId = $_SESSION['user_id'];
	
	if(isset($_REQUEST['post_id']) && ($_REQUEST['post_id'] > 0))
	{
		$post->load($_REQUEST['post_id']);
		$postData = $post->data;
		
		if($sessionUserId == $postData['post_user'])
		{
			echo "YAY!";
			
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