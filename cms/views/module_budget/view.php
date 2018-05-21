<h1 class="display-4">Money Expenditure Log</h1>

<p>
    <form>
      <div class="form-row align-items-center">
        <div class="col-sm-12">
        <select name="month" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
          <option value="">Select...</option>
          <?php
            foreach ($m_list as $el) {
              echo "<option value='" . DIR_URL . "cms/module_budget/" . date( 'm-Y', strtotime($el) ) . "'>" . $el . "</option>";
            }
          ?>
        </select>
        </div>
      </div>
  </form>
</p>

<form method="POST">

  <table class='table'>

  <tr>

    <th><input class="form-check-input" name="trans_id" type="checkbox" value="all"></th>
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
      $transDate = $transDate->format('M d, Y');

      $transaction["is_active"] ? $status = "Active" : $status = "Not Active";

  ?>

  <tr>

    <td><input class="form-check-input" name="trans_id" type="checkbox" value="<?= htmlentities($transaction["trans_id"]) ?>"></td>
    <td><a href="<?= DIR_URL . "cms/module_budget/edit/" . htmlentities($transaction["trans_id"]) ?>"><?= $transDate ?></a></td>
    <td><?= htmlentities($transaction["store"]) ?></td>
    <td><?= htmlentities($transaction["amount"]) ?></td>
    <td><?= htmlentities($transaction["tax"]) ?></td>
    <td><?= $purchase->getCatById($transaction["trans_id"])[0]["cat_title"]; ?></td>
    <td><?= htmlentities($status) ?></td>

  </tr>

  <?php } ?>

  </table>

  <a class="btn btn-outline-primary" href="<?= DIR_URL . "cms/module_budget/add" ?>">Add</a>&nbsp;
  <button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>


</form>