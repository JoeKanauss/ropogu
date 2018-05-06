<html>
<head>
</head>
<body>
	<h1>YOU ARE ABOUT TO DELETE A POST!</h1>
	<h2>Are you sure you want to delete the following post:</h2>
	<p><?php echo $postData['message'];?><br>
	posted on: <?php echo $postData['date'];?></p>
	
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?post_id=<?php echo $_REQUEST['post_id'];?>" method="post">
		<input type="radio" name="delete" value="yes">Yes<br>
		<input type="radio" name="delete" value="no">No<br>
		<input type="submit" name="deletePost" value="submit">
	</form>
</body>
</html>