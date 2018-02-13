<?php

require_once DIR . "models/article.php";
$article = new Article($db);
$article_content = $article->getArticleById($action_id);

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["delete"]) && 
     isset($_POST["article_id"]) ) 
{
  
  $article_id = htmlentities($_POST["article_id"]);             
  $result = $article->delArticle($article_id);
  
  if ( $result ) 
  {           
    $_SESSION['success'] = "Article deleted";
    header("Location: " . DIR_URL . "cms/article");
  }
  else
  {
    $_SESSION['error'] = "Article not deleted";
    header("Location: " . DIR_URL . "cms/article");    
  }

} 

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/article/delete.php";
require_once DIR . "cms/views/footer.php";

?>