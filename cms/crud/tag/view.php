<?php 
require_once DIR . "cms/crud/header.php";
$tags = getTags();
?>

<h1 class="display-4">My Tags</h1>

<form method="POST">

  <table class='table'>

  <tr>

    <th><input class="form-check-input" name="tag_id" type="checkbox" value="all"></th>
    <th>ID</th>
    <th>Name</th>
    <th>Status</th>

  </tr>


  <?php 

    foreach ($tags as $tag) {

      $tag["is_active"] ? $status = "Active" : $status = "Not Active";

  ?>    

  <tr>

    <td><input class="form-check-input" name="tag_id" type="checkbox" value="<?= htmlentities($tag["tag_id"]) ?>"></td>
    <td><?= htmlentities($tag["tag_id"]) ?></td>
    <td><a href="<?= DIR_URL . "cms/tag/edit/" . htmlentities($tag["tag_id"]) ?>"><?= htmlentities($tag["name"]) ?></a></td>
    <td><?= htmlentities($status) ?></td>

  </tr>

  <?php } ?>

  </table>
  
  <button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

</form>

<?php require_once DIR . "cms/crud/footer.php"; ?>