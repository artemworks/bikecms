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
        header("Location: ./login");
        return;
    }
}

function logOut() {
	session_destroy();
	header('Location: ./');
}

function userMessages() {
	global $dir_url;

	if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
		echo "<a class='nav-link' href='/" . $dir_url . "/login'>Login</a>";
	} else {
		echo "Hello, " . $_SESSION['name'] . " <a class=\"nav-link\" href='/" . $dir_url . "/logout'>Logout</a> ";
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

function getArticles() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM article ORDER BY posted DESC");
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getSections() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM section ORDER BY rank ASC");
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function getTags() {
	global $pdo;

	$stmt = $pdo->query("SELECT * FROM tag ORDER BY name ASC");
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

function getArticleById($article_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM article WHERE article_id = :aid LIMIT 1");
	$stmt->execute(array(':aid' => $article_id));
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

function getSectionById($section_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM section WHERE section_id = :sid");
	$stmt->execute(array(':sid' => $section_id));
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

function getTagById($tag_id) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT * FROM tag WHERE tag_id = :tid");
	$stmt->execute(array(':tid' => $tag_id));
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}



?>