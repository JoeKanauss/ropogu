<html>
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="./css/styles.css">
	
	<?php if(isset($_SESSION['user_id']))
	{ ?>
		<title>Ropogu Edit Profile</title>
	<?php 
	}else
	{?>
		<title>Ropogu Create Profile</title>
	<?php
	}?>
</head>
<body>
	<div class="container">
	<div class="row navigation">
	<div class="col-sm-12 logo-head">
		<div class="logo-head-image">
			<img src="./images/ropogu-logo.png" />
		</div>
	</div>
	<?php if(isset($_SESSION['user_id']))
	{?>
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
	
	<?php }?>
	</div>
	
	<div class="row">
		<div class="user">
			<h3>User Image</h3>
			<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" enctype="multipart/form-data">
				<div class="user-image">
					<?php if(isset($_SESSION['user_id']))
					{
						if(file_exists(dirname(__FILE__)."/../public_html/user_images/user_".$sessionId.".jpg"))
						{
					?>
						<img src="/ropogu(local)/public_html/user_images/user_<?php echo $sessionId;?>.jpg" /><br>
					<?php
						}
					}?>
					<input type="file" name="user_image" /></p>
				</div>
				
				<h3>User Pip Pic</h3>
				<div class="user-image">
					<?php if(isset($_SESSION['user_id']))
					{
						if(file_exists(dirname(__FILE__)."/../public_html/rpp-pics/user_".$sessionId.".jpg"))
						{
					?>
						<img src="/ropogu(local)/public_html/rpp-pics/user_<?php echo $sessionId;?>.jpg" /><br>
					<?php
						}
					}?>
					<input type="file" name="user_image" /></p>
				</div>
				
				<h3>Username</h3>
				<p><span class="name"><?php if(isset($userErrorsArray['username']))
				{ ?>
				<div><?php echo $userErrorsArray['username']; ?>
				</div>
				<?php } ?>
				<input type="text" name="username" value="<?php echo(isset($userDataArray['username']) ? $userDataArray['username']: ''); ?>"></span></p>
				
				<h3>User Quote</h3>
				<p><span class="quote"><?php if(isset($userErrorsArray['quote']))
				{ ?>
				<div><?php echo $userErrorsArray['quote']; ?>
				</div>
				<?php } ?>
				<input type="text" name="quote" value="<?php echo(isset($userDataArray['quote']) ? $userDataArray['quote']: ''); ?>"/></span><br>
				
				<h3>User Description</h3>
				<p><span class="description"><?php if(isset($userErrorsArray['description']))
				{ ?>
				<div><?php echo $userErrorsArray['description']; ?>
				</div>
				<?php } ?>
				<textarea name="description"><?php echo(isset($userDataArray['description']) ? $userDataArray['description']: ''); ?></textarea><br></span></p>
				
				<input type="submit" name="save" value="(Save)"/>
				<input type="submit" name="cancel" value="(Cancel)"/>
			</form>
	</div>
</div>

</body>
</html>