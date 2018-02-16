<?php

require_once DIR . "models/purchase.php";
$purchase = new Purchase($db);
$purchases = $purchase->readAll();

require_once DIR . "models/purchase_category.php";
$cat = new PurchaseCategory($db);
$cats = $cat->readAll();

if ( isset($_POST['cancel']) ) 
{
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["edit"]) && isset($_POST["trans_date"]) &&
               isset($_POST["store"]) && isset($_POST["amount"]) &&
               isset($_POST["tax"]) && isset($_POST["cat_id"]) &&
               isset($_POST["is_active"]) ) 
{
  $trans_date = htmlentities($_POST["trans_date"]); 
  $store = htmlentities($_POST["store"]); 
  $amount = htmlentities($_POST["amount"]); 
  $tax = htmlentities($_POST["tax"]); 
  $cat_id = htmlentities($_POST["cat_id"]); 
  $is_active = htmlentities($_POST["is_active"]);

  $result = $purchase->updateTransaction($trans_date, $store, $amount, $tax, $cat_id, $is_active, $action_id);

  if ( $result ) 
  {           
    $_SESSION['success'] = "Transaction updated";
    header("Location: " . DIR_URL . "cms/budget_app");
  }
  else
  {
    $_SESSION['error'] = "Transaction not updated";
    header("Location: " . DIR_URL . "cms/budget_app");    
  }
 
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/budget_app/edit.php";
require_once DIR . "cms/views/footer.php";

?>