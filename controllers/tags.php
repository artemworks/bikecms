<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./models/tag.php";
$tag = new Tag($db);
$tags = $tag->readAll();

require_once "./views/header.php";

if ( ! $action || $action == "/" ) 
{
	echo "<h1 class=\"display-4\">My Tags</h1>";
	echo "<h5>";

	foreach ($tags as $tag) 
	{
		if ( $tag["is_active"] ) 
		{
			echo 
				"<a href=" . DIR_URL . 
				htmlentities($controller) . "/" . 
				htmlentities($tag["name"]) . " class='badge badge-pill badge-info'>" . 
				htmlentities($tag["name"]) . "</a> "
				;
		}
	}

	echo "</h5>";

}
else if ( $action ) 
{
	$name = htmlentities(ltrim($action, '/'));
	
	$tag_id = $tag->getTagIdByUrl($name)["tag_id"];
	
	$articles = $tag->getArticlesForTag($tag_id);

	require_once "./views/articles/articles_list.php";
	
}

require_once "./views/footer.php";

?>