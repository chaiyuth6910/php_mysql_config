<?php 
try{
	$options = array(
    		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	); 

	$dbh = new PDO("mysql:host=$host;dbname=$dbname",$username,$password,$options);
	//echo "Connected to database success";
}catch(PDOException $e){
	echo $e->getMessage();
}
?>