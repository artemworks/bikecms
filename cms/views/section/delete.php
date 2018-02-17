<p>Confirm:</p>
<p>Deleting section <b><?= $sectionContent["title"] ?></b></p>

<form method="POST">
	<input type="hidden" name="section_id" value="<?= $sectionContent['section_id'] ?>">
  	<button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  	<button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>
</form> 