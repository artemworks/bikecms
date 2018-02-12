<?php

//change this
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bikecms;charset=utf8', 'bikecms', 'bikecms');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();

$sql = array();

$sql[] = "CREATE TABLE b_transactions (
	trans_id		INT(11)     	NOT NULL AUTO_INCREMENT,
	trans_date 		DATETIME        NOT NULL,
	store			VARCHAR(255)    NOT NULL DEFAULT '',
	amount			FLOAT           NOT NULL DEFAULT '0.00',
	tax				FLOAT           NOT NULL DEFAULT '0.00',
	cat_id		    VARCHAR(128)    NOT NULL,
	is_active		TINYINT(1)      NOT NULL DEFAULT '1',
	PRIMARY KEY (trans_id)
	)";

$sql[] = "INSERT INTO b_transactions (trans_date, store, amount, tax, cat_id, is_active) 
				 			VALUES ('2018-01-31 16:42:13', 'Loblaws', 114.76, 3.95, 1, 1)";

$sql[] = "CREATE TABLE b_categories (
	cat_id		INT(11)     	NOT NULL AUTO_INCREMENT,
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
				 				   ('Unexpected', 1)";

$_SESSION['success_count'] = 0;
$_SESSION['error_count'] = 0;

foreach ($sql as $query) {
	$stmt = $pdo->query($query);

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