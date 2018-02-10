<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/db.php';
include_once '../objects/purchase.php';

$database = new Database();
$db = $database->getConnection();

$purchase = new Purchase($db);
$stmt = $purchase->read();
$num = $stmt->rowCount();

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

	echo json_encode($p_array);

}
else 
{
	echo json_encode(
        array("message" => "No transactions or purchases found")
	);
}
?>