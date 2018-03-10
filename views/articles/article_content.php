
<h1 class="display-4"><?= $article_content["title"] ?></h1>

<p>
	<img src="<?= DIR_URL_IMG . $article_content["cover"] ?>" 
	class="img-fluid" alt="<?= $article_content["description"] ?>">
</p>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= DIR_URL ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= DIR_URL . "articles" ?>">Articles</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $article_content["title"] ?></li>
  </ol>
</nav>

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