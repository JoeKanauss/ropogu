<html>
<head>
<!-- LETTERS TO BE DISPLAYED WITH ENVELOPE-LIKE BACKGROUND WITH FROM AND DATE IN CENTER AND "STAMP" IN CORNER; 
	 CLICKING ON ENVELOPE WILL CAUSE IT TO OPEN (with animation) AND DISPLAY MESSAGE AS LETTER;
	 SEEN LETTERS HAVE A "RIPPED OPEN" ENVELOPE TOP -->
	 <link rel="stylesheet" type="text/css" href="../public_html/css/styles.css">
</head>
<body>
	<h1>Unseen Letters</h1>
	
	<?php foreach($unseenLetters as $unseenLetter)
	{ ?>
		
		<div class="unseen-letter">
			<div class="letter-info">
				<a href="../public_html/pm-letter-view.php?pm_id=<?php echo $unseenLetter['pm_id'];?>">
				FROM: <?php echo $unseenLetter['from_id'];?><br>
				DATE: <?php echo date('m/d/Y', strtotime($unseenLetter['date']));?>
				</a>
			</div>
		</div>
		
		====================
	<?php } ?>
	
	<h1>All Letters</h1>
	<?php foreach($allLetters as $allLetter)
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
				FROM: <?php echo $allLetter['from_id'];?><br>
				DATE: <?php echo date('m/d/Y', strtotime($allLetter['date']));?>
				</a>
			</div>
		</div>
		</div>
		====================<br>
	<?php } ?>
	

</body>
</html>