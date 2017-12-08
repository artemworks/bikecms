<?php
require_once DIR . "cms/crud/header.php"; 
$article = getArticleById($activity_id);
?>

<p>Confirm:</p>
<p>Deleting article <b><?= $article["title"] ?></b></p>

<form method="POST">
	<input type="hidden" name="article_id" value="<?= $article['article_id'] ?>">
  	<button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  	<button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>
</form> 

<?php require_once DIR . "cms/crud/footer.php"; ?>