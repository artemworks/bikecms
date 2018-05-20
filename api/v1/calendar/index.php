<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/settings.php';
include_once '../../config/utilities.php';
include_once '../../../models/db.php';
include_once '../../../models/module_calendar.php';

$utilities = new Utilities();

$database = new Database();
$db = $database->getConnection();

$calendar = new Calendar($db);
$stmt = $calendar->readByPage($from_record_num, $obj_per_page);
$num = $stmt->rowCount();

$total_rows = $calendar->count();

if ( $num>0 )
{
	$p_array = array();
	$p_array["events"] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

		extract($row);

		$calendar = array(
			"event_id" => $event_id,
			"event_datetime" => $event_datetime,
			"event_title" => $event_title,
			"event_title_url" => $event_title_url,
			"event_description" => $event_description,
			"event_location" => $event_location,
			"event_link" => $event_link,
			"cat_id" => $cat_id,
			"is_active" => $is_active,
			"pageviews" => $pageviews
			);

		$p_array["events"][] = $calendar;
	}

	$page_url = $home_url . "calendar/?";
	$paging = $utilities->getPages($page, $total_rows, $obj_per_page, $page_url);
	$p_array["paging"] = $paging;

	echo json_encode($p_array);

}
else
{
	echo json_encode(
        array("message" => "No transactions or articles found")
	);
}
?>