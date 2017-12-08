<?php

function getArticles() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM article ORDER BY posted DESC");
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getArticlesSortedIdDesc() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM article ORDER BY article_id DESC");
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getTags() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM tag ORDER BY name ASC");
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getSections() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM section ORDER BY rank ASC");
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getUsers() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM users ORDER BY name ASC");
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getArticleById($article_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM article WHERE article_id = :aid LIMIT 1");
	$stmt->execute(array(':aid' => $article_id));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function getTagById($tag_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM tag WHERE tag_id = :tid");
	$stmt->execute(array(':tid' => $tag_id));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function getSectionById($section_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM section WHERE section_id = :sid");
	$stmt->execute(array(':sid' => $section_id));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function getUserById($user_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :uid LIMIT 1");
	$stmt->execute(array(':uid' => $user_id));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function addUser($reg_name, $reg_pass, $reg_real, $reg_email) {
	global $pdo;
	global $salt;

	$saltedHash = hash('md5', $salt.$reg_pass);
	$stmt = $pdo->prepare('INSERT INTO users (name, pass, real_name, email) VALUES (:nm, :pw, :rnm, :eml)');
	$stmt->execute(array(':nm' => $reg_name, ':pw' => $saltedHash, ':rnm' => $reg_real, ':eml' => $reg_email));
	$user_id = $pdo->lastInsertId();

	if ( $user_id !== false && !empty($user_id) ) {

		$_SESSION['user_id'] = $user_id;
		$userArray = getUserById($user_id);
		if (isset($userArray['real_name'])) {
			$_SESSION["name"] = $userArray['real_name'];
			header("Location: ./");
        	return;
		} else {
			$_SESSION["name"] = $userArray['name'];
			header("Location: ./");
        	return;
		}

	}
}

function logIn($salt, $name, $pass) {
	global $pdo;

	$check = hash('md5', $salt.$pass);
	$stmt = $pdo->prepare('SELECT * FROM users WHERE name = :nm AND pass = :pw');
	$stmt->execute(array(':nm' => $name, ':pw' => $check));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if ( $row !== false || !empty($row) ) {

		if (isset($row['real_name'])) {
			$_SESSION["name"] = $row['real_name'];
		} else {
			$_SESSION["name"] = $row['name'];
		}
		
		$_SESSION['user_id'] = $row['user_id'];

		if ( $row["is_active"] ) {
			if ( $row["priv"] ) {
				$_SESSION['success'] = "Success! You are logged in as admininstrator " . $_SESSION["name"];
				header("Location: ./cms");
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
        $_SESSION['error'] = "Incorrect password for " . $name;
        header("Location: ./login");
        return;
    }
}

function logOut() {
	session_destroy();
	header('Location: ./');
}

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

function userMessages() {
	global $dir_url;

	if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
		echo "<a class='nav-link' href='" . $dir_url . "login'>Login</a>";
		echo "<a class='nav-link' href='" . $dir_url . "register'>Register</a>";
	} else {
		echo "Hello, " . $_SESSION['name'] . " <a class=\"nav-link\" href='" . $dir_url . "logout'>Logout</a> ";
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

function getLastThreeArticles() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM article ORDER BY posted DESC LIMIT 3");
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

function getArticlesForTag($tag_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM tags WHERE tag_id = :tid");
	$stmt->execute(array(':tid' => $tag_id));
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getTagIdByUrl($name) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM tag WHERE name = :name LIMIT 1");
	$stmt->execute(array(':name' => $name));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function getArticleSections($article_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM sections WHERE article_id = :aid ORDER BY rank ASC");
	$stmt->execute(array(':aid' => $article_id));
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}


function getArticleTags($article_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM tags WHERE article_id = :aid ORDER BY rank ASC");
	$stmt->execute(array(':aid' => $article_id));
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}



function searchArticle() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM article WHERE body LIKE '%first%'");
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

?>