<?php

class Database
{
	private $host = "localhost";
	private $dbname = "bikecms";
	private $username = "bikecms";
	private $password = "bikecms";
	public $connection;
	
	public function getConnection()
	{
		$this->connection = null;

		try
		{
			$this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8", $this->username, $this->password);
		}
		catch(PDOException $exception)
		{
			echo "Connection error: " . $exception->getMessage();
		}

		return $this->connection;
	}
}

?>