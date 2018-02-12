<?php 

if( isset($name) ) {
	echo "<h1 class=\"display-4\">My Articles for tag <i>" . $name . "</i></h1>";
} else {
	echo "<h1 class=\"display-4\">My Articles</h1>";
}

foreach ($articles as $article) {
	if ( $article["is_active"] ) {
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $article["posted"])->format('M, n Y');
?>
				
<p>					
	<?= htmlentities($date) ?>
	<a href="<?= DIR_URL . "articles/" . htmlentities($article["title_url"]) ?>">
		<?= htmlentities($article["title"]) ?>
	</a>
</p>

<?php
	}
}
?>