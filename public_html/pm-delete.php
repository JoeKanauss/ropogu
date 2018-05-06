<?php 
	require_once('../inc/pm.class.php');
	
	session_start();
	
	$pm = new pm();
	
	$sessionUserId = $_SESSION['user_id'];
	
	if(isset($_REQUEST['pm_id']) && ($_REQUEST['pm_id'] > 0))
	{
		$pm->load($_REQUEST['pm_id']);
		$pmData = $pm->data;
		
		if($sessionUserId == $pmData['to_id'])
		{
			echo "YAY!";
			
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