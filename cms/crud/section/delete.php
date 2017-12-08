<?php
require_once DIR . "cms/crud/header.php"; 
$section = getSectionById($activity_id);
?>

<p>Confirm:</p>
<p>Deleting section <b><?= $section["title"] ?></b></p>

<form method="POST">
	<input type="hidden" name="section_id" value="<?= $section['section_id'] ?>">
  	<button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  	<button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>
</form> 

<?php require_once DIR . "cms/crud/footer.php"; ?>