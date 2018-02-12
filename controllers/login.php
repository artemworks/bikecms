<?php
	
			if ( isset($_SESSION["name"]) ) {
				$_SESSION['error'] = "You are already logged in";
		        header("Location: ./");
		        return;
			}
			if ( isset($_POST['cancel']) ) {
				$_SESSION['success'] = "Login cancelled";
		        header("Location: ./");
		        return;
			}
			if ( isset($_POST['name']) && isset($_POST['pass']) ) {
				if ( !empty($_POST['name']) && !empty($_POST['pass']) ) {

					logIn($_POST['name'], $_POST['pass']);
					
				} else {
					$_SESSION['error'] = "Name and password can not be blank";
			        header("Location: ./login");
			        return;					
				}
			}

require_once "./views/header.php";
require_once "./views/users/login.php";
require_once "./views/footer.php";

?>