<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./models/module_purchase.php";
$purchase = new Purchase($db);
$transactions = $purchase->readSortedByDate();
$sum_amount = $purchase->sumAll("amount");
$sum_tax = $purchase->sumAll("tax");

require_once "./views/header.php";
require_once "./views/section_title.php";
require_once "./views/budget/index.php";
require_once "./views/footer.php";

?>