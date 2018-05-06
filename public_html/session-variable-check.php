<?php

require_once('../inc/post.class.php');
	
	session_start();
	
	echo "USER ID: ".$_SESSION['user_id']."<br>";
	echo "USERNAME: ".$_SESSION['username']."<br>";
	echo "FAMILIOLI:".$_SESSION['familioli']."<br><br>";
	
	$post = new post();
	
	$sessionPosts = $post->displayPosts($_SESSION['user_id'],"session");
	$allPosts = $post->displayPosts($_SESSION['user_id'],"all");
	$familioliPosts = $post->displayPosts($_SESSION['user_id'],"familioli");
	$userViewPosts = $post->displayPosts(null, null, 1003);
	
	echo"<br><Br>";
	//var_dump($userViewPosts);die;
	
	for($x=0; $x<sizeof($userViewPosts); $x++)
	{
?>

	<p><a href='/ropogu(local)/public_html/user-view.php?user_id=<?php echo $userViewPosts[$x]['post_user'];?>'><img src='/ropogu(local)/public_html/rpp-pics/user_<?php echo $userViewPosts[$x]['post_user'];?>.jpg'  width="50px"/></a>:
		<?php echo $userViewPosts[$x]['message'];?><br></p>
		
<?php } ?>
