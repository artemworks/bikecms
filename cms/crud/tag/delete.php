<?php
require_once DIR . "cms/crud/header.php"; 
$tag = getTagById($activity_id);
?>

<p>Confirm:</p>
<p>Deleting tag <b><?= $tag["name"] ?></b></p>

<form method="POST">
	<input type="hidden" name="tag_id" value="<?= $tag['tag_id'] ?>">
  	<button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  	<button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>
</form> 

<?php require_once DIR . "cms/crud/footer.php"; ?>