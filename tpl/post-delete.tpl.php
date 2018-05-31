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
	
	<title>Ropogu Profile</title>
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
	</div>
	
	<div class="delete-section">
		<h1>YOU ARE ABOUT TO DELETE A POST!</h1>
		<h2>Are you sure you want to delete the following post:</h2>
		
		<div class="to-delete">
			<p><?php echo $postData['message'];?></p>
			<p class="detail">Posted on <?php echo $postData['date'];?></p>
		</div>
		
		<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?post_id=<?php echo $_REQUEST['post_id'];?>" method="post">
			<input type="radio" name="delete" value="yes">Yes<br>
			<input type="radio" name="delete" value="no">No<br>
			<input type="submit" name="deletePost" value="submit">
		</form>
	</div>
</body>
</html>