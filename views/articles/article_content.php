
<h1 class="display-4"><?= htmlentities($article_content["title"]) ?></h1>

<p>
	<img src="<?= DIR_URL_IMG . $article_content["cover"] ?>" 
	class="img-fluid" alt="<?= $article_content["description"] ?>">
</p>

<p>
	<small>
		<?= $date ?> 
		&middot; 
		<i class="fas fa-eye fa-sm"></i> 
		<?= $article_content["views"] ?>
	</small>
</p>

<p>
	<?= nl2br($article_content["body"]) ?>
</p>