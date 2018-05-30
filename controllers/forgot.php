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
	$_SESSION['success'] = "Restoration cancelled";
	$utility->redirect_to( DIR_URL );
}

if ( isset($_POST['email']) )
{

	$email_input = htmlentities($_POST['email']);

	if ( !empty($email_input) )
	{
		$user_data = $user->getUserByEmail($email_input);
		if ( $user_data )
		{
			$user_name = $user_data["name"];
			$user_email = $user_data["email"];
			$pass_db = $user_data["pass"];

			$md_user_email = md5($user_email);
			$md_pass_db = md5($pass_db);
			$link = "<a href=" . DIR_URL . "reset/" . $md_user_email . "." . $md_pass_db . ">Click here to reset your password</a>";

			$to = $user_name . "<" . $user_email . ">";
			$subject = "Someone has requested your password for " . CMS_TITLE . " at " . strftime("%T", time());
			$message = "Hi! " . $link;
			$message = wordwrap($message, 70);

			// Edit this line
			$from = "";
			$headers = "From: " . $from;
/*
			$result = mail($to, $subject, $message, $headers);
*/
			if( $result )
			{
				$_SESSION['success'] = "Email with password was successfully sent to you";
				$utility->redirect_to( DIR_URL );
			}
			else
			{
				$_SESSION['error'] = "Error! Please try again later";
				$utility->redirect_to( DIR_URL );
			}
		}
		else
		{
			$_SESSION['error'] = "Error! E-mail is wrong!";
			$utility->redirect_to( DIR_URL . "forgot" );
		}
	}
	else
	{
		$_SESSION['error'] = "Email can not be blank";
		$utility->redirect_to( DIR_URL . "forgot" );
	}
}

require_once "./views/header.php";
require_once "./views/users/forgot.php";
require_once "./views/footer.php";

?>