<?php

	if (!empty($sectionsForArticle))
	{
		echo "<p>Sections: ";

		foreach ($sectionsForArticle as $section) 

		{
			echo "<a href='" . DIR_URL . $section["page"] . 
				 "' class='badge badge-pill badge-light'>" . 
				 $section["title"] . "</a> ";
		}

		echo "</p>";
	}
						
				
	if ( !empty($tagsForArticle) ) 
	{
		echo "<p>Tags: ";

		foreach ($tagsForArticle as $tag) 
		{
			echo "<a href='" . DIR_URL . "tags/" . $tag["name"] . 
				 "' class='badge badge-pill badge-light'>" . 
				 $tag["name"] . "</a> ";
		}

		echo "</p>";
	}
	

?>