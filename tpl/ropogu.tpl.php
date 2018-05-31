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
	
	<title>Roly Poly Guacamole</title>
	
</head>
<body>
<div class="container">
	<div class="row navigation">
	<nav class="navbar navbar-expand-lg navbar-light  col-sm-12">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
			<span class="navbar-toggler-icon"></span>
		</button>
	
		<div class="collapse navbar-collapse" id="navbarContent">
			<ul class="navbar-nav mr-auto">
				<li><a href="/ropogu(local)/public_html/user-list.php">~User List~</a></li>
				<li><a href="/ropogu(local)/public_html/user-edit.php">~Create Login~</a></li>
				
			</ul>	
			
		</div>
	</nav>
	</div>
	
	<div class="row">
		<div class="login">
			<div class="login-image">
				<img src="./images/rpguacLarge.png" />
			</div>
			
			<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
				<?php if(isset($userErrorsArray['username']))
				{ ?>
				<div><?php echo $userErrorsArray['username']; ?>
				</div>
				<?php } ?>
				Username<br>
				<input type="text" name="username" value="<?php echo(isset($userDataArray['username']) ? $userDataArray['username']: ''); ?>"/><br>
			
				<?php if(isset($userErrorsArray['password']))
				{ ?>
				<div><?php echo $userErrorsArray['password']; ?>
				</div>
				<?php } ?>
				Password<br>
				<input type="text" name="password" value="<?php echo(isset($userDataArray['password']) ? $userDataArray['password']: ''); ?>"/><br>
			
				<input type="submit" name="login" value="(Log In)" />
			</form>
		</div>
	</div>
</body>
</html>