<h1 class="display-4">My Users</h1>

<form method="POST">

  <table class='table'>

  <tr>

    <th><input class="form-check-input" name="user_id" type="checkbox" value="all"></th>
    <th>ID</th>
    <th>Name</th>
    <th>Real Name</th>
    <th>Email</th>
    <th>Privilege</th>
    <th>Status</th>

  </tr>


  <?php 

    foreach ($users as $user) {

      $user["priv"] ? $priv = "Admin" : $priv = "User";
      $user["is_active"] ? $status = "Active" : $status = "Not Active";

  ?>    

  <tr>

    <td><input class="form-check-input" name="user_id" type="checkbox" value="<?= htmlentities($user["user_id"]) ?>"></td>
    <td><?= htmlentities($user["user_id"]) ?></td>
    <td><a href="<?= DIR_URL . "cms/user/edit/" . htmlentities($user["user_id"]) ?>"><?= htmlentities($user["name"]) ?></a></td>
    <td><a href="<?= DIR_URL . "cms/user/edit/" . htmlentities($user["user_id"]) ?>"><?= htmlentities($user["real_name"]) ?></a></td>
    <td><?= htmlentities($user["email"]) ?></td>
    <td><?= htmlentities($priv) ?></td>
    <td><?= htmlentities($status) ?></td>

  </tr>

  <?php } ?>

  </table>
  
  <button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

</form>