<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

if (!$action || $action == "/") {
  $monthNum = date("m");
  $monthStr = date("M");
  $year = date("Y");
} else {
  $date = htmlentities(ltrim($action, '/'));
  $monthNum = explode("-", $date)[0];
  $monthStr = DateTime::createFromFormat('m', $monthNum)->format('F');
  $year = explode("-", $date)[1];
}

require_once "./models/module_purchase.php";
$purchase = new Purchase($db);
$transactions = $purchase->readSortedByMonthYear($monthNum, $year);
$sum_amount = $purchase->sumAllInMonthYear("amount", $monthNum, $year);
$sum_tax = $purchase->sumAllInMonthYear("tax", $monthNum, $year);
$m_list = $purchase->getAllMonthAndYear();

require_once "./models/module_purchase_category.php";
$purchase_cat = new PurchaseCategory($db);

require_once "./models/module_budget_chart.php";
$chart = new Chart($db);
$pie1 = $chart->pieChartDataByStore($monthNum, $year);
$pie2 = $chart->pieChartDataByCategory($monthNum, $year);

require_once "./views/header.php";
require_once "./views/section_title.php";
require_once "./views/budget/index.php";
require_once "./views/footer.php";

?>