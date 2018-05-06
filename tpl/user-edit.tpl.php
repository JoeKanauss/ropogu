<html>
	<body>
		<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" enctype="multipart/form-data">
			<?php if(isset($userErrorsArray['username']))
			{ ?>
			<div><?php echo $userErrorsArray['username']; ?>
			</div>
			<?php } ?>
			Username: <input type="text" name="username" value="<?php echo(isset($userDataArray['username']) ? $userDataArray['username']: ''); ?>"/><br>
			
			<?php if(isset($userErrorsArray['password']))
			{ ?>
			<div><?php echo $userErrorsArray['password']; ?>
			</div>
			<?php } ?>
			Password: <input type="text" name="password" value="<?php echo(isset($userDataArray['password']) ? $userDataArray['password']: ''); ?>"/><br>
			
			<?php if(isset($userErrorsArray['name']))
			{ ?>
			<div><?php echo $userErrorsArray['name']; ?>
			</div>
			<?php } ?>
			Name: <input type="text" name="name" value="<?php echo(isset($userDataArray['name']) ? $userDataArray['name']: ''); ?>"/><br>
			
			<?php if(isset($userErrorsArray['quote']))
			{ ?>
			<div><?php echo $userErrorsArray['quote']; ?>
			</div>
			<?php } ?>
			Quote: <input type="text" name="quote" value="<?php echo(isset($userDataArray['quote']) ? $userDataArray['quote']: ''); ?>"/><br>
			
			<?php if(isset($userErrorsArray['description']))
			{ ?>
			<div><?php echo $userErrorsArray['description']; ?>
			</div>
			<?php } ?>
			Description:<br>
			<textarea name="description"><?php echo(isset($userDataArray['description']) ? $userDataArray['description']: ''); ?></textarea><br>
			
			User Image: <input type="file" name="user_image" /><br>
			
			<?php if(file_exists(dirname(__FILE__)."/../public_html/user_images/user_".$userDataArray['user_id'].".jpg"))
			{
			?>
				<img src="/ropogu(local)/public_html/user_images/user_<?php echo $userDataArray['user_id'];?>.jpg" /><br>
			<?php
			}?>
			
			Roly Poly Pip Pic: <input type="file" name="rpp-pic" /><br>
			
			<?php if(file_exists(dirname(__FILE__)."/../public_html/rpp-pics/user_".$userDataArray['user_id'].".jpg"))
			{
			?>
				<img src="/ropogu(local)/public_html/rpp-pics/user_<?php echo $userDataArray['user_id'];?>.jpg" /><br>
			<?php
			}?>
			
			<input type="hidden" name="user_id" value="<?php echo(isset($userDataArray['user_id']) ? $userDataArray['user_id']: ''); ?>"/>
			
			<input type="submit" name="save" value="Save"/>
			<input type="submit" name="cancel" value="Cancel"/>
		</form>
	</body>
</html>