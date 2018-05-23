<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

$today = date('Y-m-d');

require_once "./models/article.php";
$article = new Article($db);
$articles_td = $article->getArticlesByDate($today);

require_once "./models/module_calendar.php";
$event = new Calendar($db);
$events_td = $event->getEventsByDate($today);

require_once "./models/module_purchase.php";
$trans = new Purchase($db);
$trans_td = $trans->getPurchasesByDate($today);

require_once "./views/header.php";
require_once "./views/day/day.php";
require_once "./views/footer.php";

?>