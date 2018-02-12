<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./models/article.php";

$article = new Article($db);
$articles = $article->readAll();

require_once "./views/header.php";
require_once "./views/articles/articles_list.php";
require_once "./views/footer.php";
?>