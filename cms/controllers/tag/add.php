<?php

require_once DIR . "models/tag.php";
$tag = new Tag($db);
$tags = $tag->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["add"]) & 
     isset($_POST["name"]) && isset($_POST["is_active"]) ) 
{

  $name = htmlentities($_POST["name"]);
  $is_active = htmlentities($_POST["is_active"]);
  $tag_id = $tag->addTag($name, $is_active);

  if ( !$tag_id || empty($tag_id) ) 
  {
    $_SESSION["error"] = "Something bad happened";
    header("Location: " . DIR_URL . "cms/tag");
    return;
  }
  else 
  {
    $_SESSION["success"] = "Tag Added";
    header("Location: " . DIR_URL . "cms/tag");
    return;
  }
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/tag/add.php";
require_once DIR . "cms/views/footer.php";

?>