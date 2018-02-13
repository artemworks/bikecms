<?php

require_once DIR . "models/purchase.php";
$purchase = new Purchase($db);
$purchases = $purchase->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["delete"]) && 
     isset($_POST["purchase_id"]) ) {

  $purchase_id = htmlentities($_POST["purchase_id"]);
  
  $result = $purchase->delTag($purchase_id);
  
  if ( $result ) 
  {           
    $_SESSION['success'] = "Tag deleted";
    header("Location: " . DIR_URL . "cms/purchase");
  }
  else
  {
    $_SESSION['error'] = "Tag not deleted";
    header("Location: " . DIR_URL . "cms/purchase");    
  }

} 

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/budget_app/delete.php";
require_once DIR . "cms/views/footer.php";

?>