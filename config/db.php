<?php

$DATABASE_URL = '127.0.0.1';
$USER = 'mysql';
$USER_PASSWORD = 'mysql';
$DATABASE = 'carsharing';
/*
class DB
{
	private $connection;
	private $result;
	public function __construct()
	{
		$this->connection = mysqli_connect('127.0.0.1','mysql','mysql','carsharing');
		if($this->connection == false)
		{
			echo 'Не удалось подключится к базе данных<br>';
			echo mysqli_connect_error();
			exit();
		}
	}
	public function __destruct()
	{
		mysqli_close($this->connection);
	}

	public function get_request($sql_req)
	{
		$this->result = mysqli_query($this->connection, $sql_req);
	}
	public function get_lasy_id($sql_req)
	{
		$this->result = mysqli_query($this->connection, $sql_req);
	}
	

	public function unpacking()
	{
		 return mysqli_fetch_assoc($this->result);
	}


}


*/

