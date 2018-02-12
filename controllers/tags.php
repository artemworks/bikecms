<?php

		require_once "./views/header.php";

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

		require_once "./views/footer.php";

?>