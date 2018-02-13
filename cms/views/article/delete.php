<p>Confirm:</p>
<p>Deleting article <b><?= $article_content["title"] ?></b></p>

<form method="POST">
	<input type="hidden" name="article_id" value="<?= $article_content['article_id'] ?>">
  	<button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  	<button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>
</form> 