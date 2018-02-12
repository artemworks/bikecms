<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./include/utilities.php";
$utility = new Utility($db);

require_once "./models/user.php";
$user = new User($db);

if ( isset($_SESSION["name"]) )
{
	$_SESSION['error'] = "You are already logged in as " . $_SESSION["name"];
	$utility->redirect_to( DIR_URL );
}
	
if ( isset($_POST['cancel']) ) 
{
	$_SESSION['success'] = "Login cancelled";
	$utility->redirect_to( DIR_URL );
}
	
if ( isset($_POST['name']) && isset($_POST['pass']) ) 
{

	$username_input = htmlentities($_POST['name']);
	$pass_input = htmlentities($_POST['pass']);

	if ( !empty($username_input) && !empty($pass_input) ) 
	{
		$user_data = $user->getUserByname($username_input);
		$pass_db = $user_data["pass"];

		if ( $utility->password_check($pass_input, $pass_db) ) {

			if ( isset($row['real_name']) ) 
			{
				$_SESSION["name"] = $user_data['real_name'];
			} else {
				$_SESSION["name"] = $user_data['name'];
			}
			
			$_SESSION['user_id'] = $user_data['user_id'];

			if ( $user_data["is_active"] ) {
				if ( $user_data["priv"] ) {
					$_SESSION['success'] = "Success! You are logged in as admininstrator " . $_SESSION["name"];
					$utility->redirect_to( DIR_URL . "cms" );
				} else {
					$_SESSION['success'] = "Success! You are logged in as user " . $_SESSION["name"];
					$utility->redirect_to( DIR_URL );		
				}
			} else {
				$_SESSION['error'] = "Your login is blocked and waiting for approval";
				$utility->redirect_to( DIR_URL );
			}

	    } else {
	        $_SESSION['error'] = "Incorrect username or password for " . $username_input;
	        $utility->redirect_to( DIR_URL . "login" );	
	    }			
	} 
	else 
	{
		$_SESSION['error'] = "Name and password can not be blank";
		$utility->redirect_to( DIR_URL . "login" );				
	}
}

require_once "./views/header.php";
require_once "./views/users/login.php";
require_once "./views/footer.php";

?>