<?php

require_once DIR . "models/purchase.php";
$purchase = new Purchase($db);
$purchases = $purchase->readAll();

require_once DIR . "models/purchase_category.php";
$cat = new PurchaseCategory($db);

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
  $purchase_id = $purchase->addTag($name, $is_active);

  if ( !$purchase_id || empty($purchase_id) ) 
  {
    $_SESSION["error"] = "Something bad happened";
    header("Location: " . DIR_URL . "cms/purchase");
    return;
  }
  else 
  {
    $_SESSION["success"] = "Tag Added";
    header("Location: " . DIR_URL . "cms/purchase");
    return;
  }
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/budget_app/add.php";
require_once DIR . "cms/views/footer.php";

?>