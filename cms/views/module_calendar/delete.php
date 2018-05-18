<p>Confirm:</p>
<p>Deleting event <b><?= $event_content["event_title"] ?></b></p>

<form method="POST">
	<input type="hidden" name="event_id" value="<?= $event_content['event_id'] ?>">
  	<button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  	<button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>
</form>