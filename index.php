<?php
require_once "./cms/include/pdo.php";
require_once "./cms/include/essentials.php";
require_once "./cms/include/functions.php";
session_start();
flashMessages();

isset($_GET["one"]) ? $page = htmlentities($_GET["one"]) : $page = "default";

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
			require_once "./header.php";
			echo '
				<h1 class="display-4">Please Log In</h1>
				<form method="POST">
				<label for="name">Login</label>
				<input type="text" name="name"><br>
				<label for="pass">Password</label>
				<input type="text" name="pass"><br>
				<input type="submit" name="submit" value="Log In">
				<input type="submit" name="cancel" value="Cancel">
				</form>
			';
			require_once "./footer.php";
		break;

	case 'logout': 

		logOut();
		break;

	case 'articles':
		require_once "./header.php";

		if ( ! $_GET["two"] || $_GET["two"] == "/" ) {
			echo "<h1 class=\"display-4\">My Articles</h1>";
			$articles = getArticles();
			foreach ($articles as $article) {
				if ( $article["is_active"] ) {
					$date = DateTime::createFromFormat('Y-m-d H:i:s', $article["posted"]);
					$date = $date->format('M, n Y');
					echo 
						htmlentities($date) . " <a href=" . 
						htmlentities($page) . "/" . 
						htmlentities($article["title_url"]) . ">" . 
						htmlentities($article["title"]) . "</a><br>"
					;
				}
			}
		}
		else if ( $_GET["two"] ) {
			$title_url = htmlentities(ltrim($_GET["two"], '/'));
			$article = getArticleByUrl($title_url);
			$date = DateTime::createFromFormat('Y-m-d H:i:s', $article["posted"]);
			$date = $date->format('D M, n Y g:i a');
			echo 
				"<h1 class=\"display-4\">" . htmlentities($article["title"]) . "</h1>" . 
				"<strong>" . htmlentities($article["description"]) . "</strong>" . 
				"<p><i>" . htmlentities($date) . "</i></p>" . 
				"<p>" . htmlentities($article["body"]) . "</p>"
			;
			
			$sections = getArticleSections($article["article_id"]);
			if (!empty($sections)) {
				echo "<p>Sections: ";
				foreach ($sections as $section) {
					$sectionArray = getSectionById($section["section_id"])[0];
					echo "<a href='/" . $dir_url . "/" . $sectionArray["page"] . "'>" . $sectionArray["title"] . "</a> ";
				}
				echo "</p>";
			}
					
			$tags = getArticleTags($article["article_id"]);
			if (!empty($tags)) {
				echo "<p>Tags: ";
				foreach ($tags as $tag) {
					$tagArray = getTagById($tag["tag_id"])[0];
					echo "<a href='/" . $dir_url . "/tags/" . $tagArray["name"] . "'>" . $tagArray["name"] . "</a> ";
				}
				echo "</p>";
			}
		}

		require_once "./footer.php";
		break;

	case 'tags':
		require_once "./header.php";

		if ( ! $_GET["two"] || $_GET["two"] == "/" ) {
			echo "<h1 class=\"display-4\">My Tags</h1>";
			$tags = getTags();
			foreach ($tags as $tag) {
				if ( $tag["is_active"] ) {
					echo 
						"<a href=/" . $dir_url . "/" . 
						htmlentities($page) . "/" . 
						htmlentities($tag["name"]) . ">" . 
						htmlentities($tag["name"]) . "</a> "
					;
				}
			}
		}
		else if ( $_GET["two"] ) {
			$name = htmlentities(ltrim($_GET["two"], '/'));
			echo "<h1 class=\"display-4\">My Articles for tag <i>" . $name . "</i></h1>";
			$tag_id = getTagIdByUrl($name)["tag_id"];
			$articles = getArticlesForTag($tag_id);
			foreach ($articles as $article) {
				
				$articleArr = getArticleById($article["article_id"]);
				$date = DateTime::createFromFormat('Y-m-d H:i:s', $articleArr["posted"]);
				$date = $date->format('M, n Y');

					echo 
						htmlentities($date) . " <a href=/" . $dir_url . "/articles/" .   
						htmlentities($articleArr["title_url"]) . ">" . 
						htmlentities($articleArr["title"]) . "</a><br>"
					;
			}
		}

		require_once "./footer.php";
		break;

	case 'search':
		require_once "./header.php";
		
		$search = searchArticle();
		if ( !empty($search) ) {
			echo "<p>Found " . count($search) . " entries:</p>";

			foreach ($search as $result) {
				$date = DateTime::createFromFormat('Y-m-d H:i:s', $result["posted"]);
				$date = $date->format('M, n Y');
				echo 
					htmlentities($date) . " <a href=/" . $dir_url . "/articles/" .   
					htmlentities($result["title_url"]) . ">" . 
					htmlentities($result["title"]) . "</a><br>"
				;
			}
		}
		require_once "./footer.php";
		break;

	default:
		require_once "./header.php";
		
		foreach ($sections as $section) {
			if ( isset($_GET["one"]) && $section["page"] == $_GET["one"]) {
				echo "<h1 class=\"display-4\">" . $section["title"] . "</h1>";
				echo "<p>" . $section["description"] . "</p>";
			}
		}

		require_once "./footer.php";
		break;
}

?>