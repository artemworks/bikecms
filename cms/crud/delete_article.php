<?php

?>
<p>Confirm:</p>
<p>Deleting <?= $urlArr[1] ?></p>

<form method="POST">
	<input type="hidden" name="article_id" value="<?= $row['profile_id'] ?>">
	<input type="submit" value="Delete" name="delete">
	<a href="index.php">Cancel</a>
</form> 