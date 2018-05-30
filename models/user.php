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
	public $country;
	public $city;

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

	public function getUserByEmail($email) {

		$email = htmlentities($email);

		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE email = :eml LIMIT 1");
		$stmt->execute(array(':eml' => $email));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getUserByEmailPassHashed($email, $pass) {

		$email = htmlentities($email);

		$stmt = $this->connection->prepare("SELECT email,pass FROM " . $this->db_table . " WHERE md5(email) = :eml AND md5(pass) = :pss LIMIT 1");
		$stmt->execute(array(':eml' => $email, ':pss' => $pass));
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

	public function addUser($name, $pass, $realname, $email, $priv, $is_active, $country, $city)
	{
		$stmt = $this->connection->prepare("INSERT INTO " . $this->db_table . " (name, pass, real_name, email, priv, is_active, country, city) VALUES (:nm, :pw, :rnm, :eml, :priv, :isa, :con, :cty)");
		$stmt->execute(array(':nm' => $name, ':pw' => $pass, ':rnm' => $realname, ':eml' => $email, ':priv' => $priv, ':isa' => $is_active, ':con' => $country, ':cty' => $city));
		$user_id = $this->connection->lastInsertId();
		return $user_id;
	}

	public function delUser($user_id){

  		$stmt = $this->connection->prepare("DELETE FROM " . $this->db_table . " WHERE user_id = :uid");

		if( $stmt->execute(array( ':uid' => $user_id )) )
		{
			return true;
		}

		return false;
	}

	public function updateUser($name, $pass, $realname, $email, $priv, $is_active, $country, $city, $user_id){

    	$stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET
				    		name = :nm,
				    		pass = :pw,
				    		real_name = :rnm,
				    		email = :eml,
				    		priv = :priv,
				    		is_active = :isa,
				    		country = :con,
				    		city = :cty
                         WHERE user_id = :uid");

		if( $stmt->execute(array(
							':nm' => $name,
							':pw' => $pass,
							':rnm' => $realname,
							':eml' => $email,
							':priv' => $priv,
							':isa' => $is_active,
							':con' => $country,
							':cty' => $city,
							':uid' => $user_id)) )
		{
			return true;
		}
		return false;
	}

	public function updateUserPass($pass, $email){

    	$stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET
				    		pass = :pw
                  WHERE email = :eml");

		if( $stmt->execute(array(
							':pw' => $pass,
							':eml' => $email)) )
		{
			return true;
		}
		return false;
	}

}

?>