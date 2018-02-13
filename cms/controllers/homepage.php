<?php

require_once DIR . "/models/article.php";
$article = new Article($db);
$articles = $article->readAll();

require_once DIR . "/models/tag.php";
$tag = new tag($db);
$tags = $tag->readAll();

require_once DIR . "/models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once DIR . "/models/purchase.php";
$purchase = new Purchase($db);
$purchases = $purchase->readAll();

$users = $user->readAll();

require_once "./views/header.php";
require_once "./views/homepage.php";
require_once DIR . "/views/footer.php";

?>