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
		
		<div class="row">
			<div class="user-view">
	
				<img class="sendLetter" src="../public_html/images/sendLetter.png" onclick="window.location='pm-edit.php?user_id=<?php echo $_REQUEST['user_id'];?>'" alt="Send Letter to User" title="Send Letter to User" />
			
				<?php 
				if(isset($_SESSION['username']))
				{
					if(strpos($sessionFamilioli, "img src='/ropogu(local)/public_html/rpp-pics/user_".$userDataArray['user_id'].".jpg'")!=false)
					{
					?>
					<form id="deleteFromFamForm" action="<?php echo $_SERVER['SCRIPT_NAME'];?>?user_id=<?php echo $userDataArray['user_id'];?>" method="post">
						<!-- <input type="submit" name="deleteFromFamilioli" value="(Delete User from Familioli)" /> -->
						<button class="famButton" name="deleteFromFamilioli" value="deleteFromFam" onclick="submit('deleteFromFamForm');"><img src="../public_html/images/deleteFromFam.png" alt="Delete User from Familioli" title="Delete User from Familioli"/></button>
					</form>
					<?php
					}
					else if(strpos($sessionFamilioli, "img src='/ropogu(local)/public_html/rpp-pics/user_".$userDataArray['user_id'].".jpg'")===false)
					{
					?>
					<form id="addToFamForm" action="<?php echo $_SERVER['SCRIPT_NAME'];?>?user_id=<?php echo $userDataArray['user_id'];?>" method="post">
						<!-- <input type="submit" name="addToFamilioli" value="(Add User to Familioli)" /> -->
						<button class="famButton" name="addToFamilioli" onclick="submit('addToFamForm');"><img src="../public_html/images/addToFam.png" alt="Add User to Familioli" title="Add User to Familioli"/></button>
					</form>
					<?php
					}
				}
				?>
			
				<div class="user-image">
				<?php if(file_exists(dirname(__FILE__)."/../public_html/user_images/user_".$userDataArray['user_id'].".jpg"))
				{?>
				<img src="/ropogu(local)/public_html/user_images/user_<?php echo $userDataArray['user_id'];?>.jpg" /><br>
				<?php
				}?>
			</div>
			
			<h1><span class="name">~<?php echo $userDataArray['username'];?>~</span></h1>
			<p><span class="quote">"<?php echo $userDataArray['quote'];?>"</span><br>
			<span class="description"><?php echo $userDataArray['description'];?></span></p>
			<div class="familioli">
				<button onclick="showFamilioli();">(See <?php echo $userDataArray['username'];?>'s Familioli)</button>
				<div id="show-familioli" class="show-familioli">
					<?php echo $userDataArray['familioli'];?>
				</div>
			</div>
			
			<div class="latest-posts">
				<button onclick="showLatestPosts();">(See <?php echo $userDataArray['username'];?>'S Latest Posts)</button>
				
				<div id="show-latest-posts" class="show-latest-posts">
					<br><?php for($x=0; $x<sizeof($userViewPosts); $x++)
					{?>
					<p><a href='/ropogu(local)/public_html/user-view.php?user_id=<?php echo $_REQUEST['user_id'];?>'><img src='/ropogu(local)/public_html/rpp-pics/user_<?php echo $_REQUEST['user_id'];?>.jpg' alt='<?php echo $_REQUEST['user_id'];?>' title='<?php echo $userDataArray['username'];?>' width="50px"/></a>
					<?php echo $userDataArray['username'];?> said:<br><?php echo $userViewPosts[$x]['message'];?><br>on <?php echo date('F jS, Y', strtotime($userViewPosts[$x]['date']));?> at <?php echo date('h:i a', strtotime($userViewPosts[$x]['date']));?></p>
					<?php } ?>
				</div>
			</div>
			</div>
		</div>
	</div>
	
	<script>
		function showFamilioli()
	{
		if(document.getElementById('show-familioli').style.display == "none")
		{
			document.getElementById('show-familioli').style.display = "block";
		}
		else
		{
			document.getElementById('show-familioli').style.display = "none";
		}
	}
	
	function showLatestPosts()
	{
		if(document.getElementById('show-latest-posts').style.display == "none")
		{
			document.getElementById('show-latest-posts').style.display = "block";
		}
		else
		{
			document.getElementById('show-latest-posts').style.display = "none";
		}
	}
	
	function submit(formToSubmit)
	{
		document.getElementById(formToSubmit).submit();
	}
	</script>
</body>
</html>