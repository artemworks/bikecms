<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./models/article.php";
$article = new Article($db);

require_once "./views/header.php";
		
if ( isset($_POST["q"]) && !empty($_POST["q"]) ) 
{
	$searchTerm = htmlentities($_POST["q"]);
	$searchResult = $article->searchArticle($searchTerm);

	if ( !empty($searchResult) ) 
	{
		
		echo "<p>Found " . count($searchResult) . " entries:</p>";

		foreach ($searchResult as $result) 
		{
			$date = DateTime::createFromFormat('Y-m-d H:i:s', $result["posted"])->format('M, n Y');
			
			echo 
				htmlentities($date) . " <a href=" . DIR_URL . "articles/" .   
				htmlentities($result["title_url"]) . ">" . 
				htmlentities($result["title"]) . "</a><br>"
				;
		}
	}
	else 
	{
		echo "Nothing found. Try another search!";
	}

} 
else 
{
	echo "Paste something into a search field";
}


require_once "./views/footer.php";

?>