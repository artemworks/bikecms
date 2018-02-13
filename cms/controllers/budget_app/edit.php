<?php

require_once DIR . "models/purchase.php";
$purchase = new Purchase($db);
$purchases = $purchase->readAll();

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

  $result = $purchase->updateTag($name, $is_active, $action_id);

  if ( $result ) 
  {           
    $_SESSION['success'] = "Tag updated";
    header("Location: " . DIR_URL . "cms/purchase");
  }
  else
  {
    $_SESSION['error'] = "Tag not updated";
    header("Location: " . DIR_URL . "cms/purchase");    
  }
 
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/budget_app/edit.php";
require_once DIR . "cms/views/footer.php";

?>