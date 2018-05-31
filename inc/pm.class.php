<?php
require_once('base.class.php');

class pm extends Base
{
	
	//create a construct function that will set the database when a new post class is created
	function __construct()
	{
		parent::__construct();
		$this->tableName = "pm";
		$this->keyField = "pm_id";
		$this->columnNames = array("from_id", "to_id", "message", "seen", "date");
		//'seen column' saved as number boolean; 0=false, 1=true
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

	function displayLetters($sessionUser, $type=null)
	{
		
		if($type == "unseen")
		{
			$sql = "SELECT * FROM pm WHERE to_id = ".$sessionUser. " AND seen = 0 ORDER BY date DESC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
		
			$letters = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		{
			$sql = "SELECT * FROM pm WHERE to_id = ".$sessionUser. " ORDER BY date DESC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
		
			$letters = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		for($x=0; $x<count($letters); $x++)
			{
				$sql = "SELECT username FROM user WHERE user_id = ".$letters[$x]['from_id'];
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$fromName = $stmt->fetch(PDO::FETCH_ASSOC);
				array_push($letters[$x], $fromName);
			}

	
	return $letters;
	}
	
	function findLetterSender($fromID)
	{
		$sql = "SELECT username FROM user WHERE user_id = ".$fromID;
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$fromName = $stmt->fetch(PDO::FETCH_ASSOC);
				return $fromName;
	}
	
	function letterHasBeenSeen($pmID)
	{
		$seen = false;
		
		$stmt = $this->db -> prepare("UPDATE pm SET seen=? WHERE pm_id=?");
		
		if($stmt -> execute(array(1, $pmID)))
		{
			$seen = true;
		}
		
		return $seen;
		
	}

}
?>