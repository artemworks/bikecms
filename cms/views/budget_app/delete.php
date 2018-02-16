<?php
$trans = $purchase->getTransById($action_id);
?>

<p>Confirm:</p>
<p>Deleting transaction <b><?= $trans["store"] ?></b> at <b><?= $trans["trans_date"] ?></b></p>

<form method="POST">
	<input type="hidden" name="trans_id" value="<?= $trans['trans_id'] ?>">
  	<button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  	<button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>
</form> 