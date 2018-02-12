<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

$pages_arr = array();
foreach ($sections as $section) {
	$pages_arr[] = $section["page"];
}

if (in_array($page, $pages_arr)) {
	require_once "./views/header.php";
	require_once "./views/section_title.php";
	require_once "./views/footer.php";
} else {
	redirect_to( DIR_URL . "404" );
}

?>