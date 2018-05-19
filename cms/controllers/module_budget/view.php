<?php

require_once DIR . "models/module_purchase.php";
$purchase = new Purchase($db);
$transactions = $purchase->readSortedByDate();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST['trans_id']) && isset($_POST['delete'])) {
  header("Location: " . DIR_URL . "cms/module_budget/delete/" . $_POST['trans_id']);
  return;
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/module_budget/view.php";
require_once DIR . "views/footer.php";

?>