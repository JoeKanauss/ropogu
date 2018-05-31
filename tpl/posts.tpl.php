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
	
	<title>Ropogu Posts</title>
	
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
	
	<div class="row">
		<div class="col-sm-12 col-lg-4 make-post">
			<div class="pip-pic">
				<?php if(file_exists(dirname(__FILE__)."/../public_html/rpp-pics/user_".$sessionId.".jpg"))
				{?>
					<img src="/ropogu(local)/public_html/rpp-pics/user_<?php echo $sessionId;?>.jpg" /><br>
				<?php
				}?>
			</div>	
				
			<h1>~POST A MESSAGE~</h1>
			<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" >
			<?php if(isset($postErrorsArray['message']))
			{ ?>
			<div><?php echo $postErrorsArray['message']; ?>
			</div>
			<?php } ?>
			<textarea name="message"></textarea><br>
			<input type="hidden" name="date"><input type="hidden" name="post_user">
			<input type="submit" name="post-message" value="(Post Message)" />
	</form>
		</div>

		
		<div class="col-sm-12 col-lg-8 view-post">
			<h1>~CHECK OUT POSTED MESSAGES~</h1>
			<button id="my" onClick="showPosts('my');">(MY POSTS)</button><br>
			
			<div class="my-posts" id="my-posts">
				<?php foreach($sessionPosts as $message)
				{
				?>
				<p><img src='/ropogu(local)/public_html/rpp-pics/user_<?php echo $message['post_user'];?>.jpg'  width="50px"/> You said:<br>
				<?php echo $message['message'];?><br>
				on <?php echo date('F jS, Y', strtotime($message['date']));?> at <?php echo date('h:i a', strtotime($message['date']));?><br>
				<a href="post-delete.php?post_id=<?php echo $message['post_id']?>">DELETE POST</a><br>
				<?php
				}
				?>
			</div>
			
			<button id="fam" onClick="showPosts('fam');">(FAMILIOLI POSTS)</button><br>
			
			<div class="fam-posts" id="fam-posts">
				<?php for($x=0; $x<sizeof($familioliPosts); $x++)
				{ ?>
				<p><a href='/ropogu(local)/public_html/user-view.php?user_id=<?php echo $familioliPosts[$x]['post_user'];?>'><img src='/ropogu(local)/public_html/rpp-pics/user_<?php echo $familioliPosts[$x]['post_user'];?>.jpg' alt='<?php echo $familioliPosts[$x][0]['username'];?>' title='<?php echo $familioliPosts[$x][0]['username'];?>' width="50px"/></a>
				<?php echo $familioliPosts[$x][0]['username'];?> said:<br><?php echo $familioliPosts[$x]['message'];?><br>on <?php echo date('F jS, Y', strtotime($familioliPosts[$x]['date']));?> at <?php echo date('h:i a', strtotime($familioliPosts[$x]['date']));?></p>
				<?php } ?>	
			</div>
			
			<button id="all" onClick="showPosts('all');">(ALL POSTS)</button><br>
			
			<div class="all-posts" id="all-posts">
				<?php for($x=0; $x<sizeof($allPosts); $x++)
				{ ?>
				<p><a href='/ropogu(local)/public_html/user-view.php?user_id=<?php echo $allPosts[$x]['post_user'];?>'><img src='/ropogu(local)/public_html/rpp-pics/user_<?php echo $allPosts[$x]['post_user'];?>.jpg' alt='<?php echo $allPosts[$x][0]['username'];?>' title='<?php echo $allPosts[$x][0]['username'];?>' width="50px"/></a>
				<?php echo $allPosts[$x][0]['username'];?> said:<br><?php echo $allPosts[$x]['message'];?><br>on <?php echo date('F jS, Y', strtotime($allPosts[$x]['date']));?> at <?php echo date('h:i a', strtotime($allPosts[$x]['date']));?></p>
				<?php } ?>	
			</div>
		</div>
	</div>
</div>	
<script>
	function showPosts(poster)
	{
		if(poster == 'my')
		{
			if(document.getElementById('my-posts').style.display == "none")
			{
				document.getElementById('my-posts').style.display = "inline";
				document.getElementById('fam-posts').style.display = "none";
				document.getElementById('all-posts').style.display = "none";
			}
			else
			{
				document.getElementById('my-posts').style.display = "none";
				document.getElementById('fam-posts').style.display = "none";
				document.getElementById('all-posts').style.display = "none";
			}
		}
		else if(poster == 'fam')
		{
			if(document.getElementById('fam-posts').style.display == "none")
			{
				document.getElementById('my-posts').style.display = "none";
				document.getElementById('fam-posts').style.display = "inline";
				document.getElementById('all-posts').style.display = "none";
			}
			else
			{
				document.getElementById('my-posts').style.display = "none";
				document.getElementById('fam-posts').style.display = "none";
				document.getElementById('all-posts').style.display = "none";
			}
		}
		else if(poster == 'all')
		{
			if(document.getElementById('all-posts').style.display == "none")
			{
				document.getElementById('my-posts').style.display = "none";
				document.getElementById('fam-posts').style.display = "none";
				document.getElementById('all-posts').style.display = "inline";
			}
			else
			{
				document.getElementById('my-posts').style.display = "none";
				document.getElementById('fam-posts').style.display = "none";
				document.getElementById('all-posts').style.display = "none";
			}
		}
	}
</script>
</body>
</html>