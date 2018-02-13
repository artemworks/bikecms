<?php

require_once DIR . "models/section.php";
$section = new Section($db);
$sections = $section->readAll();

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

  $result = $section->updateTag($name, $is_active, $action_id);

  if ( $result ) 
  {           
    $_SESSION['success'] = "Tag updated";
    header("Location: " . DIR_URL . "cms/section");
  }
  else
  {
    $_SESSION['error'] = "Tag not updated";
    header("Location: " . DIR_URL . "cms/section");    
  }
 
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/section/edit.php";
require_once DIR . "cms/views/footer.php";

?>