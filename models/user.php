<?php

class User
{

	private $connection;
	private $db_table = "users";

	public $user_id;
	public $name;
	public $pass;
	public $real_name;
	public $email;
	public $priv;
	public $is_active;
	
	function __construct($db)
	{
		$this->connection = $db;
	}

	public function readAll()
	{
		$query = "SELECT * FROM " . $this->db_table . 
				 " ORDER BY user_id DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

}

?>