<?php

require_once "./models/article.php";

$article = new Article($db);
$article_content = $article->getArticleByUrl(htmlentities(ltrim($nested, '/')));

if ($article_content)
{
	$sections = getArticleSections($article_content["article_id"]);
	$tags = getArticleTags($article_content["article_id"]);

	$viewsCounter = $article_content["views"] + 1;
	$article->count_views($viewsCounter,$article_content["article_id"]);
				
	$date = DateTime::createFromFormat('Y-m-d H:i:s', $article_content["posted"])->format('D M, n Y g:i a');

	require_once "./views/header.php";

	require_once "./views/articles/article_content.php";

				if (!empty($sections)) {
					echo "<p>Sections: ";
					foreach ($sections as $section) {
						$sectionArray = getSectionById($section["section_id"]);
						echo "<a href='" . $dir_url . $sectionArray["page"] . "' class='badge badge-pill badge-light'>" . $sectionArray["title"] . "</a> ";
					}
					echo "</p>";
				}
						
				
				if ( !empty($tags) ) {
					echo "<p>Tags: ";
					foreach ($tags as $tag) {
						$tagArray = getTagById($tag["tag_id"]);
						echo "<a href='" . $dir_url . "tags/" . $tagArray["name"] . "' class='badge badge-pill badge-light'>" . $tagArray["name"] . "</a> ";
					}
					echo "</p>";
				}

	require_once "./views/footer.php";
}
else 
{
	redirect_to( DIR_URL . "404" );
}
?>