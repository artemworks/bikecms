<?php

require_once DIR . "models/purchase.php";
$purchase = new Purchase($db);
$transactions = $purchase->readAll();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST['purchase_id']) && isset($_POST['delete'])) {
  header("Location: " . DIR_URL . "cms/purchase/delete/" . $_POST['purchase_id']);
  return;
}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/budget_app/view.php";
require_once DIR . "views/footer.php";

?>