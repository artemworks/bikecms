<?php

require_once DIR . "models/tag.php";
$tag = new Tag($db);
$tags = $tag->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["delete"]) && 
     isset($_POST["tag_id"]) ) {

  $tag_id = htmlentities($_POST["tag_id"]);
  
  $result = $tag->delTag($tag_id);
  
  if ( $result ) 
  {           
    $_SESSION['success'] = "Tag deleted";
    header("Location: " . DIR_URL . "cms/tag");
  }
  else
  {
    $_SESSION['error'] = "Tag not deleted";
    header("Location: " . DIR_URL . "cms/tag");    
  }

} 

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/tag/delete.php";
require_once DIR . "cms/views/footer.php";

?>