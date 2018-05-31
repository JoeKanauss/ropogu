<html>
<head>
 <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	
	 <link rel="stylesheet" type="text/css" href="../public_html/css/styles.css">
	 
	 <title>Ropogu View Letter</title>
	 
</head>
<body>
	<div class="container">
	<div class="row navigation">
	<div class="col-sm-12 logo-head">
		<div class="logo-head-image">
			<img src="./images/ropogu-logo.png" />
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-light  col-sm-12">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
			<span class="navbar-toggler-icon"></span>
		</button>
	
		<div class="collapse navbar-collapse" id="navbarContent">
			<ul class="navbar-nav mr-auto">
				<li><a href="/ropogu(local)/public_html/user-logged.php">~<?php echo $sessionUser;?>~</a></li>
				<li><a href="/ropogu(local)/public_html/user-list.php">~See Users~</a></li>
				<li><a href="/ropogu(local)/public_html/user-logout.php">~User Logout~</a></li>
				<li><a href="/ropogu(local)/public_html/posts.php">~Posts~</a></li>
				<div class="letter-notification">
					<?php if($letterCount > 0)
					{ ?>
					<a href="/ropogu(local)/public_html/pm-list.php"><img src="../public_html/images/letter.png" alt="unseen letters"></a>
					<?php }
					else
					{ ?>
					<a href="/ropogu(local)/public_html/pm-list.php"><img src="../public_html/images/noLetter.png" alt="unseen letters"></a>
					<?php } ?>
				</div>
			</ul>
		</div>
	</nav>
	</div>
	
	<div class="letter-send">
		<h1>SEND A NEW LETTER</h1>
		
		<h2>FROM: <?php echo $sessionUser;?></br>
		TO: <?php echo $userDataArray['username'];?></h2>
		
		<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>?user_id=<?php echo $_REQUEST['user_id'];?>" method="post">
			<?php if(isset($pmErrorsArray['message']))
			{ ?>
			<div><?php echo $pmErrorsArray['message']; ?>
			</div>
			<?php } ?>
			<textarea name="message" rows="10"><?php echo(isset($pmDataArray['message']) ? $pmDataArray['message']: ''); ?></textarea><br>
			<input type="hidden" name="from_id"/>
			<input type="hidden" name="to_id"/>
			<input type="hidden" name="seen"/>
			<input type="hidden" name="date"/>
			<input type="submit" name="sendPm" value="(Deliver the letter!)">
		</form>
	</div>
</body>
</html>