<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/settings.php';
include_once '../../shared/utilities.php';
include_once '../../config/db.php';
include_once '../../objects/article.php';

$utilities = new Utilities();

$database = new Database();
$db = $database->getConnection();

$article = new Article($db);
$stmt = $article->readByPage($from_record_num, $obj_per_page);
$num = $stmt->rowCount();

$total_rows = $article->count();

if ( $num>0 )
{
	$p_array = array();
	$p_array["articles"] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		
		extract($row);

		$article = array(
			"article_id" => $article_id,
			"posted" => $posted,
			"archiving" => $archiving,
			"title" => $title,
			"title_url" => $title_url,
			"description" => $description,
			"body" => $body,
			"cover" => $cover,
			"user_id" => $user_id,
			"is_active" => $is_active,
			"views" => $views
			);

		$p_array["articles"][] = $article;
	}

	$page_url = $home_url . "article/read.php?";
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