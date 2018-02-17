<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./models/article.php";
$article = new Article($db);
$lastArticles = $article->getLastArticles(NUM_HOMEPAGE);

require_once "./views/homepage/header_cards.php";

require_once "./views/footer.php";

?>