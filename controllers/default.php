<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./include/utilities.php";
$utility = new Utility($db);

$pages_arr = array();
foreach ($sections as $section) {
	$pages_arr[] = $section["page"];
}

if (in_array($controller, $pages_arr)) {
	require_once "./views/header.php";
	require_once "./views/section_title.php";
	require_once "./views/footer.php";
} else {
	$utility->redirect_to( DIR_URL . "404" );
}

?>