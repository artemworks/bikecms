<?php

require_once DIR . "models/article.php";
$article = new Article($db);
$articlesSorted = $article->getArticlesSortedIdDesc();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST['article_id']) && isset($_POST['delete'])) {
    header("Location: " . DIR_URL . "cms/article/delete/" . $_POST['article_id']);
    return;
}

  require_once DIR . "cms/views/header.php";
  require_once DIR . "cms/views/article/view.php";
  require_once DIR . "views/footer.php";

?>