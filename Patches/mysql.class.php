<?php
/*
	@copyright: Really Coding Group
	@Id: $Id: class.mysql.php 1596 2006-03-01 14:38:40Z paulsohier $
*/
class mysql{
	static public $query,$num,$result,$database,$db,$db2;
	/*
	This function connects to the database
	@param host
	@param username
	@param password
	@param database name
	@param make db or not
	@return connection id of false
	*/
  public static function connect($host,$username,$password,$dbname,$makedb = false){
		if(empty($host) || empty($username) || empty($password) || empty($dbname)){
			//return false;
		}
		self::$database = $dbname;//Used @ phpbb plugin
		self::$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		if(self::$db === false){
			return self::$db;
		}else{
			if($makedb === true){
				$sql = "CREATE DATABASE ".$dbname;
				if(!self::$db->query($sql,self::$dbname)){
					return false;
				}
			}
		}
	}
	/*
	This function returns the result in array
	@param mysql query output
	@return result or false
	*/
	static function sql_fetchrowset($id = 0){
		if(!$id)
		{
			$id = self::$result;
		}
		$result = array();
		if($id){
			$result = $id->fetchAll(PDO::FETCH_ASSOC);
			$id->closeCursor();
			return $result;
		}else{
			return array();
		}
	}
	/*
	This function returns one row of the result in array
	@param mysql query output
	@return result or false
	*/
	static function sql_fetchrow($id = 0,$method = ""){
		if(!$id){
			$id = self::$result;
		}
		if($id){
			$result = $id->fetch(PDO::FETCH_ASSOC);
			$id->closeCursor();
			return $result;
		}else{
			return false;
		}
	}
	/*
	This function returns number of results of last query
	@param mysql query output
	@return number or false
	*/
	static function sql_numrows($id = 0){
		if(!$id){
			$id = self::$result;
		}
		if($id){
			$result = $id->rowCount();
			return $result;
		}else{
			return false;
		}
	}
	/*
	This function submits a query
	@param a sql query
	@return result or false
	*/
	static function sql_query($sql){
		if($sql){
			if(is_array($sql)){
				for($i = 0; $i < count($sql);$i++){
					if(!self::sql_query($sql[$i])){
						die("Could not run sql query array.<br/>".$sql[$i]);
					}
				}
				return;
			}
			self::$query = $sql;
			self::$num++;
			self::$result = self::$db->query($sql);
			if(!self::$result){
				die(var_export(self::$db->errorinfo(), TRUE));
			}
			return self::$result;
		}else{
			return false;
		}
	}
	/*
	This function returns the total amount of querys exicuted
	@return number
	*/
	static function sql_numqueries()
	{
		return $this -> num;
	}
	/*
	This function returns the mysql error message if there is one
	@return mysql_error()
	*/
	static function sql_error()
	{
		return mysql_error();
	}
	static function sql_prepare($sql){
		if($sql){
			$stmt = self::$db->prepare($sql);
			self::$result = $stmt;
			return self::$result;
		} else{
			return false;
		}
	}
	static function sql_execute($params){
		if(!self::$result){
			return false;
		} else{
			return self::$result->execute($params);
		}
	}
}
?>

