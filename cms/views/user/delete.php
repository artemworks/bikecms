<p>Confirm:</p>
<p>Deleting user <b><?= $userContent["real_name"] ?></b></p>

<form method="POST">
	<input type="hidden" name="user_id" value="<?= $userContent['user_id'] ?>">
  	<button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  	<button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>
</form>