<html>
<head>
</head>
<body>
	<h1>SEND A NEW LETTER</h1>
	
	<h2>FROM: <?php echo $sessionUsername;?></h2>
	<h2>TO: <?php echo $userDataArray['name'];?></h2>
	<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>?user_id=<?php echo $_REQUEST['user_id'];?>" method="post">
	
	<?php if(isset($pmErrorsArray['message']))
	{ ?>
		<div><?php echo $pmErrorsArray['message']; ?>
		</div>
	<?php } ?>
		<textarea name="message" rows="20" cols="100"><?php echo(isset($pmDataArray['message']) ? $pmDataArray['message']: ''); ?></textarea><br>
		<input type="hidden" name="from_id"/>
		<input type="hidden" name="to_id"/>
		<input type="hidden" name="seen"/>
		<input type="hidden" name="date"/>
		<input type="submit" name="sendPm" value="Deliver the letter!">
	</form>
</body>
</html>