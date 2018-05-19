<?php
session_start();

require_once "../models/db.php";
$database = new Database();
$db = $database->getConnection();

$sql = array();

$sql[] = "CREATE TABLE b_transactions (
	trans_id			INT(11)     		NOT NULL AUTO_INCREMENT,
	trans_date 		DATETIME        NOT NULL,
	dropbox_url		VARCHAR(255)    NOT NULL DEFAULT '',
	store					VARCHAR(255)    NOT NULL DEFAULT '',
	amount				FLOAT           NOT NULL DEFAULT '0.00',
	tax						FLOAT           NOT NULL DEFAULT '0.00',
	cat_id		   	VARCHAR(128)    NOT NULL,
	is_active			TINYINT(1)      NOT NULL DEFAULT '1',
	PRIMARY KEY (trans_id)
	)";

$sql[] = "INSERT INTO b_transactions (trans_date, dropbox_url, store, amount, tax, cat_id, is_active)
				 			VALUES ('2018-01-31 16:42:13', 'https://www.dropbox.com', 'Loblaws', 114.76, 3.95, 1, 1)";

$sql[] = "CREATE TABLE b_categories (
	cat_id		INT(11)     		NOT NULL AUTO_INCREMENT,
	cat_title	VARCHAR(255)    NOT NULL DEFAULT '',
	is_active	TINYINT(1)      NOT NULL DEFAULT '1',
	PRIMARY KEY (cat_id)
	)";

$sql[] = "INSERT INTO b_categories (cat_title, is_active)
				 			VALUES ('Food and Groceries', 1),
				 			       ('Transportation', 1),
				 				   	('Clothing', 1),
				 				   	('Utilities', 1),
				 				   	('Personal Care', 1),
				 				   	('Health Care', 1),
				 				   	('Insurance', 1),
				 				   	('Banking', 1),
				 				   	('Medical', 1),
				 				   	('Housing', 1),
				 				   	('Entertainment', 1),
				 				   	('Gifts', 1),
				 				   	('Child Care', 1),
				 				   	('Unexpected', 1)";

/*
		We need to add Calendar to the list of available sections
*/

$sql[] = "INSERT INTO section (name, page, title, description, rank, is_active)
		  VALUES ('budget', 'budget', 'Budget', 'List of expenses', 5, 1)";



$_SESSION['success_count'] = 0;
$_SESSION['error_count'] = 0;

foreach ($sql as $query) {
	$stmt = $db->prepare($query);
	$stmt->execute();

	if(!$stmt) {
		$_SESSION['error_count']++;
		$_SESSION['error_details'] = $pdo->errorInfo();

	} else {
		$_SESSION['success_count']++;
	}
}

echo "Executed " . $_SESSION['success_count'] . " queries with " . $_SESSION['error_count'] . " errors.";

isset($_SESSION['error_details']) ? print_r($_SESSION['error_details']) : false;

session_destroy();

?>