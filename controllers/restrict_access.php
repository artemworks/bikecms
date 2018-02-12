<?php

function restrictAccessCMS() {

	if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
        $_SESSION['error'] = "Forbidden. You are not logged in!";
        header("Location: ../login");
        return;
	} else {
		$user = getUserById($_SESSION['user_id']);
		if ( !$user["priv"] ) {
		    $_SESSION['error'] = "Forbidden. You are not allowed to enter this section!";
		    header("Location: ../");
		    return;
		}
	}
}

?>