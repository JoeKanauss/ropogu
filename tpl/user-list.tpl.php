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
	
	<title>Ropogu User List</title>
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
	
	<div class="searchbar">
			<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="GET">
				Search:
				<select name="filterColumn">
					<option value="username">Username</option>
				</select>
				<input type="text" name="filterText" placeholder="Search Criteria..."/><br>
				<input type="submit" name="filter" value="(Filter Users)"/>
			</form>
	</div>
	<div class="user-list col-sm-12 col-lg-5">
		<?php foreach($userList as $userData)
		{ ?>
			<div class="distinct-user">
				<img src="/ropogu(local)/public_html/rpp-pics/user_<?php echo $userData['user_id']; ?>.jpg" width="100px"/><br>
				<?php echo $userData['username']; ?><br>
				<a href='user-view.php?user_id=<?php echo $userData['user_id'];?>'>(View User)</a>
			</div>
		<?php } ?>
	</div>
</body>
</html>