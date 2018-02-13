<h1 class="display-4">My Articles</h1>

<form method="POST">

  <table class='table'>

  <tr>

    <th><input class="form-check-input" name="article_id" type="checkbox" value="all"></th>
    <th>ID</th>
    <th>Title</th>
    <th>Published</th>
    <th>Status</th>
    <th>Author</th>

  </tr>


  <?php 
  

    foreach ($articlesSorted as $article) {

      $datePosted = DateTime::createFromFormat('Y-m-d H:i:s', $article["posted"]);
      $datePosted = $datePosted->format('M, n Y');
      $dateArchiving = DateTime::createFromFormat('Y-m-d H:i:s', $article["archiving"]);
      $dateArchiving = $dateArchiving->format('M, n Y');

      $article["is_active"] ? $status = "Active" : $status = "Not Active";

  ?>    

  <tr>

    <td><input class="form-check-input" name="article_id" type="checkbox" value="<?= htmlentities($article["article_id"]) ?>"></td>
    <td><?= htmlentities($article["article_id"]) ?></td>
    <td><a href="<?= DIR_URL . "cms/article/edit/" . htmlentities($article["article_id"]) ?>"><?= htmlentities($article["title"]) ?></a></td>
    <td><?= htmlentities($datePosted) ?></td>
    <td><?= htmlentities($status) ?></td>
    <td><?= htmlentities($user->getUserById($article["user_id"])["real_name"]) ?></td>

  </tr>

  <?php } ?>

  </table>
  
  <button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

</form>