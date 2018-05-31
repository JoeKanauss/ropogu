<?php
require_once('../inc/user.class.php');
require_once('../inc/user.class.php');
require_once('../inc/post.class.php');
require_once('../inc/pm.class.php');

session_start();

$user = new user();
$post = new post();
$pm = new pm();

$sessionUser = $_SESSION['username'];
$sessionId = $_SESSION['user_id'];

if(!isset($_SESSION['user_id']))
{
	header('location: /ropogu(local)/public_html/ropogu.php');
	exit;
}

$user->load($sessionId);
$userDataArray = $user->data;

$userList = $user->retrieveAll(
				(isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
				(isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
				(isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
				(isset($_GET['filterText']) ? $_GET['filterText'] : null)
				);

$letters = $pm->displayLetters($sessionId, "unseen");

$letterCount = count($letters);
	
if($letterCount == 0)
{
	$letterCount = "";
}
				
require_once("../tpl/user-list.tpl.php");
?>