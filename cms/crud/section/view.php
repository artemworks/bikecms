<?php 
require_once DIR . "cms/crud/header.php";
$sections = getSections();
?>

<h1 class="display-4">My Sections</h1>

<form method="POST">

  <table class='table'>

  <tr>

    <th><input class="form-check-input" name="section_id" type="checkbox" value="all"></th>
    <th>ID</th>
    <th>Title</th>
    <th>Rank</th>
    <th>Status</th>

  </tr>


  <?php 

    foreach ($sections as $section) {

      $section["is_active"] ? $status = "Active" : $status = "Not Active";

  ?>    

  <tr>

    <td><input class="form-check-input" name="section_id" type="checkbox" value="<?= htmlentities($section["section_id"]) ?>"></td>
    <td><?= htmlentities($section["section_id"]) ?></td>
    <td><a href="<?= DIR_URL . "cms/section/edit/" . htmlentities($section["section_id"]) ?>"><?= htmlentities($section["title"]) ?></a></td>
    <td><?= htmlentities($section["rank"]) ?></td>
    <td><?= htmlentities($status) ?></td>

  </tr>

  <?php } ?>

  </table>
  
  <button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

</form>

<?php require_once DIR . "cms/crud/footer.php"; ?>