<?php
require_once "./cms/include/pdo.php";
require_once "./cms/include/essentials.php";
require_once "./cms/include/functions.php";
session_start();

flashMessages();

isset($_GET["page"]) ? $page = $_GET["page"] : $page = "default";

switch ($page) {
	case 'login':
			if ( isset($_SESSION["name"]) ) {
				$_SESSION['error'] = "You are already logged in";
		        header("Location: ./");
		        return;
			}
			if ( isset($_POST['name']) && isset($_POST['pass']) ) {
				flashMessages();
				logIn($salt, $pdo, $_POST['name'], $_POST['pass']);
			} 
			echo '
				<h2>Please Log In</h2>
				<form method="POST">
				<label for="name">Login</label>
				<input type="text" name="name"><br>
				<label for="pass">Password</label>
				<input type="text" name="pass"><br>
				<input type="submit" name="submit" value="Log In">
				<input type="submit" name="cancel" value="Cancel">
				</form>
			';
		break;
	case 'logout': logOut();
		break;
	default:
		if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
			echo "Hello, world. Try to <a href='login'>login</a>";
		} else {
			echo "Hello, <b>" . $_SESSION['name'] . "</b>. <a href='logout'>Logout</a>";
		}
		break;
}

?>