<?php
/**
* Class oopCrud for CRUD mysql database
*/
class CrudMySQL
{
	// Variable for pdo connect mysql
	private $host = "localhost";
	private $username = "username_here";
	private $password = "password_here";
	private $dbname = "db_name_here";
	private $connect;
	
	public function __construct()
	{
		// Connect mysql with PDO
		try {
			$this->connect = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,
				$this->username,
				$this->password,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*
	* Method select data
	*/
	public function showData($table,$condition)
	{
		$sql = "SELECT * FROM $table $condition";
		$query = $this->connect->query($sql);

		while($rs = $query->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $rs;
		}

		return $data;
	}

	/*
	* Method insert data  แบบส่ง key-value
	*/
	public function InsertData($values=array(),$table)
	{
		// loop read filed
		foreach ($values as $field => $v){
            			$ins[] = ':'.$field;
		}

		$ins = implode(',', $ins);
		$fields = implode(',', array_keys($values));

		 $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

		 $sth = $this->connect->prepare($sql);

		 //loop for bindValue
		 foreach ($values as $f => $v)
		 {
		        $sth->bindValue(':' . $f, $v);
		 }

		 return $sth->execute();
	}

	/*
	* Method delete data
	*/
	public function deleteData($id,$table)
	{
		$sql = "DELETE FROM $table WHERE id=:id";
		$sth = $this->connect->prepare($sql);
		$sth->bindParam(':id', $id, PDO::PARAM_STR);
		$sth->execute();
	}

	/*
	* Method select data by id
	*/
	public function getByID($id,$table)
	{
		$sql = "SELECT * FROM $table WHERE id=:id";
		$sth = $this->connect->prepare($sql);
		$sth->bindParam(':id', $id, PDO::PARAM_STR);
		$sth->execute();
		$data = $sth->fetch(PDO::FETCH_ASSOC);

		return $data;
	}

	/*
	* Method update data
	*/
	public function updateData($values=array(),$condition,$table){
		foreach ($values as $field => $v){
	            		$ins[] = $field.'=:'.$field;
	        	}
	        
	        	$ins = implode(',', $ins);
					
		$sql = "UPDATE $table SET $ins $condition";
		$sth = $this->connect->prepare($sql);
	        	
	        	foreach ($values as $f => $v)
	        	{
	            		$sth->bindValue(':' . $f, $v);
	        	}
			
	        return $sth->execute();
	}

}
