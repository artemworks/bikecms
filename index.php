<?php
require_once "./cms/include/pdo.php";
require_once "./cms/include/essentials.php";
require_once "./cms/include/functions.php";
session_start();

flashMessages();

isset($_GET["page"]) ? $page = htmlentities($_GET["page"]) : $page = "default";

switch ($page) {
	case 'login':
			if ( isset($_SESSION["name"]) ) {
				$_SESSION['error'] = "You are already logged in";
		        header("Location: ./");
		        return;
			}
			if ( isset($_POST['name']) && isset($_POST['pass']) ) {
				flashMessages();
				logIn($salt, $_POST['name'], $_POST['pass']);
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
	case 'logout': 
		logOut();
		break;
	case 'articles':
		if ( ! $_GET["article"] || $_GET["article"] == "/" ) {
			echo "<h1>My Articles</h1>";
			$articles = getArticles();
			foreach ($articles as $article) {
				if ( $article["is_active"] ) {
					echo 
						htmlentities($article["posted"]) . " <a href=" . 
						htmlentities($page) . "/" . 
						htmlentities($article["title_url"]) . ">" . 
						htmlentities($article["title"]) . "</a><br>"
					;
				}
			}
			echo "<a href=/" . $dir_url . ">Back</a>";
		}
		else if ( $_GET["article"] ) {
			$title_url = htmlentities(ltrim($_GET["article"], '/'));
			$article = getArticleByUrl($title_url);
			echo 
				"<h1>" . htmlentities($article["title"]) . "</h1>" . 
				"<strong>" . htmlentities($article["description"]) . "</strong>" . 
				"<p><i>" . htmlentities($article["posted"]) . "</i></p>" . 
				"<p>" . htmlentities($article["body"]) . "</p>" .
				"<p>Section: " . htmlentities($article["section_id"]) . "</p>" .
				"<p>Tag: <u><a href=/" . $dir_url . "/" . htmlentities(getSectionById($article["tag_id"])["name"]) . 
				">" . htmlentities(getSectionById($article["tag_id"])["title"]) . "</a></u></p>"
			;
		}
		break;
	default:
		if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
			echo "Hello, world. Try to <a href='login'>login</a> or see a list of <a href='articles'>articles</a>.";
		} else {
			echo "Hello, <b>" . $_SESSION['name'] . "</b>. <a href='logout'>Logout</a>. <a href='articles'>Articles</a>";
		}
		break;
}

?>