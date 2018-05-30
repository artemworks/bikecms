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
	$_SESSION['success'] = "Reset cancelled";
	$utility->redirect_to( DIR_URL );
}

if ( $action && $action !== "/" )
{
	$combo_param = ltrim( htmlentities($action), "/");
	$access_details = explode( ".", $combo_param );
	$email_md5 = $access_details[0];
	$pass_md5 = $access_details[1];

	$select = $user->getUserByEmailPassHashed($email_md5, $pass_md5);

	if ( $select )
	{
		$user_email = $select["email"];

		if ( isset($_POST['pass']) && isset($_POST['send']) )
		{
			if ( !empty($_POST['pass']) ) {
				$pass_new = htmlentities($_POST['pass']);
				$pass_new_enc = $utility->password_encrypt($pass_new);
				$result = $user->updateUserPass($pass_new_enc, $user_email);
				if ( $result )
				{
					$_SESSION['success'] = "Your password has been changed successfully. Thank you!";
					$utility->redirect_to( DIR_URL . "login/");
				}
			}
			else
			{
				$_SESSION['error'] = "Error! Password can not be blank";
				$utility->redirect_to( DIR_URL . "reset/" . $combo_param);
			}
		}

	}
	else
	{
		$_SESSION['error'] = "Error! Wrong, already used or expired link";
		$utility->redirect_to( DIR_URL );
	}

}
else
{
	$_SESSION['error'] = "Error! Access forbidden";
	$utility->redirect_to( DIR_URL );
}

/*
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
			$md_pass_db = substr( md5($pass_db), 5, 10 );
			$link = "<a href=" . DIR_URL . "reset/" . $md_user_email . $md_pass_db . ">Click here to reset your password</a>";

			$to = $user_name . "<" . $user_email . ">";
			$subject = "Someone has requested your password for " . CMS_TITLE . " at " . strftime("%T", time());
			$message = "Your password is " . $pass_db . " and please change it as soon as you can";
			$message = wordwrap($message, 70);
			echo $link;

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

*/

require_once "./views/header.php";
require_once "./views/users/reset.php";
require_once "./views/footer.php";

?>