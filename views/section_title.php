<?php

	// Section Titile & Desription
	foreach ($sections as $section) {
		if ( isset($_GET["one"]) && $section["page"] == $_GET["one"]) {
			echo "<h1 class=\"display-4\">" . $section["title"] . "</h1>";
			echo "<p>" . $section["description"] . "</p>";
		}
	}

?>