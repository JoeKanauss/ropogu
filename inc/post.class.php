<?php

require_once('base.class.php');

class post extends Base
{
	
	//create a construct function that will set the database when a new post class is created
	function __construct()
	{
		parent::__construct();
		$this->tableName = "post";
		$this->keyField = "post_id";
		$this->columnNames = array("message", "post_user", "date");
	}
	
	function sanitize($dataArray)
	{
		//sanitize data based on rules
		$this->data["message"] = filter_var($dataArray["message"], FILTER_SANITIZE_STRING);
		
		return $dataArray;
	}
	
	
	function validate()
	{
		//variable to check if successful validation
		$isValid = false;
		
		 if(empty($this->data['message']))
		{
				$this->errors['message'] = "Please enter a message";
		}
		
		   if(empty($this->errors))
		{
			$isValid = true;
		}
		
		return $isValid;
	}

	function displayUserPosts($userId)
	{
		
		$sql = "SELECT * FROM post WHERE post_user = ".$userId;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		
		$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $posts;
		
	}
	
	
	
	function displayPosts($sessionUser=null, $posts=null, $userView=null)
	{
	
		if($posts == "all")
		{
			$sql = "SELECT * FROM post ORDER BY date DESC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
		
			$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			for($x=0; $x<count($posts); $x++)
			{
				$sql = "SELECT username FROM user WHERE user_id = ".$posts[$x]['post_user'];
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$postName = $stmt->fetch(PDO::FETCH_ASSOC);
				array_push($posts[$x], $postName);
			}
			
			return $posts;
		}
		elseIf($posts == "session")
		{
			$sql = "SELECT * FROM post WHERE post_user = ".$sessionUser. " ORDER BY date DESC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
		
			$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $posts;
		}
		elseif($posts == "familioli")
		{
			//for each user, if the session_id user's 'familioli' column includes '/ropogu(local)/public_html/rpp-pics/user_".$userId.".jpg', select all from posts where post_user = user_id
	
			//grab familioli of session user
			$sql = "SELECT familioli FROM user WHERE user_id = ".$sessionUser;
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$fam = $stmt->fetch(PDO::FETCH_ASSOC); 
		
			//var_dump($fam); die;
		
			//find how many instances of the user_id rpp-pics there are in familioli string
			$famNum = substr_count($fam['familioli'],"'/ropogu(local)/public_html/rpp-pics/user_");
		
		
			//set initial instance of the newFamSubString to the full familioli string
			$newFamSubString = $fam['familioli'];
		
			//initialize empty famIdArray
			$famIdArray = array();
		
			//for each time the rpp-pics string shows up in the session user's 'familioli' string
			for($i=1; $i<=$famNum; $i++)
			{
				//find the beginning string position of of the rpp-pics string
				$famSubString = strpos($newFamSubString, "'/ropogu(local)/public_html/rpp-pics/user_");

				//find size of rpp-pic string
				$size = strlen("'/ropogu(local)/public_html/rpp-pics/user_");
		
				//find the position of the user_id
				$posOfId = $famSubString + $size;

				//create a substring containing the 4 digit user_id
				$familioliId = substr($newFamSubString, $posOfId, 4);
		
				//add the user_id to the famIdArray
				array_push($famIdArray, $familioliId);
			
				//make the new instance of newFamSubString start after the last rpp-pics string to move onto next instance of the famSubString
				$newFamSubString = substr($newFamSubString, $posOfId);
		
			}
		
			//turn famIdArray into a string with values separated by a comma and space
			$inFamilioli = implode(', ', $famIdArray);
		
			//sql statement and use the inFamilioli string (which holds the familioli user_ids of session user) as the criteria
			$sql = "SELECT message, date, post_user FROM post WHERE post_user IN($inFamilioli) ORDER BY date DESC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$familioliPosts = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
			for($x=0; $x<count($familioliPosts); $x++)
			{
				$sql = "SELECT username FROM user WHERE user_id = ".$familioliPosts[$x]['post_user'];
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$postName = $stmt->fetch(PDO::FETCH_ASSOC);
				array_push($familioliPosts[$x], $postName);
			}
		
			return $familioliPosts;
		}

		elseif($userView != null)
		{
			$sql = "SELECT * FROM post WHERE post_user = ".$userView. " ORDER BY date DESC LIMIT 5";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$topFive = $stmt->fetchAll(PDO::FETCH_ASSOC); 
			
			//var_dump($topFive); die;
			return $topFive;
		}
	}
}
?>