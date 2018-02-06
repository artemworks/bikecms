<?php 
require_once DIR . "cms/crud/header.php";
$transactions = getTrans();
?>

<h1 class="display-4">My Transactions</h1>

<form method="POST">

  <table class='table'>

  <tr>

    <th><input class="form-check-input" name="trans_id" type="checkbox" value="all"></th>
    <th>ID</th>
    <th>Date</th>
    <th>Store</th>
    <th>Amount</th>
    <th>Tax</th>
    <th>Category</th>
    <th>Status</th>

  </tr>


  <?php 

    foreach ($transactions as $transaction) {

      $transDate = DateTime::createFromFormat('Y-m-d H:i:s', htmlentities($transaction["trans_date"]) );
      //$transDate = $transDate->format('M, n Y');
      $transDate = $transDate->format('M, d Y');

      $transaction["is_active"] ? $status = "Active" : $status = "Not Active";

  ?>    

  <tr>

    <td><input class="form-check-input" name="trans_id" type="checkbox" value="<?= htmlentities($transaction["trans_id"]) ?>"></td>
    <td><?= htmlentities($transaction["trans_id"]) ?></td>
    <td><a href="<?= DIR_URL . "cms/budget_app/edit/" . htmlentities($transaction["trans_id"]) ?>"><?= $transDate ?></a></td>
    <td><?= htmlentities($transaction["store"]) ?></td>
    <td><?= htmlentities($transaction["amount"]) ?></td>
    <td><?= htmlentities($transaction["tax"]) ?></td>
    <td><?= htmlentities(getCatById($transaction["cat_id"])["cat_title"]) ?></td>
    <td><?= htmlentities($status) ?></td>

  </tr>

  <?php } ?>

  </table>
  
  <button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

</form>

<?php require_once DIR . "cms/crud/footer.php"; ?>