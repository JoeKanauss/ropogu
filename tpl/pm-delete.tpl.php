<html>
<head>
</head>
<body>
	<h1>YOU ARE ABOUT TO DELETE A LETTER!</h1>
	<h2>Are you sure you want to delete the following letter:</h2>
	<p><?php echo $pmData['message'];?><br>
	FROM: <?php echo $pmData['from_id'];?><br>
	posted on: <?php echo $pmData['date'];?></p>
	
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?pm_id=<?php echo $_REQUEST['pm_id'];?>" method="post">
		<input type="radio" name="delete" value="yes">Yes<br>
		<input type="radio" name="delete" value="no">No<br>
		<input type="submit" name="deletePm" value="submit">
	</form>
</body>
</html>