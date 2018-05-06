<?php
require_once('../inc/user.class.php');

$user = new user();

$userList = $user->retrieveAll(
				(isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
				(isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
				(isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
				(isset($_GET['filterText']) ? $_GET['filterText'] : null)
				);
				
require_once("../tpl/user-list.tpl.php");
?>