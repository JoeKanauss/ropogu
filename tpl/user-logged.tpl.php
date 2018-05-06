<html>
<body>
	<h1><?php echo $sessionUser; ?></h1>
	
	<p> | <a href="/ropogu(local)/public_html/user-list.php">User List</a> | 
	<a href="/ropogu(local)/public_html/user-login.php">User Login</a> | 
	<a href="/ropogu(local)/public_html/user-edit.php">User Edit</a> | 
	<a href="/ropogu(local)/public_html/user-logout.php">User Logout</a> | 
	<a href="/ropogu(local)/public_html/session-variable-check.php">Session Variable Check</a> | 
	<a href="/ropogu(local)/public_html/pm-list.php">Letters <sup><?php echo $letterCount ;?></sup></a>
	</p>
	
	<?php if(file_exists(dirname(__FILE__)."/../public_html/user_images/user_".$sessionId.".jpg"))
			{?>
	<img src="/ropogu(local)/public_html/user_images/user_<?php echo $sessionId;?>.jpg" /><br>
	<?php
	}?>
	Name: <?php echo $userDataArray['name'];?><br>
	Quote: <?php echo $userDataArray['quote'];?><br>
	Description: <?php echo $userDataArray['description'];?><br>
	
	<?php if(file_exists(dirname(__FILE__)."/../public_html/rpp-pics/user_".$sessionId.".jpg"))
			{?>
	<img src="/ropogu(local)/public_html/rpp-pics/user_<?php echo $sessionId;?>.jpg" /><br>
	<?php
	}?>
	
	Your Roly Poly Familioli:<br>
	<?php echo $userDataArray['familioli'];?>
	
	<h2>=====================================</h2>
	
	<h1>MAKE A POST</h1>
	
	<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" >
		<?php if(isset($postErrorsArray['message']))
		{ ?>
			<div><?php echo $postErrorsArray['message']; ?>
			</div>
		<?php } ?>
		POST:<br>
		<textarea name="message"></textarea><br>
		<input type="text" name="date"><input type="text" name="post_user">
		<input type="submit" name="post-message" value="Post Message" />
	</form>
	
	<h2>=====================================</h2>
	
	<h1>MY POSTS</h1>
	<br>
	<?php foreach($sessionPosts as $message)
	{
	?>
			[[ POST ]]<br>
			<p><img src='/ropogu(local)/public_html/rpp-pics/user_<?php echo $message['post_user'];?>.jpg'  width="50px"/> You said:<br>
			<?php echo $message['message'];?><br>
			on <?php echo date('F jS, Y', strtotime($message['date']));?> at <?php echo date('h:i a', strtotime($message['date']));?><br>
			<a href="post-delete.php?post_id=<?php echo $message['post_id']?>">DELETE POST</a><br>
	<?php
	}
	?>
	
	<h2>=====================================</h2>
	
	<h1>FAMILIOLI POSTS</h1>
	<?php for($x=0; $x<sizeof($familioliPosts); $x++)
	{ ?>
		<p><a href='/ropogu(local)/public_html/user-view.php?user_id=<?php echo $familioliPosts[$x]['post_user'];?>'><img src='/ropogu(local)/public_html/rpp-pics/user_<?php echo $familioliPosts[$x]['post_user'];?>.jpg' alt='<?php echo $familioliPosts[$x][0]['name'];?>' title='<?php echo $familioliPosts[$x][0]['name'];?>' width="50px"/></a>
			<?php echo $familioliPosts[$x][0]['name'];?> said:<br><?php echo $familioliPosts[$x]['message'];?><br>on <?php echo date('F jS, Y', strtotime($familioliPosts[$x]['date']));?> at <?php echo date('h:i a', strtotime($familioliPosts[$x]['date']));?></p>

	<?php } ?>	
	
	<h2>=====================================</h2>
	
	<h1>All POSTS</h1>
	<?php for($x=0; $x<sizeof($allPosts); $x++)
	{ ?>
		<p><a href='/ropogu(local)/public_html/user-view.php?user_id=<?php echo $allPosts[$x]['post_user'];?>'><img src='/ropogu(local)/public_html/rpp-pics/user_<?php echo $allPosts[$x]['post_user'];?>.jpg' alt='<?php echo $allPosts[$x][0]['name'];?>' title='<?php echo $allPosts[$x][0]['name'];?>' width="50px"/></a>
			<?php echo $allPosts[$x][0]['name'];?> said:<br><?php echo $allPosts[$x]['message'];?><br>on <?php echo date('F jS, Y', strtotime($allPosts[$x]['date']));?> at <?php echo date('h:i a', strtotime($allPosts[$x]['date']));?></p>

	<?php } ?>	
	
</body>
</html>