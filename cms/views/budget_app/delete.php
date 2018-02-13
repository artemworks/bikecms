<p>Confirm:</p>
<p>Deleting transaction <b><?= $transaction["store"] ?></b> at <b><?= $transaction["trans_date"] ?></b></p>

<form method="POST">
	<input type="hidden" name="trans_id" value="<?= $transaction['trans_id'] ?>">
  	<button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  	<button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>
</form> 