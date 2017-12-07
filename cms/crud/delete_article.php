<?php
$article = getArticleById($article_id);
if (!empty($article)) {
?>

<p>Confirm:</p>
<p>Deleting <b><?= $article["title"] ?></b></p>

<form method="POST">
	<input type="hidden" name="article_id" value="<?= $article['article_id'] ?>">
	<input type="submit" class="btn btn-outline-danger" name="submit" value="Delete"> 
    <input type="submit" class="btn btn-outline-secondary" name="cancel" value="Cancel">
</form> 

<?php
}
?>