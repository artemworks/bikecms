<?php

require_once DIR . "models/section.php";
$section = new Section($db);
$sections = $section->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

  if ( isset($_POST["add"]) & 
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

  $section_id = $section->addSection($name, $page, $title, $description, $rank, $is_active);

  if ( !$section_id || empty($section_id) ) 
  {
    $_SESSION["error"] = "Something bad happened";
    header("Location: " . DIR_URL . "cms/section");
    return;
  }
  else 
  {
    $_SESSION["success"] = "Section Added";
    header("Location: " . DIR_URL . "cms/section");
    return;
  }
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/section/add.php";
require_once DIR . "cms/views/footer.php";

?>