<?php

require_once DIR . "models/module_purchase.php";
$purchase = new Purchase($db);
$purchases = $purchase->readAll();

require_once DIR . "models/module_purchase_category.php";
$cat = new PurchaseCategory($db);

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

  if ( isset($_POST["add"]) &&
       isset($_POST["trans_date"]) && isset($_POST["store"]) &&
       isset($_POST["amount"]) && isset($_POST["tax"]) &&
       isset($_POST["cat_id"]) && isset($_POST["is_active"]) ) {

  $trans_date = htmlentities($_POST["trans_date"]);
  $store = htmlentities($_POST["store"]);
  $amount = htmlentities($_POST["amount"]);
  $tax = htmlentities($_POST["tax"]);
  $cat_id = htmlentities($_POST["cat_id"]);
  $is_active = htmlentities($_POST["is_active"]);

  $purchase_id = $purchase->addTransaction($trans_date, $store, $amount, $tax, $cat_id, $is_active);

  if ( !$purchase_id || empty($purchase_id) )
  {
    $_SESSION["error"] = "Something bad happened";
    header("Location: " . DIR_URL . "cms/module_budget");
    return;
  }
  else
  {
    $_SESSION["success"] = "Transaction Added";
    header("Location: " . DIR_URL . "cms/module_budget");
    return;
  }
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/module_budget/add.php";
require_once DIR . "cms/views/footer.php";

?>