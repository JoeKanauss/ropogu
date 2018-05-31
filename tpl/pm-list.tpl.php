<html>
<head>
<!-- LETTERS TO BE DISPLAYED WITH ENVELOPE-LIKE BACKGROUND WITH FROM AND DATE IN CENTER AND "STAMP" IN CORNER; 
	 CLICKING ON ENVELOPE WILL CAUSE IT TO OPEN (with animation) AND DISPLAY MESSAGE AS LETTER;
	 SEEN LETTERS HAVE A "RIPPED OPEN" ENVELOPE TOP -->
	 <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	
	 <link rel="stylesheet" type="text/css" href="../public_html/css/styles.css">
	 
	 <title>Ropogu Letters</title>
	 
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
		<div class="col-sm-12 col-lg-12 letters">
		
			<button class="unseen-letters-button" onclick="showLetters('unseen');">(Unseen Letters)</button>
			
			<div class="unseen-letters-section" id="unseen-letters-section">
			
				<?php if(count($unseenLetters)==0)
				{?>
				<p>You have no unseen letters!</p>
				<?php
				}
				foreach($unseenLetters as $unseenLetter)
				{ ?>
					<div class="unseen-letter">
						<div class="letter-info">
							<a href="../public_html/pm-letter-view.php?pm_id=<?php echo $unseenLetter['pm_id'];?>">
							FROM: <?php echo $unseenLetter[0]['username'];?><br>
							DATE: <?php echo date('m/d/Y', strtotime($unseenLetter['date']));?>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
			
		<button class="all-letters-button" onclick="showLetters('all');">(All Letters)</button>
		
		<div class="all-letters-section" id="all-letters-section">
			<?php if(count($allLetters)==0)
				{?>
				<p>You have no unseen letters!</p>
				<?php
				}foreach($allLetters as $allLetter)
			{
				if($allLetter['seen'] == 1)
				{?>
					<div class="seen-letter">
				<?php }
				else
				{?>
					<div class="unseen-letter">
				<?php 
				}?>
						<div class="letter-info">
							<a href="../public_html/pm-letter-view.php?pm_id=<?php echo $allLetter['pm_id'];?>">
							FROM: <?php echo $allLetter[0]['username'];?><br>
							DATE: <?php echo date('m/d/Y', strtotime($allLetter['date']));?>
							</a>
						</div>
					</div>
			<?php }?>
			</div>
		</div>
	</div>
</div>
<script>
	function showLetters(letter)
	{
		if(letter == 'unseen')
		{
			if(document.getElementById('unseen-letters-section').style.display == "none")
			{
				document.getElementById('unseen-letters-section').style.display = "inline";
				document.getElementById('all-letters-section').style.display = "none";
			}
			else if (document.getElementById('unseen-letters-section').style.display = "inline")
			{
				document.getElementById('unseen-letters-section').style.display = "none";
			}
		}
		else if(letter == 'all')
		{
			if(document.getElementById('all-letters-section').style.display == "none")
			{
				document.getElementById('all-letters-section').style.display = "inline";
				document.getElementById('unseen-letters-section').style.display = "none";
			}
			else if (document.getElementById('all-letters-section').style.display = "inline")
			{
				document.getElementById('all-letters-section').style.display = "none";
			}
		}
		
	}
</script>
</body>
</html>