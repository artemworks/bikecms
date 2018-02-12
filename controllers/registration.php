<?php

	if ( isset($_SESSION["name"]) ) {
		$_SESSION['error'] = "No need to register. You are already logged in!";
		header("Location: ./");
		return;
		}
	
	if ( isset($_POST['cancel']) ) {
		$_SESSION['success'] = "Registration cancelled";
		header("Location: ./");
		return;
		}
	
	if ( isset($_POST['reg_name']) && 
		isset($_POST['reg_pass']) && 
		isset($_POST['reg_real'])&& 
		isset($_POST['reg_email']) ) {

				if ( !empty($_POST['reg_name']) && !empty($_POST['reg_pass']) 
					&& !empty($_POST['reg_real']) && !empty($_POST['reg_email']) ) {

					if ( strpos($_POST['reg_email'], '@') == true ) {

						if ( strlen($_POST['reg_pass']) >= 6 ) {

							addUser($_POST['reg_name'], $_POST['reg_pass'], $_POST['reg_real'], $_POST['reg_email']);

						} else {
							$_SESSION['error'] = "Password shold be at least 6 characters long";
					        header("Location: ./register");
					        return;
						}
					
					} else {
						$_SESSION['error'] = "Email must have an at-sign (@)";
				        header("Location: ./register");
				        return;
					}

				} else {
					$_SESSION['error'] = "All fields are required";
			        header("Location: ./register");
			        return;	
				}

		}

require_once "./views/header.php";
require_once "./views/users/reg.php";
require_once "./views/footer.php";

?>