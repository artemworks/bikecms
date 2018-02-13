<?php

require_once DIR . "models/user.php";
$user = new User($db);
$users = $user->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST['user_id']) && isset($_POST['delete'])) {
  header("Location: " . DIR_URL . "cms/user/delete/" . $_POST['user_id']);
  return;
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/user/view.php";
require_once DIR . "views/footer.php";

?>