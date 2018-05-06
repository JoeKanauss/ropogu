<?php
	class Base
{
	//array to hold  data
	var $data = array();
	
	//array to hold errors
	var $errors = array();
	
	//set an empty database variable
	var $db = null;
	
	//set table name
	var $tableName = null;
	
	//set key field
	var $keyField = null;
	
	//set column names
	var $columnNames = array();
	
	
	//create a construct function that will set the database when a new user class is created
	function __construct()
	{
		$this->db = new PDO('mysql:host=localhost; dbname=ropogu; charset=utf8', 'ropogu_master', 'rolypolyguacamolemaster');
	}
	
	function set($dataArray)
	{
		//allows access to instance properties
		$this->data = $dataArray;
	}
	
	function sanitize($dataArray)
	{

		return $dataArray;
	}
	
	function load($id)
	{
		//variable to check if successful load
		$isLoaded = false;
		
		//load from database
		$stmt = $this->db -> prepare("SELECT * FROM " . $this->tableName . " WHERE " . $this->keyField . "= ?");
		$stmt -> execute(array($id));
		
		if($stmt->rowCount() == 1)
		{
			$dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$this->set($dataArray);
			
			$isLoaded = true;
		}

		return $isLoaded;
	}
	
	function save()
	{
		//variable to check if successful save
		$isSaved = false;
		
		//determine if insert or update based on articleID
		if(empty($this->data[$this->keyField]))
		{
			
			$sql = "INSERT INTO " . $this->tableName . " 
					(" . implode(', ', $this->columnNames) . ")
					VALUES (";
					
			for ($i = 0; $i < count($this->columnNames); $i++)
			{
				$sql .=($i > 0 ? ', ?' : '?');
			}
			
			$sql .= ")";
			
			$stmt = $this->db->prepare($sql);
			
			$dataArray = array();
			
			foreach($this->columnNames as $columnName)
			{
				$dataArray[] = $this->data[$columnName];
			}
			
			$isSaved = $stmt->execute(array_values($dataArray));
			
			if($isSaved)
			{
				$this->data[$this->keyField] = $this->db->lastInsertId();
			}
		}
		else
		{
			$sql = "UPDATE " . $this->tableName . " SET ";
			
			foreach($this->columnNames as $columnName)
			{
					$sql .= $columnName . " = ?,";
			}
			
			
			//remove trailing comma
			$sql = substr($sql, 0, strlen($sql) -1);
			
			$sql .= "WHERE " . $this->keyField . " = ?";
			
			$stmt = $this->db->prepare($sql);
			
			$dataArray = array();
			
			foreach ($this->columnNames as $columnName)
			{
				//set data order
				$dataArray[$columnName] = $this->data[$columnName];
			}
			
			$dataArray[] = $this->data[$this->keyField];
			
			$isSaved = $stmt->execute(array_values($dataArray));
		}
		
		//save data from userdata property to database
		
		return $isSaved;
	}
	
	function validate()
	{
		//variable to check if successful validation
		$isValid = true;
	
		return $isValid;
	}
	
	
	
	function retrieveAll($sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null) //setting default values makes parameters optional
	{
		
		$sql = "SELECT * FROM ". $this->tableName . " "; 
		
		if(!is_null($sortColumn))
		{
			$sql .= "ORDER BY ". $sortColumn;
			
			if(!is_null($sortDirection))
			{
				$sql .= " " . $sortDirection;
			}
		}
		
		if(!is_null($filterColumn) & !is_null($filterText))
		{
			$sql .= "WHERE ". $filterColumn . " LIKE ?";
		
			if(!is_null($sortDirection))
			{
				$sql .=" " . $sortDirection;
			}
		}
		
		
		$stmt = $this->db->prepare($sql);
		
			$stmt->execute(array("%".$filterText."%"));
			$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $list;
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
	
	function delete($idToDelete)
	{
		$isDeleted = false;
		
		$stmt = $this->db->prepare("DELETE FROM $this->tableName WHERE $this->keyField = ?");
		
		$stmt -> execute(array($idToDelete));
	}
	
}
?>