<?php
/*
header("Access-Control-Allow-Origin: *"); // change this if you want to restrict access
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/db.php';
include_once '../../objects/purchase.php';

$database = new Database();
$db = $database->getConnection();

$purchase = new Purchase($db);

// get data from a post request
$data = json_decode(file_get_contents("php://input"));

if ( !empty($data) )
{

	$purchase->trans_date;
	$purchase->store;
	$purchase->amount;
	$purchase->tax;
	$purchase->cat_id;
	$purchase->is_active;

	if( $purchase->create() )
	{
	    echo '{' . '"message": "Transaction or purchase was created"' . '}';
	}
	else
	{
		echo '{' . '"message": "Unable to create transaction"' . '}';
	}

}
else
{
	echo '{' . '"message": "Empty inquiry, please send some data"' . '}';
}
*/
?>



