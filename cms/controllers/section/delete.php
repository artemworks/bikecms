<?php

require_once DIR . "models/section.php";
$section = new Section($db);
$sections = $section->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["delete"]) && 
     isset($_POST["section_id"]) ) {

  $section_id = htmlentities($_POST["section_id"]);
  
  $result = $section->delTag($section_id);
  
  if ( $result ) 
  {           
    $_SESSION['success'] = "Tag deleted";
    header("Location: " . DIR_URL . "cms/section");
  }
  else
  {
    $_SESSION['error'] = "Tag not deleted";
    header("Location: " . DIR_URL . "cms/section");    
  }

} 

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/section/delete.php";
require_once DIR . "cms/views/footer.php";

?>