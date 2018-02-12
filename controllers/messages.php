<?php

function userMessages() {
	if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
		echo "<a class='nav-link' href='" . DIR_URL . "login'>Login</a>";
		echo "<a class='nav-link' href='" . DIR_URL . "register'>Register</a>";
	} else {
		echo "Hello, " . $_SESSION['name'] . " <a class=\"nav-link\" href='" . DIR_URL . "logout'>Logout</a> ";
	}
}

function flashMessages() {
	if ( isset($_SESSION['error']) && $_SESSION['error'] !== false ) {
		echo('<div class="alert alert-danger" role="alert">' . htmlentities($_SESSION['error']) . "</div>");
	    unset($_SESSION['error']);
	}
	if ( isset($_SESSION['success']) && $_SESSION['success'] !== false ) {
		echo('<div class="alert alert-success" role="alert">' . htmlentities($_SESSION['success']) . "</div>");
	    unset($_SESSION['success']);
	}
}

?>