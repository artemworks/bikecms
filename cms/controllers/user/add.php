<?php

require_once DIR . "models/user.php";
$user = new User($db);
$users = $user->readAll();

require_once DIR . "include/utilities.php";
$utility = new Utility($db);

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["add"]) & 
       isset($_POST["name"]) && isset($_POST["pass"]) && 
       isset($_POST["real_name"]) && isset($_POST["email"]) &&
       isset($_POST["priv"]) && isset($_POST["is_active"]) ) {

    $pass = $utility->password_encrypt($_POST['pass']);

    $username = htmlentities($_POST['name']);
    $realname = htmlentities($_POST['real_name']);
    $email = htmlentities($_POST['email']);
    $priv = htmlentities($_POST['priv']);
    $is_active = htmlentities($_POST['is_active']);
    $country = htmlentities($_POST['country']);
    $city = htmlentities($_POST['city']);

    $user_id = $user->addUser($username, $pass, $realname, $email, $priv, $is_active, $country, $city);

    if ( !$user_id || empty($user_id) ) 
    {
      $_SESSION["error"] = "Something bad happened";
      header("Location: " . DIR_URL . "cms/user");
      return;
    }
    else 
    {
      $_SESSION["success"] = "User Added";
      header("Location: " . DIR_URL . "cms/user");
      return;
    }
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/user/add.php";
require_once DIR . "cms/views/footer.php";

?>