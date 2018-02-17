<?php

require_once DIR . "models/article.php";
$article = new Article($db);

require_once DIR . "models/tag.php";
$tag = new Tag($db);

require_once DIR . "models/section.php";
$section = new Section($db);

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["add"]) && 
       isset($_FILES["cover_image"]) && !empty($_FILES["cover_image"]["name"]) && 
       isset($_POST["posted"]) && isset($_POST["archiving"]) &&
       isset($_POST["title"]) && isset($_POST["title_url"]) &&
       isset($_POST["description"]) && isset($_POST["body"]) &&
       isset($_POST["user_id"]) && isset($_POST["is_active"]) ) 
{

      $posted = $_POST["posted"];
      $archiving = $_POST["archiving"]; 
      $title = $_POST["title"]; 
      $title_url = $_POST["title_url"]; 
      $description = $_POST["description"]; 
      $body = $_POST["body"]; 
      $cover = $_FILES["cover_image"]["name"];
      $user_id = $_POST["user_id"]; 
      $is_active = $_POST["is_active"];

      $coverPath = DIR_IMG . basename($_FILES["cover_image"]["name"]);
      move_uploaded_file($_FILES["cover_image"]["tmp_name"], $coverPath);

      $article_id = $article->addArticle($posted, $archiving, $title, $title_url, $description, $body, $cover, $user_id, $is_active);

      $section->insertSections($article_id);
      $tag->insertTags($article_id);

      if ( !$article_id || empty($article_id) ) 
      {
        $_SESSION["error"] = "Something bad happened";
        header("Location: " . DIR_URL . "cms/article");
        return;
      } else 
      {
        $_SESSION["success"] = "Article Added";
        header("Location: " . DIR_URL . "cms/article");
        return;
      }


  }

  require_once DIR . "cms/views/header.php";
  require_once DIR . "cms/views/article/add.php";
  require_once DIR . "cms/views/footer.php";

?>