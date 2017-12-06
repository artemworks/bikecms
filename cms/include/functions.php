<?php

function logIn($salt, $name, $pass) {
	global $pdo;

	$check = hash('md5', $salt.$pass);
	$stmt = $pdo->prepare('SELECT * FROM users WHERE name = :nm AND pass = :pw');
	$stmt->execute(array( ':nm' => $name, ':pw' => $check));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if ( $row !== false ) {

		if (isset($row['real_name'])) {
			$_SESSION["name"] = $row['real_name'];
		} else {
			$_SESSION["name"] = $row['name'];
		}
		
		$_SESSION['user_id'] = $row['user_id'];

		if ( $row["is_active"] ) {
			if ( $row["priv"] == 2 ) {
				$_SESSION['success'] = "Success! You are logged in as administrator " . $_SESSION["name"];
				header("Location: cms/");
        		return;
			} else if ( $row["priv"] == 1 ) {
				$_SESSION['success'] = "Success! You are logged in as moderator " . $_SESSION["name"];
				header("Location: ./");
        		return;
			} else {
				$_SESSION['success'] = "Success! You are logged in as user " . $_SESSION["name"];
				header("Location: ./");
        		return;			
			}
		} else {
			$_SESSION['error'] = "Your login is blocked and waiting for approval";
			header("Location: ./");
        	return;
		}

    } else {
        $_SESSION['error'] = "Incorrect password";
        header("Location: ./");
        return;
    }
}

function logOut() {
	session_destroy();
	header('Location: ./');
}

function flashMessages() {
	if ( isset($_SESSION['error']) && $_SESSION['error'] !== false ) {
		echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
	    unset($_SESSION['error']);
	}
	if ( isset($_SESSION['success']) && $_SESSION['success'] !== false ) {
		echo('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
	    unset($_SESSION['success']);
	}
}

function getArticles() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM article ORDER BY posted DESC");
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getArticleByUrl($title_url) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM article WHERE title_url = :turl LIMIT 1");
	$stmt->execute(array(':turl' => $title_url));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function getSectionById($section_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM section WHERE section_id = :sid LIMIT 1");
	$stmt->execute(array(':sid' => $section_id));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

?>