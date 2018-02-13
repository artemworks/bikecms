<?php

require_once DIR . "models/user.php";
$user = new User($db);
$users = $user->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["delete"]) && 
     isset($_POST["user_id"]) ) {

  $user_id = htmlentities($_POST["user_id"]);
  
  $result = $user->delTag($user_id);
  
  if ( $result ) 
  {           
    $_SESSION['success'] = "Tag deleted";
    header("Location: " . DIR_URL . "cms/user");
  }
  else
  {
    $_SESSION['error'] = "Tag not deleted";
    header("Location: " . DIR_URL . "cms/user");    
  }

} 

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/user/delete.php";
require_once DIR . "cms/views/footer.php";

?>