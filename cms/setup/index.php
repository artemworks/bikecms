<?php
require_once "../include/pdo.php";
require_once "../include/essentials.php";
require_once "../include/functions.php";
session_start();

$sql = array();

$sql[] = "CREATE TABLE users (
	user_id		INT(11)         NOT NULL AUTO_INCREMENT,
	name		VARCHAR(64)     NOT NULL UNIQUE DEFAULT '',
	pass		VARCHAR(128)    NOT NULL,
	real_name	VARCHAR(255)    NOT NULL DEFAULT '',
	email		VARCHAR(255)    NOT NULL DEFAULT '',
	priv		TINYINT(1)      NOT NULL DEFAULT '0',
	is_active	TINYINT(1)      NOT NULL DEFAULT '1',
	PRIMARY KEY (user_id)
	)";


// Password is a salted hash of 'demo' 
$sql[] = "INSERT INTO users (name, pass, real_name, email, priv, is_active) 
		  VALUES ('demo', '" . hash('md5', $salt.'demo') . "', 'demo', 'demo@demo.demo', 0, 1),
		  		 ('admin', '" . hash('md5', $salt.'demo') . "', 'admin', 'admin@admin.admin', 1, 1)
		  ";

$sql[] = "CREATE TABLE section (
	section_id		INT(11)         NOT NULL AUTO_INCREMENT,
	name			VARCHAR(255)    NOT NULL DEFAULT '',
	page			VARCHAR(255)    NOT NULL DEFAULT '',
	title 			VARCHAR(255)    NOT NULL DEFAULT '',
	description		VARCHAR(255)    NOT NULL DEFAULT '',
	rank			VARCHAR(64)     NOT NULL DEFAULT '',
	is_active 		TINYINT(1)      NOT NULL DEFAULT '0',
	PRIMARY KEY (section_id)
	)";

$sql[] = "INSERT INTO section (name, page, title, description, rank, is_active) 
		  VALUES ('articles', 'articles', 'Articles', 'Very interesting articles', 1, 1),
		  		 ('tags', 'tags', 'Tags', 'Tags the way they are', 2, 1),
		  		 ('about', 'about', 'About us', 'Short description of text about us', 3, 1)";

$sql[] = "CREATE TABLE tag (
	tag_id		INT(11)         NOT NULL AUTO_INCREMENT,
	name		VARCHAR(64)     NOT NULL DEFAULT '',
	is_active 	TINYINT(1)      NOT NULL DEFAULT '1',
	PRIMARY KEY (tag_id)
	)";

$sql[] = "INSERT INTO tag (name, is_active) VALUES ('thoughts', 1), ('reality', 1), ('weather', 1)";

$sql[] = "CREATE TABLE article (
	article_id	INT(11)         NOT NULL AUTO_INCREMENT,
	posted 		DATETIME        NOT NULL,
	archiving 	DATETIME        NULL DEFAULT NULL,
	title 		VARCHAR(255)    NOT NULL DEFAULT '',
	title_url 	VARCHAR(255)    NOT NULL DEFAULT '',
	description	VARCHAR(255)    NOT NULL DEFAULT '',
	body 		MEDIUMTEXT      NOT NULL,
	user_id 	INT(11)         NOT NULL,
	is_active 	TINYINT(1)      NOT NULL DEFAULT '0',
	PRIMARY KEY (article_id),
	FOREIGN KEY (user_id) REFERENCES users (user_id)
	)";

$sql[] = "INSERT INTO article (posted, archiving, title, title_url, description, body, user_id, is_active) 
		  VALUES ('2017-12-01 10:59:32', '2017-12-02 10:59:32', 'My first article', 'my-first-article', 
		  	'Hello world, this is my first article', 
		  	'Hello world, this is my first article. Congratulations!', 
		  	1, 1)";

$sql[] = "CREATE TABLE tags (
	article_id	INT(11)         NOT NULL,
	tag_id 		INT(11)         NOT NULL,
	rank		VARCHAR(64)     NOT NULL,
	FOREIGN KEY (article_id) REFERENCES article (article_id),
	FOREIGN KEY (tag_id) REFERENCES tag (tag_id)
	)";

$sql[] = "INSERT INTO tags (article_id, tag_id, rank) VALUES (1, 1, 3), (1 , 2, 2), (1 , 3, 2)";

$sql[] = "CREATE TABLE sections (
	article_id	INT(11)         NOT NULL,
	section_id 	INT(11)         NOT NULL,
	rank		VARCHAR(64)     NOT NULL,
	FOREIGN KEY (article_id) REFERENCES article (article_id),
	FOREIGN KEY (section_id) REFERENCES section (section_id)
	)";

$sql[] = "INSERT INTO sections (article_id, section_id, rank) VALUES (1, 1, 3)";

/*
echo "<pre>";
print_r($stmt);
echo "<pre>";
*/

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