<h1 class="display-4">Add Section</h1>

<form method="POST">
  
  <div class="form-row">
    
    <div class="form-group col-md-12">

      <div class="form-group">
        <label for="title">Name</label>
        <input type="text" name="name" class="form-control" Placeholder="Enter section name">
      </div>

      <div class="form-group">
        <label for="title">Page Name</label>
        <input type="text" name="page" class="form-control" Placeholder="Enter page name">
      </div>

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" Placeholder="Enter title">
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" name="description" rows="7" Placeholder="Enter description"></textarea>
      </div>

      <div class="form-group">
        <label for="title">Rank</label>
        <input type="text" name="rank" class="form-control" Placeholder="Enter numeric rank">
      </div>

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