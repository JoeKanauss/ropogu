<html>
<head>
</head>
<body>
	<p>..........FROM: <?php echo $pmDataArray['from_id'];?></p>
	<p>..........MESSAGE: <?php echo $pmDataArray['message'];?></p>
	
	<a href="../public_html/pm-delete.php?pm_id=<?php echo $pmDataArray['pm_id'];?>">Delete Letter</a><br>
	<a href="../public_html/pm-edit.php?user_id=<?php echo $pmDataArray['from_id'];?>">Reply to Letter</a>
</body>
</html>