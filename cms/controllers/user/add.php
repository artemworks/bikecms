<?php

require_once DIR . "models/user.php";
$user = new User($db);
$users = $user->readAll();

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
  $user_id = $user->addTag($name, $is_active);

  if ( !$user_id || empty($user_id) ) 
  {
    $_SESSION["error"] = "Something bad happened";
    header("Location: " . DIR_URL . "cms/user");
    return;
  }
  else 
  {
    $_SESSION["success"] = "Tag Added";
    header("Location: " . DIR_URL . "cms/user");
    return;
  }
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/user/add.php";
require_once DIR . "cms/views/footer.php";

?>