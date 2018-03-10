<?php

require_once DIR . "models/article.php";
$article = new Article($db);
$articleContent = $article->getArticleById($action_id);

require_once DIR . "models/tag.php";
$tag = new Tag($db);

require_once DIR . "models/section.php";
$section = new Section($db);

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["edit"]) && 
    isset($_POST["posted"]) && isset($_POST["archiving"]) &&
    isset($_POST["title"]) && isset($_POST["title_url"]) &&
    isset($_POST["description"]) && isset($_POST["body"]) &&
    isset($_POST["user_id"]) && isset($_POST["is_active"]) && 
    isset($_POST["views"]) ) 
{
    
    if ( isset($_FILES["cover_image"]) && !empty($_FILES["cover_image"]["name"]) && !$_FILES["cover_image"]['error'] ) 
    {
      $coverImage = $_FILES["cover_image"]["name"];
      $coverPath = DIR_IMG . basename($_FILES["cover_image"]["name"]);
      move_uploaded_file($_FILES["cover_image"]["tmp_name"], $coverPath);
    } 
    else 
    {
      $coverImage = $_POST["cover_image"];
    }


    $posted = $_POST["posted"];
    $archiving = $_POST["archiving"]; 
    $title = $_POST["title"]; 
    $title_url = $_POST["title_url"]; 
    $description = $_POST["description"]; 
    $body = $_POST["body"]; 
    $cover = $coverImage;
    $user_id = $_POST["user_id"]; 
    $is_active = $_POST["is_active"];
    $views = $_POST["views"];


    // clining old section entries
    $section->delSections($action_id);
    $section->insertSections($action_id);
    $tag->delTags($action_id);
    $tag->insertTags($action_id);


  $result = $article->updateArticle($posted, $archiving, $title, $title_url, $description, $body, $cover, $user_id, $is_active, $views, $action_id);

  if ( $result ) 
  {           
    $_SESSION['success'] = "Article updated";
    header("Location: " . DIR_URL . "cms/article");
  }
  else
  {
    $_SESSION['error'] = "Article not updated";
    header("Location: " . DIR_URL . "cms/article");    
  }

}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/article/edit.php";
require_once DIR . "cms/views/footer.php";

?>