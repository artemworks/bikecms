<?php
session_start();

/*
		rumiantsev.ca | artemworks.com
*/

require_once "../models/db.php";
$database = new Database();
$db = $database->getConnection();

$sql = array();

/*
		Tables for calendar items and calendar categories
*/

$sql[] = "CREATE TABLE c_items (
	event_id						INT(11)     		NOT NULL AUTO_INCREMENT,
	event_datetime 			DATETIME        NOT NULL,
	event_title					VARCHAR(100)    NOT NULL DEFAULT '',
	event_title_url			VARCHAR(100)    NOT NULL DEFAULT '',
	event_description		LONGTEXT		    NOT NULL DEFAULT '',
	event_location			VARCHAR(255)    NOT NULL DEFAULT '',
	event_link					VARCHAR(255)    NOT NULL DEFAULT '',
	cat_id		    			VARCHAR(128)    NOT NULL,
	is_active						TINYINT(1)      NOT NULL DEFAULT '1',
	pageviews						INT(11)         NOT NULL DEFAULT '0',
	PRIMARY KEY (event_id)
	)";

$sql[] = "CREATE TABLE c_categories (
	cat_id		INT(11)     		NOT NULL AUTO_INCREMENT,
	cat_title	VARCHAR(255)    NOT NULL DEFAULT '',
	is_active	TINYINT(1)      NOT NULL DEFAULT '1',
	PRIMARY KEY (cat_id)
	)";

/*
		Inserting test values
*/

$sql[] = "INSERT INTO c_items (event_datetime, event_title, event_title_url, event_description, event_location, event_link, cat_id, is_active, pageviews)
				 			VALUES
				 			('2018-05-26 09:00:00', 'Doors Open Toronto Day 1', 'doors-open-toronto-day1-2018', 'The 19th annual Doors Open Toronto presented by Great Gulf provides an opportunity to see inside more than 130 of the most architecturally, historically, culturally and socially significant buildings across the city.', 'Toronto', 'https://www.toronto.ca/explore-enjoy/festivals-events/doors-open-toronto/', 1, 1, 0),
				 			('2018-05-27 09:00:00', 'Doors Open Toronto Day 2', 'doors-open-toronto-day2-2018', 'The 19th annual Doors Open Toronto presented by Great Gulf provides an opportunity to see inside more than 130 of the most architecturally, historically, culturally and socially significant buildings across the city.', 'Toronto', 'https://www.toronto.ca/explore-enjoy/festivals-events/doors-open-toronto/', 1, 1, 0),
				 			('2018-05-27 09:00:00', 'Walk for Values', 'walk-for-values-2018', 'The Walk for Values is designed to raise the awareness of the 5 Human Values and to educate people on the importance of practicing them daily.', 'Nathan Phillips Square, Toronto', 'https://www.walkforvalues.com/images/toronto-walk-2003/', 1, 1, 0),
				 			('2018-05-29 11:30:00', 'Toronto Newcomer Day', 'toronto-newcomer-day-2018', 'Welcome newcomers to Toronto with activities and entertainment.', 'Nathan Phillips Square, Toronto', 'https://www.toronto.ca/community-people/moving-to-toronto/toronto-newcomer-day/', 1, 1, 0),
				 			('2018-06-14 18:00:00', 'Scotiabank Rat Race', 'scotiabank-rat-race-2018', 'The Scotiabank Rat Race for United Way is a certified 5K run through downtown Toronto, on a weeknight (the only race to offer such an opportunity). Afterwards, you ll enjoy an on-site after-party, featuring live music from The Lonely Hearts, a beer garden, and fun interactive activities!', 'Nathan Phillips Square, Toronto', 'https://www.unitedwaygt.org/ratrace', 1, 1, 0)
				";

$sql[] = "INSERT INTO c_categories (cat_title, is_active)
				 			VALUES
				 				('General', 1),
				 			  ('Job Fair', 1),
				 				('Networking', 1)
				";
/*
		We need to add Calendar to the list of available sections
*/

$sql[] = "INSERT INTO section (name, page, title, description, rank, is_active)
		  VALUES ('calendar', 'calendar', 'Calendar', 'Events that matter the most', 4, 1)";

/*
		Executing all queries
*/

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

/*
		Checking for errors
*/

echo "Executed " . $_SESSION['success_count'] . " queries with " . $_SESSION['error_count'] . " errors.";

isset($_SESSION['error_details']) ? print_r($_SESSION['error_details']) : false;

session_destroy();

?>