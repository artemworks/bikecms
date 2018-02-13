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

	public function getUserById($user_id) 
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE user_id = :uid LIMIT 1");
		$stmt->execute(array(':uid' => $user_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getUserByName($name) {

		$name = htmlentities($name);
		
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE name = :nm LIMIT 1");
		$stmt->execute(array(':nm' => $name));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function restrictAccessToCMS() {

		if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
	        $_SESSION['error'] = "Forbidden. You are not logged in!";
	        header("Location: ../login");
	        return;
		} else {
			$user = $this->getUserById($_SESSION['user_id']);
			if ( !$user["priv"] ) {
			    $_SESSION['error'] = "Forbidden. You are not allowed to enter this section!";
			    header("Location: ../");
			    return;
			}
		}
	}

	public function addUser($name, $pass, $realname, $email, $country, $city) 
	{
		$stmt = $this->connection->prepare("INSERT INTO " . $this->db_table . " (name, pass, real_name, email, country, city) VALUES (:nm, :pw, :rnm, :eml, :con, :cty)");
		$stmt->execute(array(':nm' => $name, ':pw' => $pass, ':rnm' => $realname, ':eml' => $email, ':con' => $country, ':cty' => $city));
		$user_id = $this->connection->lastInsertId();
		return $user_id;
	}

}

?>