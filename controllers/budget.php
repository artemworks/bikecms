<?php

require_once "./models/purchase.php";
		
	$purchase = new Purchase($db);
	$transactions = $purchase->readAll();
	$sum_amount = $purchase->sumAll("amount");
	$sum_tax = $purchase->sumAll("tax");

require_once "./views/header.php";
require_once "./views/section_title.php";
	require_once "./views/budget/index.php";
require_once "./views/footer.php";

?>