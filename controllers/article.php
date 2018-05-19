<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./models/tag.php";
$tag = new Tag($db);

require_once "./models/article.php";
$article = new Article($db);
$article_content = $article->getArticleByUrl(htmlentities(ltrim($action, '/')));

require_once "./include/utilities.php";
$utility = new Utility($db);

require_once "./models/user.php";
$user = new User($db);


if ($article_content)
{
	$sectionsForArticle = $section->getArticleSections($article_content["article_id"]);
	$tagsForArticle = $tag->getArticleTags($article_content["article_id"]);

	$viewsCounter = $article_content["views"] + 1;
	$article->count_views($viewsCounter,$article_content["article_id"]);

	$date = DateTime::createFromFormat('Y-m-d H:i:s', $article_content["posted"])->format('D M d, Y g:i a');

	require_once "./views/header.php";

	require_once "./views/articles/article_content.php";

	require_once "./views/articles/article_relations.php";

	require_once "./views/footer.php";
}
else
{
	$utility->redirect_to( DIR_URL . "404" );
}
?>