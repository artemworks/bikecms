<?php

require_once DIR . "models/user.php";
$user = new User($db);
$users = $user->readAll();
$userContent = $user->getUserById($action_id);

require_once DIR . "include/utilities.php";
$utility = new Utility($db);

if ( isset($_POST['cancel']) ) 
{
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["edit"]) && 
    isset($_POST["name"]) && isset($_POST["pass"]) && 
    isset($_POST["real_name"]) && isset($_POST["email"]) &&
    isset($_POST["priv"]) && isset($_POST["is_active"]) &&
    isset($_POST["country"]) && isset($_POST["city"]) )
{

  if ( !empty($_POST["pass"]) )
  {
    $name = htmlentities($_POST['name']);
    $pass = $utility->password_encrypt($_POST['pass']);
    $real_name = htmlentities($_POST['real_name']);
    $email = htmlentities($_POST['email']);
    $priv = htmlentities($_POST['priv']);
    $is_active = htmlentities($_POST['is_active']);
    $country = htmlentities($_POST['country']);
    $city = htmlentities($_POST['city']);

    $result = $user->updateUser($name, $pass, $real_name, $email, $priv, $is_active, $country, $city, $action_id);

    if ( $result ) 
    {           
      $_SESSION['success'] = "User updated";
      header("Location: " . DIR_URL . "cms/user");
    }
    else
    {
      $_SESSION['error'] = "User not updated";
      header("Location: " . DIR_URL . "cms/user");    
    }
  
  } 
  else
  {
    $_SESSION['error'] = "Error: Password is empty";
    header("Location: " . DIR_URL . "cms/user"); 
  }

 
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/user/edit.php";
require_once DIR . "cms/views/footer.php";

?>