<?php

	// Section Titile & Desription
	foreach ($sections as $section) {
		if ( isset($controller) && $section["page"] == $controller ) {
			echo "<h1 class=\"display-4\">" . $section["title"] . "</h1>";
			echo "<p>" . $section["description"] . "</p>";
		}
	}

?>