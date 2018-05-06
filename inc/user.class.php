<?php

require_once('base.class.php');

class user extends Base
{
	
	//create a construct function that will set the database when a new user class is created
	function __construct()
	{
		parent::__construct();
		$this->tableName = "user";
		$this->keyField = "user_id";
		$this->columnNames = array("username", "password", "name", "description", "quote");
	}
	
	
	
	function sanitize($dataArray)
	{
		//sanitize data based on rules
		$this->data["username"] = filter_var($dataArray["username"], FILTER_SANITIZE_STRING);
		$this->data["password"] = filter_var($dataArray["password"], FILTER_SANITIZE_STRING);
		$this->data["name"] = filter_var($dataArray["name"], FILTER_SANITIZE_STRING);
		$this->data["description"] = filter_var($dataArray["description"], FILTER_SANITIZE_STRING);
		$this->data["quote"] = filter_var($dataArray["quote"], FILTER_SANITIZE_STRING);
		
		/* if(isset($this->data["user_level"]))
		{
			$this->data["user_level"] = filter_var($dataArray["user_level"], FILTER_SANITIZE_STRING);
		} */
		return $dataArray;
	}
	
	
	function validate()
	{
		//variable to check if successful validation
		$isValid = false;
		
		if(empty($this->data['username']))
		{
				$this->errors['username'] = "Please enter a Username";
		}
		
		if(empty($this->data['password']))
		{
				$this->errors['password'] = "Please enter a password";
		}
		
		if(empty($this->data['description']))
		{
				$this->errors['description'] = "Please enter a description of yourself";
		}
		
		
		//validate data elements in userData property
		//if an error exists, store to errors using column name as key
		
		  if(empty($this->errors))
		{
			$isValid = true;
		}
		
		return $isValid;
	}
	
	
	// function to see if the username and password match up
	function checkLogin($username, $password)
	{
		
		//set an empty userId variable
		$userId = null;
		
		//make a call to grab the user id of the row that has a username AND password that match the specified ones
		$stmt = $this->db -> prepare("SELECT user_id FROM user WHERE username=? && password=?");
		
		$stmt -> execute(array($username, $password));
		
		$userIdToCheck = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//var_dump($userIdToCheck);
		
		
		//if the username and password do not match up, no rows will be found, and userIdToCheck will equal false
		//if username and password do not match up, put out error
		if($userIdToCheck == false)
		{
			$this->errors['password'] = "Username and password do not match";
			
			//var_dump($password, $userIdToCheck);
			//echo "NOOOO!!!";
		}
		//else, if the username and password do match up, set the user id to the $userId variable
		 else
		{
			$userIdToCheck = $userIdToCheck['user_id'];
		} 
		
		//return the user ID associated with the username and password
		return $userIdToCheck;
	}
	
	
	function saveImage($imageFileData)
	{	 
		$imageLocation = dirname(__FILE__)."/../public_html/user-images/user_".$this->data[$this->keyField].".jpg";
		
		move_uploaded_file
		(
			$imageFileData['tmp_name'],
			$imageLocation
		);
	}
	
	function savePipPic($pipPicData)
	{	 
		$imageLocation = dirname(__FILE__)."/../public_html/rpp-pics/user_".$this->data[$this->keyField].".jpg";
		
		move_uploaded_file
		(
			$pipPicData['tmp_name'],
			$imageLocation
		);
	}
	
	function addUserToFamilioli($userId, $sessionUser)
	{	
		$sql = "SELECT familioli FROM user WHERE user_id = ".$sessionUser;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		
		$fam = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$sql="SELECT name FROM user WHERE user_id = ".$userId;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		
		$famName= $stmt->fetch(PDO::FETCH_ASSOC);
		
		$famName = (string)$famName['name'];

		//echo $userId; die;
		
		if(strpos($fam['familioli'], "<a href='/ropogu(local)/public_html/user-view.php?user_id=".$userId."'><img src='/ropogu(local)/public_html/rpp-pics/user_".$userId.".jpg'  alt='".$famName."' title='".$famName."'/></a>") !==false)
		{
			return;
		}
		else
		{
			$fam['familioli'] .= "<a href='/ropogu(local)/public_html/user-view.php?user_id=".$userId."'><img src='/ropogu(local)/public_html/rpp-pics/user_".$userId.".jpg'  alt='".$famName."' title='".$famName."'/></a>";
		
			$sql = "UPDATE user SET familioli =? WHERE user_id=?"; 
		
			$stmt = $this->db->prepare($sql);
		
			$stmt->execute(array($fam['familioli'], $sessionUser));
			
			$sql ="SELECT familioli FROM user WHERE user_id = ".$sessionUser;
			
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
		
			$fam= $stmt->fetch(PDO::FETCH_ASSOC);
		
			//var_dump($familioli);
	
			return $fam['familioli'];
		
		}
	}
	
	function deleteFromFamilioli($userId, $sessionUser)
	{
		$sql = "SELECT familioli FROM user WHERE user_id = ".$sessionUser;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		
		$fam = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$sql="SELECT name FROM user WHERE user_id = ".$userId;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		
		$famName= $stmt->fetch(PDO::FETCH_ASSOC);
		
		$famName = (string)$famName['name'];

		echo "FIRST FAM: ".$fam['familioli'];
		
		if(strpos($fam['familioli'], "<a href='/ropogu(local)/public_html/user-view.php?user_id=".$userId."'><img src='/ropogu(local)/public_html/rpp-pics/user_".$userId.".jpg'  alt='".$famName."' title='".$famName."'/></a>") !==false)
		{
			$fam['familioli'] = str_replace( "<a href='/ropogu(local)/public_html/user-view.php?user_id=".$userId."'><img src='/ropogu(local)/public_html/rpp-pics/user_".$userId.".jpg'  alt='".$famName."' title='".$famName."'/></a>"," ", $fam['familioli']); 
		}
		
		
			$sql = "UPDATE user SET familioli =? WHERE user_id=?"; 
		
			$stmt = $this->db->prepare($sql);
		
			$stmt->execute(array($fam['familioli'], $sessionUser));
			
			$sql ="SELECT familioli FROM user WHERE user_id = ".$sessionUser;
			
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
		
			$fam= $stmt->fetch(PDO::FETCH_ASSOC);
		
			//var_dump($familioli);
	
			return $fam['familioli'];
		
	} 
}
?>