<?php 
	function getConnection(){
		$connection = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';',DB_USER,DB_PASS);
		$connection->exec("SET NAME '".DB_CHARSET."'");
		return $connection;
	}
	function getRecord($queryString, $queryParams = []){
		$connection = getConnection();
		$statement = $connection->prepare($queryString);
		$success = $statement->execute($queryParams);
		$result = $success ? $statement->fetch() : [];
		$statement->closeCursor();
		$connection = null;
		return $result;
	}
	function getList($queryString, $queryParams = []){
		$connection = getConnection();
		$statement = $connection->prepare($queryString);
		$success = $statement->execute($queryParams);
		$result = $success ? $statement->fetchAll() : [];
		$statement->closeCursor();
		$connection = null;
		return $result;
	}
	//INSERT, UPDATE, DELETE, ALTER
	function executeDML($queryString, $queryParams = []){
		$connection = getConnection();
		$statement = $connection->prepare($queryString);
		$success = $statement->execute($queryParams);
		$statement->closeCursor();
		$connection = null;
		return $success;
	}
 ?>