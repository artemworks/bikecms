<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

$monthNum = date("m");
$monthStr = date("M");

require_once "./models/module_purchase.php";
$purchase = new Purchase($db);
$transactions = $purchase->readSortedByMonth($monthNum);
$sum_amount = $purchase->sumAllInMonth("amount", $monthNum);
$sum_tax = $purchase->sumAllInMonth("tax", $monthNum);

require_once "./models/module_budget_chart.php";
$chart = new Chart($db);
$pie1 = $chart->pieChartDataByStore();
$pie2 = $chart->pieChartDataByCategory();

require_once "./views/header.php";
require_once "./views/section_title.php";
require_once "./views/budget/index.php";
require_once "./views/footer.php";

?>