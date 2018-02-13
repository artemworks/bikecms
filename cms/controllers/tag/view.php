<?php

require_once DIR . "models/tag.php";
$tag = new Tag($db);
$tags = $tag->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST['tag_id']) && isset($_POST['delete'])) {
  header("Location: " . DIR_URL . "cms/tag/delete/" . $_POST['tag_id']);
  return;
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/tag/view.php";
require_once DIR . "views/footer.php";

?>