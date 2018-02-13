<?php

require_once DIR . "models/tag.php";
$tag = new Tag($db);
$tags = $tag->readAll();

if ( isset($_POST['cancel']) ) 
{
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["edit"]) && 
     isset($_POST["name"]) && isset($_POST["is_active"]) ) 
{
  $name = htmlentities($_POST["name"]);
  $is_active = htmlentities($_POST["is_active"]);

  $result = $tag->updateTag($name, $is_active, $action_id);

  if ( $result ) 
  {           
    $_SESSION['success'] = "Tag updated";
    header("Location: " . DIR_URL . "cms/tag");
  }
  else
  {
    $_SESSION['error'] = "Tag not updated";
    header("Location: " . DIR_URL . "cms/tag");    
  }
 
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/tag/edit.php";
require_once DIR . "cms/views/footer.php";

?>