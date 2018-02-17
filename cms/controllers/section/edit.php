<?php

require_once DIR . "models/section.php";
$section = new Section($db);
$sections = $section->readAll();
$sectionContent = $section->getSectionById($action_id);

if ( isset($_POST['cancel']) ) 
{
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["edit"]) && 
               isset($_POST["name"]) && isset($_POST["page"]) &&
               isset($_POST["title"]) && isset($_POST["description"]) &&
               isset($_POST["rank"]) && isset($_POST["is_active"]) ) 
{
  $name = htmlentities($_POST["name"]);
  $page = htmlentities($_POST["page"]);
  $title = htmlentities($_POST["title"]);
  $description = htmlentities($_POST["description"]);
  $rank = htmlentities($_POST["rank"]);
  $is_active = htmlentities($_POST["is_active"]);

  $result = $section->updateSection($name, $page, $title, $description, $rank, $is_active, $action_id);

  if ( $result ) 
  {           
    $_SESSION['success'] = "Section updated";
    header("Location: " . DIR_URL . "cms/section");
  }
  else
  {
    $_SESSION['error'] = "Section not updated";
    header("Location: " . DIR_URL . "cms/section");    
  }
 
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/section/edit.php";
require_once DIR . "cms/views/footer.php";

?>