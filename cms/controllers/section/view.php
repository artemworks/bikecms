<?php

require_once DIR . "models/section.php";
$section = new Section($db);
$sections = $section->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST['section_id']) && isset($_POST['delete'])) {
  header("Location: " . DIR_URL . "cms/section/delete/" . $_POST['section_id']);
  return;
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/section/view.php";
require_once DIR . "views/footer.php";

?>