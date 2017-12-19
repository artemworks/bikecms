<?php
require_once "./cms/include/pdo.php";
require_once "./cms/include/essentials.php";
require_once "./cms/include/functions.php";
session_start();
flashMessages();

isset($_GET["one"]) ? $page = htmlentities($_GET["one"]) : $page = "homepage";

switch ($page) {

	case 'homepage':

		require_once "./header_cards.php";
		require_once "./footer.php";
		break;

	case 'register':

			if ( isset($_SESSION["name"]) ) {
				$_SESSION['error'] = "No need to register. You are already logged in!";
		        header("Location: ./");
		        return;
			}
			if ( isset($_POST['cancel']) ) {
				$_SESSION['success'] = "Registration cancelled";
		        header("Location: ./");
		        return;
			}
			if ( isset($_POST['reg_name']) && 
				isset($_POST['reg_pass']) && 
				isset($_POST['reg_real'])&& 
				isset($_POST['reg_email']) ) {

				if ( !empty($_POST['reg_name']) && !empty($_POST['reg_pass']) 
					&& !empty($_POST['reg_real']) && !empty($_POST['reg_email']) ) {

					if ( strpos($_POST['reg_email'], '@') == true ) {

						if ( strlen($_POST['reg_pass']) >= 6 ) {

							addUser($_POST['reg_name'], $_POST['reg_pass'], $_POST['reg_real'], $_POST['reg_email']);

						} else {
							$_SESSION['error'] = "Password shold be at least 6 characters long";
					        header("Location: ./register");
					        return;
						}
					
					} else {
						$_SESSION['error'] = "Email must have an at-sign (@)";
				        header("Location: ./register");
				        return;
					}

				} else {
					$_SESSION['error'] = "All fields are required";
			        header("Location: ./register");
			        return;	
				}

			}
			require_once "./header.php";
			echo '
				<h1 class="display-4">Registration</h1>
				<form method="POST">
				<div class="row">
					<div class="form-group col-md-6">
					  <label for="email">Your Login</label>
					  <input class="form-control" name="reg_name" type="text" aria-describedby="loginHelp" placeholder="Enter Your Login">
					  <small id="loginHelp" class="form-text text-muted">Desired login in latin.</small>
					</div>

					<div class="form-group col-md-6">
					  <label for="email">Real Name</label>
					  <input class="form-control" name="reg_real" type="text" aria-describedby="nameHelp" placeholder="Enter Your Real Name">
					  <small id="nameHelp" class="form-text text-muted">Real name. May be in cyrillic.</small>
					</div>

					<div class="form-group col-md-6">
					  <label for="email">Password</label>
					  <input class="form-control" name="reg_pass" type="password" aria-describedby="passHelp" placeholder="Enter Your Password">
					  <small id="passHelp" class="form-text text-muted">At least 6 characters long.</small>
					</div>

					<div class="form-group col-md-6">
					  <label for="email">Email address</label>
					  <input class="form-control" type="email" name="reg_email" aria-describedby="emailHelp" placeholder="Enter email@youremail">
					  <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
					</div>
				</div>
				<input type="submit" class="btn btn-outline-primary" name="submit" value="Register">
				<input type="submit" class="btn btn-outline-secondary" name="cancel" value="Cancel">
				</form>
			';
			require_once "./footer.php";
		break;

	case 'login':

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
			require_once "./header.php";
			echo '
				<div class="row justify-content-md-center"><div class="col-md-4">
				<h1 class="display-4">Log In</h1>
				<form method="POST">
					<div class="form-group input-group margin-bottom-sm">
					  <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
					  <input class="form-control" name="name" type="text" placeholder="Name">
					</div>
					<div class="form-group input-group">
					  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
					  <input class="form-control" name="pass" type="password" placeholder="Pass">
					</div>
				<input type="submit" class="btn btn-outline-primary" name="submit" value="Log In">
				<input type="submit" class="btn btn-outline-secondary" name="cancel" value="Cancel">
				</form>
				</div></div>
			';
			require_once "./footer.php";
		break;

	case 'logout': 

		logOut();
		break;

	case 'articles':

		if ( ! $_GET["two"] || $_GET["two"] == "/" ) {

			require_once "./header.php";

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
			$viewsCounter = $article["views"] + 1;
			count_views($viewsCounter,$article["article_id"]);
			
			require_once "./header.php";

			$date = DateTime::createFromFormat('Y-m-d H:i:s', $article["posted"]);
			$date = $date->format('D M, n Y g:i a');
			echo 
				"<h1 class=\"display-4\">" . htmlentities($article["title"]) . "</h1>" . 
				"<p><img src=\"" . DIR_URL_IMG . $article["cover"] . "\" class=\"img-fluid\" alt=\"" . $article["description"] . "\"></p>" . 
				"<p><small>" . $date . " &middot; <i class=\"fas fa-eye fa-sm\"></i> " . $article["views"] . "</small></p>" . 
				"<p>" . nl2br($article["body"]) . "</p>"
			;
			
			$sections = getArticleSections($article["article_id"]);
			if (!empty($sections)) {
				echo "<p>Sections: ";
				foreach ($sections as $section) {
					$sectionArray = getSectionById($section["section_id"]);
					echo "<a href='" . $dir_url . $sectionArray["page"] . "' class='badge badge-pill badge-light'>" . $sectionArray["title"] . "</a> ";
				}
				echo "</p>";
			}
					
			$tags = getArticleTags($article["article_id"]);
			if ( !empty($tags) ) {
				echo "<p>Tags: ";
				foreach ($tags as $tag) {
					$tagArray = getTagById($tag["tag_id"]);
					echo "<a href='" . $dir_url . "tags/" . $tagArray["name"] . "' class='badge badge-pill badge-light'>" . $tagArray["name"] . "</a> ";
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
			echo "<h5>";
			foreach ($tags as $tag) {
				if ( $tag["is_active"] ) {
					echo 
						"<a href=" . $dir_url . 
						htmlentities($page) . "/" . 
						htmlentities($tag["name"]) . " class='badge badge-pill badge-info'>" . 
						htmlentities($tag["name"]) . "</a> "
					;
				}
			}
			echo "</h5>";
		}
		else if ( $_GET["two"] ) {
			$name = htmlentities(ltrim($_GET["two"], '/'));
			echo "<h1 class=\"display-4\">My Articles for tag <i>" . $name . "</i></h1>";
			$tag_id = getTagIdByUrl($name)["tag_id"];
			$articles = getArticlesForTag($tag_id);

			foreach ($articles as $article) {
				
				$articleArr = getArticleById($article["article_id"]);

				if (isset($articleArr["posted"])) {
					
					$date = DateTime::createFromFormat('Y-m-d H:i:s', $articleArr["posted"])->format('M, n Y');

					echo "<p>" . 
						htmlentities($date) . " <a href=" . $dir_url . "articles/" .   
						htmlentities($articleArr["title_url"]) . ">" . 
						htmlentities($articleArr["title"]) . "</a></p>"
					;
				}
			}
		}

		require_once "./footer.php";
		break;

	case 'search':
		require_once "./header.php";
		
		if ( isset($_POST["q"]) ) {
			$searchTerm = htmlentities($_POST["q"]);
			$searchResult = searchArticle($searchTerm);
		} else {
			echo "Try to search something";
		}

		if ( !empty($searchResult) ) {
			echo "<p>Found " . count($searchResult) . " entries:</p>";

			foreach ($searchResult as $result) {
				$date = DateTime::createFromFormat('Y-m-d H:i:s', $result["posted"]);
				$date = $date->format('M, n Y');
				echo 
					htmlentities($date) . " <a href=" . $dir_url . "articles/" .   
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