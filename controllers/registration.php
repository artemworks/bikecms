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
	$_SESSION['error'] = "No need to register. You are already logged in as " . $_SESSION["name"];
	$utility->redirect_to( DIR_URL );
}
	
if ( isset($_POST['cancel']) ) 
{
	$_SESSION['success'] = "Registration cancelled";
	$utility->redirect_to( DIR_URL );
}
	
if ( isset($_POST['reg_name']) && isset($_POST['reg_pass']) && 
	isset($_POST['reg_real'])&& isset($_POST['reg_email']) && 
	isset($_POST['reg_country'])&& isset($_POST['reg_city']) ) 
{

	$username = htmlentities($_POST['reg_name']);
	$pass = htmlentities($_POST['reg_pass']);
	$realname = htmlentities($_POST['reg_real']);
	$email = htmlentities($_POST['reg_email']);
	$country = htmlentities($_POST['reg_country']);
	$city = htmlentities($_POST['reg_city']);

				if ( !empty($username) && !empty($pass) 
					&& !empty($realname) && !empty($email)
					&& !empty($country) && !empty($city) ) 
				{

					if ( strpos($email, '@') == true ) 
					{

						if ( strlen($pass) >= 6 ) {

							$pass = $utility->password_encrypt($pass);
							$user_id = $user->addUser($username, $pass, $realname, $email, $country, $city);
							
							if ( $user_id !== false && !empty($user_id) ) 
							{

								$_SESSION['user_id'] = $user_id;
								$userArray = $user->getUserById($user_id);

								if (isset($userArray['real_name'])) 
								{
									$_SESSION["name"] = $userArray['real_name'];
									$_SESSION['success'] = "Success! You are logged in as " . $_SESSION["name"];
									$utility->redirect_to( DIR_URL );
								} 
								else 
								{
									$_SESSION["name"] = $userArray['name'];
									$_SESSION['success'] = "Success! You are logged in as admininstrator " . $_SESSION["name"];
									$utility->redirect_to( DIR_URL );
								}

							}
							else 
							{
								$_SESSION['error'] = "Error adding user";
						        $utility->redirect_to( DIR_URL . "register" );
							}

						} 
						else {
							$_SESSION['error'] = "Password shold be at least 6 characters long";
					        $utility->redirect_to( DIR_URL . "register" );
						}
					
					} 
					else 
					{
						$_SESSION['error'] = "Email must have an at-sign (@)";
				        $utility->redirect_to( DIR_URL . "register" );
					}

				} 
				else 
				{
					$_SESSION['error'] = "All fields are required";
			        $utility->redirect_to( DIR_URL . "register" );
				}

}

require_once "./views/header.php";
require_once "./views/users/reg.php";
require_once "./views/footer.php";

?>