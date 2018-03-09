<?php
session_start();

require_once "../models/db.php";
$database = new Database();
$db = $database->getConnection();

$sql = array();

$sql[] = "CREATE TABLE users (
	user_id		INT(11)         NOT NULL AUTO_INCREMENT,
	name		VARCHAR(64)     NOT NULL UNIQUE DEFAULT '',
	pass		VARCHAR(128)    NOT NULL,
	real_name	VARCHAR(255)    NOT NULL DEFAULT '',
	email		VARCHAR(255)    NOT NULL DEFAULT '',
	country		VARCHAR(255)    NOT NULL DEFAULT '',
	city		VARCHAR(255)    NOT NULL DEFAULT '',
	priv		TINYINT(1)      NOT NULL DEFAULT '0',
	is_active	TINYINT(1)      NOT NULL DEFAULT '1',
	PRIMARY KEY (user_id)
	)";


// Password is a salted hash of 'demo' 
$sql[] = "INSERT INTO users (name, pass, real_name, email, country, city, priv, is_active) 
		  VALUES ('demo', '". '$2y$10$OTQyZGY0MjE4YmVmZDlhYOd1uccGh/q.qUFGcrD5.BgyJwV9jtw22' . "', 'demo', 'demo@demo.demo', 'Canada', 'Toronto', 0, 1),
		  		 ('admin', '". '$2y$10$MjZlOTQ5MDI0OWJkMTAyZOHz0YNwcAns6sJYD7HFNHC7N91WzwS.G' . "', 'admin', 'admin@admin.admin', 'Canada', 'Toronto', 1, 1)
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

$sql[] = "CREATE TABLE articles (
	article_id	INT(11)         NOT NULL AUTO_INCREMENT,
	posted 		DATETIME        NOT NULL,
	archiving 	DATETIME        NULL DEFAULT NULL,
	title 		VARCHAR(255)    NOT NULL DEFAULT '',
	title_url 	VARCHAR(255)    NOT NULL DEFAULT '',
	description	VARCHAR(255)    NOT NULL DEFAULT '',
	body 		LONGTEXT        NOT NULL DEFAULT '',
	cover		VARCHAR(100)    NOT NULL DEFAULT '',
	user_id 	INT(11)         NOT NULL,
	is_active 	TINYINT(1)      NOT NULL DEFAULT '0',
    views	    INT(11)         NOT NULL DEFAULT '0',
	PRIMARY KEY (article_id)
	)";

$sql[] = "INSERT INTO articles (posted, archiving, title, title_url, description, body, cover, user_id, is_active, views) 
		  VALUES ('2017-11-01 10:59:32', 
		  		  '2017-12-02 10:59:32', 
		  		  'Welcome to the BikeCMS', 
		  		  'welcome-to-the-bikecms', 
		  		  'Simple, fast and elegant solution', 
		  		  'Simple, fast and elegant solution. <i>Lorem Ipsum</i> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy txt ever since the 1500s, when an unknown printer took a galley of type ynd scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised comon the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus <b>PageMaker</b> including versions of Lorem Ipsum.', 
		  		  '01.jpg', 
		  		  1, 
		  		  1,
		  		  1),
				 ('2017-10-01 10:59:32', 
				  '2017-12-02 10:59:32', 
				  'Blogger Choice 2017', 
				  'blogger-choice-2017', 
		  	      'Hello world, this is my first prize. Congratulations!', 
		  	      'Hello world, this is my first prize. <b>Congratulations!</b> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. <p>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.<br>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de <b>Finibus Bonorum</b> et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.., comes from a line in section 1.10.32.</p>', 
		  	      '02.jpg', 
		  	      1, 
		  	      1,
		  	      1),
			     ('2017-09-01 10:59:32', 
			      '2017-12-02 10:59:32', 
			      'Winning solution ready for you', 
			      'winning-solution-ready-for-you', 
		  	      'Ridiculously easy to install and run', 
		  	      'Hello world, this is my first article. Congratulations! It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.</p> Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 
		  	      '03.jpg', 
		  	      1, 
		  	      1,
		  	      1)
		";

$sql[] = "CREATE TABLE tags (
	article_id	INT(11)         NOT NULL,
	tag_id 		INT(11)         NOT NULL,
	rank		VARCHAR(64)     NOT NULL DEFAULT '0'
	)";

$sql[] = "INSERT INTO tags (article_id, tag_id, rank) VALUES (1, 1, 3), (1 , 2, 2), (1 , 3, 2)";

$sql[] = "CREATE TABLE sections (
	article_id	INT(11)         NOT NULL,
	section_id 	INT(11)         NOT NULL,
	rank		VARCHAR(64)     NOT NULL DEFAULT '0'
	)";

$sql[] = "INSERT INTO sections (article_id, section_id, rank) VALUES (1, 1, 3)";


$_SESSION['success_count'] = 0;
$_SESSION['error_count'] = 0;

foreach ($sql as $query) {
	$stmt = $db->prepare($query);
	$stmt->execute();

	if(!$stmt) {
		$_SESSION['error_count']++;
		$_SESSION['error_details'] = $db->errorInfo();

	} else {
		$_SESSION['success_count']++;
	}
}

echo "Executed " . $_SESSION['success_count'] . " queries with " . $_SESSION['error_count'] . " errors.";

isset($_SESSION['error_details']) ? print_r($_SESSION['error_details']) : false;

session_destroy();

?>