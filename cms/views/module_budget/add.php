<h1 class="display-4">Add Transaction</h1>

<form method="POST" enctype="multipart/form-data" onsubmit="return postForm()">

  <div class="form-row">

    <div class="form-group col-md-10">

            <label for="store">Store</label>
            <input type="text" name="store" class="form-control" Placeholder="Store">

            <label for="store">Dropbox URL</label>
            <input type="text" name="dropbox_url" class="form-control" Placeholder="dropbox.com">

            <label for="amount">Amount</label>
            <input type="text" name="amount" class="form-control" Placeholder="0.00">

            <label for="tax">Tax</label>
            <input type="text" name="tax" class="form-control" Placeholder="0.00">

    </div>

    <div class="form-group col-md-2">

            <label for="trans_date">Date</label>
            <input type="date" name="trans_date" class="form-control" Placeholder="YYYY-MM-DD HH:MM:SS">

            <label for="cat_id">Category</label>
            <select class="form-control" name="cat_id">
              <?php
                $cats = $cat->readAll();
                foreach ($cats as $cat) {
                  echo '<option value="' .
                        $cat["cat_id"] . '"';
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
              <input class="form-check-input" type="radio" name="is_active" value="1"> Yes
            </label>
          </div>

          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="0"> No
            </label>
          </div>
        </div>



    </div>

  <button type="submit" class="btn btn-outline-primary" name="add">Add</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

  </div>

</form>