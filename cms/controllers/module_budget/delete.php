<?php

require_once DIR . "models/module_purchase.php";
$purchase = new Purchase($db);
$purchases = $purchase->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["delete"]) &&
       isset($_POST["trans_id"]) ) {

  $trans_id = htmlentities($_POST["trans_id"]);

  $result = $purchase->delTransaction($trans_id);

  if ( $result )
  {
    $_SESSION['success'] = "Transaction deleted";
    header("Location: " . DIR_URL . "cms/module_budget");
  }
  else
  {
    $_SESSION['error'] = "Transaction not deleted";
    header("Location: " . DIR_URL . "cms/module_budget");
  }

}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/module_budget/delete.php";
require_once DIR . "cms/views/footer.php";

?>