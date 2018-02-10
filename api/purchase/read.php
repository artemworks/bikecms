<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/settings.php';
include_once '../shared/utilities.php';
include_once '../config/db.php';
include_once '../objects/purchase.php';

$utilities = new Utilities();

$database = new Database();
$db = $database->getConnection();

$purchase = new Purchase($db);
$stmt = $purchase->readByPage($from_record_num, $obj_per_page);
$num = $stmt->rowCount();

$total_rows = $purchase->count();

if ( $num>0 )
{
	$p_array = array();
	$p_array["purchases"] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		
		extract($row);

		$purchase = array(
			"trans_id" => $trans_id,
			"trans_date" => $trans_date,
			"store" => $store,
			"amount" => $amount,
			"tax" => $tax,
			"cat_id" => $cat_id,
			"is_active" => $is_active
			);

		$p_array["purchases"][] = $purchase;
	}

	$page_url = $home_url . "purchase/read.php?";
	$paging = $utilities->getPages($page, $total_rows, $obj_per_page, $page_url);
	$p_array["paging"] = $paging;

	echo json_encode($p_array);

}
else 
{
	echo json_encode(
        array("message" => "No transactions or purchases found")
	);
}
?>