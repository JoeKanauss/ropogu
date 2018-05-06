<html>
	<body>
	<h1>All Users</h1>
	<div>
		<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="GET">
			Search:
			<select name="filterColumn">
				<option value="username">Username</option>
				<option value="user_level">User Level</option>
			</select>
			<input type="text" name="filterText"/>
			<input type="submit" name="filter" value="Filter"/>
		</form>
	</div>
		<table>
			<?php foreach($userList as $userData)
				{ ?>
				<tr>
					<td><?php echo $userData['username']; ?></td>
					<td><img src="/ropogu(local)/public_html/rpp-pics/user_<?php echo $userData['user_id']; ?>.jpg"</td>
					<td><a href='user-view.php?user_id=<?php echo $userData['user_id'];?>'>View User</a></td>
				</tr>
			<?php } ?>
		</table>

	</body>
</html>