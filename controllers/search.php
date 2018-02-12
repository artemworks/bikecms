<?php

		require_once "./views/header.php";
		
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
		require_once "./views/footer.php";

?>