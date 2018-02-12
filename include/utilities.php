<?php

class Utility
{

	private $connection;
	
	function __construct($db)
	{
		$this->connection = $db;
	}

	public function redirect_to($new_location) 
	{
		header("Location: " . $new_location);
		exit;
	}

	public function password_encrypt($password) {
		$hash_format = "$2y$10$"; // Blowfish hash - 2y, how many times run - 10
		$salt_length = 22; // Salts always should be 22 characters or more
		$salt = $this->generate_salt($salt_length);
		$format_and_salt = $hash_format . $salt;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}

	public function generate_salt($length) {
		$unique_random_string = md5(uniqid(mt_rand(), true));
		$base64_string = base64_encode($unique_random_string);
		$modified_base64_string = str_replace('+', '.', $base64_string);
		$salt = substr($modified_base64_string, 0, $length);
		return $salt;
	}

	public function password_check($password, $existing_hash) {
		$hash = crypt($password, $existing_hash);
		if ($hash === $existing_hash) {
			return true;
		} else {
			return false;
		}
	}

	public function logOut() 
	{
		session_destroy();
		header('Location: ./');
		exit;
	}

}

?>