<?php

function flashMessages() {
	if ( isset($_SESSION['error']) && $_SESSION['error'] !== false ) {
		echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
	    unset($_SESSION['error']);
	}
	if ( isset($_SESSION['success']) && $_SESSION['success'] !== false ) {
		echo('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
	    unset($_SESSION['error']);
	}
}

?>