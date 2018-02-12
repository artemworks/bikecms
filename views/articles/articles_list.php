<h1 class="display-4">My Articles</h1>

<?php 
foreach ($articles as $article) {
	if ( $article["is_active"] ) {
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $article["posted"])->format('M, n Y');
?>
				
<p>					
	<?= htmlentities($date) ?>
	<a href="<?= htmlentities($controller) . "/" . htmlentities($article["title_url"]) ?>">
		<?= htmlentities($article["title"]) ?>
	</a>
</p>

<?php
	}
}
?>