<html>
	<body>
	
			Username: <?php echo(isset($userDataArray['username']) ? $userDataArray['username']: ''); ?><br>
			Quote: <?php echo(isset($userDataArray['quote']) ? $userDataArray['quote']: ''); ?><br>
			Description: <?php echo(isset($userDataArray['description']) ? $userDataArray['description']: ''); ?><br>
			User Image: 
			<?php if(file_exists(dirname(__FILE__)."/../public_html/user_images/user_".$userDataArray['user_id'].".jpg"))
			{?>
			<br> <img src="/ropogu(local)/public_html/user_images/user_<?php echo $userDataArray['user_id'];?>.jpg" /><br>
			<?php
			}
			else
			{?>
			This user has no image yet.<br>
			<?php 
			}?>
			<?php echo $userDataArray['username'];?>'s Familioli:<br><?php echo $userDataArray['familioli'];?>
			
			
			<?php 
			if(isset($_SESSION['username']))
			{
				if(strpos($sessionFamilioli, "img src='/ropogu(local)/public_html/rpp-pics/user_".$userDataArray['user_id'].".jpg'")!=false)
				{
				?>
				<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>?user_id=<?php echo $userDataArray['user_id'];?>" method="post">
					<input type="submit" name="deleteFromFamilioli" value="Delete User from Familioli" />
				<form>
				<?php
				}
				else if(strpos($sessionFamilioli, "img src='/ropogu(local)/public_html/rpp-pics/user_".$userDataArray['user_id'].".jpg'")===false)
				{
				?>
				<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>?user_id=<?php echo $userDataArray['user_id'];?>" method="post">
					<input type="submit" name="addToFamilioli" value="Add User to Familioli" />
				<form>
				<?php
				}
			}
				?>
			
			
			<h1><?php echo $userDataArray['name'];?>'S LATEST POSTS</h1>
			<?php for($x=0; $x<sizeof($userViewPosts); $x++)
			{?>
				<p><a href='/ropogu(local)/public_html/user-view.php?user_id=<?php echo $_REQUEST['user_id'];?>'><img src='/ropogu(local)/public_html/rpp-pics/user_<?php echo $_REQUEST['user_id'];?>.jpg' alt='<?php echo $_REQUEST['user_id'];?>' title='<?php echo $_REQUEST['user_id'];?>' width="50px"/></a>
				<?php echo $userDataArray['name'];?> said:<br><?php echo $userViewPosts[$x]['message'];?><br>on <?php echo date('F jS, Y', strtotime($userViewPosts[$x]['date']));?> at <?php echo date('h:i a', strtotime($userViewPosts[$x]['date']));?></p>
		
			<?php } ?>
				
			<a href="pm-edit.php?user_id=<?php echo $_REQUEST['user_id'];?>">Send a Letter to <?php echo $userDataArray['username'];?></a><br>
			
			<a href="user-list.php">Back to user List</a>
	</body>
</html>