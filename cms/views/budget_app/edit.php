<?php
$transaction = $purchase->getTransById($action_id);
?>

<h1 class="display-4">Edit Transaction <b>"<?= $transaction["trans_date"] ?>"</b></h1>

<form method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
        
  <div class="form-row">
    
    <div class="form-group col-md-10">

            <label for="title">Store</label>
            <input type="text" name="store" class="form-control" value="<?= $transaction["store"] ?>">

            <label for="title">Amount</label>
            <input type="text" name="amount" class="form-control" value="<?= $transaction["amount"] ?>">

            <label for="title">Tax</label>
            <input type="text" name="tax" class="form-control" value="<?= $transaction["tax"] ?>">

    </div>

    <div class="form-group col-md-2">

            <label for="datePosted">DateTime</label>
            <input type="text" class="form-control" name="trans_date" value="<?= $transaction["trans_date"] ?>">

            <label for="dateArchived">Category</label>
            <select class="form-control" name="cat_id">
              <?php
                foreach ($cats as $cat) {
                  echo '<option value="' . 
                        $cat["cat_id"] . '"';
                  if ($cat["cat_id"] === $transaction["cat_id"]) echo "selected";
                  echo '>' . 
                        $cat["cat_title"] . 
                        '</option>';
                }
              ?>
            </select>

      <label for="is_active">Is active?</label>

        <div class="form-group">
          
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="1" <?php if ( $transaction["is_active"] ) { echo " checked"; } ?>> Yes 
            </label>
          </div>
              
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="0" <?php if ( !$transaction["is_active"] ) { echo " checked"; } ?>> No  
            </label>
          </div>
        
        </div>



        
    </div>

  <button type="submit" class="btn btn-outline-primary" name="edit">Edit</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

  </div>
</form>